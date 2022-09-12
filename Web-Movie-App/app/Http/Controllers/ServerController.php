<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Http\Requests\StoreServerRequest;
use App\Http\Requests\UpdateServerRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ServerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function ssd(){
        $servers = Server::latest()->get();
        return Datatables::of($servers)
            ->editColumn('created_at', function ($each) {
                return Carbon::parse($each->created_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('plus-icon', function ($each) {
                return null;
            })
            ->editColumn('icon', function ($each) {
                return '<img src="' . $each->server_icon_path() . '" alt="" class="border border-1 border-white shadow-sm profile-thumb" />';
            })
            ->addColumn('action', function ($each) {
                $edit = "";
                $del = "";

                $edit = '<a href="'.route('server.edit', $each->id).'" class="btn mr-1 btn-success btn-sm rounded-circle"><i class="fa-solid fa-pen-to-square fw-light"></i></a>';
                $del = '<a href="'.route('server.destroy',$each->id).'" class="btn btn-danger btn-sm rounded-circle del-btn" data-id="' . $each->id . '"><i class="fa-solid fa-trash-alt fw-light"></i></a>';

                return '<div class="action-icon text-nowrap">' . $edit . $del . '</div>';
            })
            ->rawColumns(['action', 'icon'])
            ->make(true);
    }


    public function create()
    {
        return view('server.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreServerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServerRequest $request)
    {
        $server = new Server();
        $server->name = $request->serverName;
        $server->url = $request->serverUrl;

        if(request()->hasFile('serverIcon'))
        {
            $dir = "storage/serverIcon";
            $newName = "serverIcon_".uniqid().'.'.$request->file('serverIcon')->extension();
            $request->serverIcon->storeAs("public/serverIcon/",$newName);
            $server->icon = $dir."/".$newName;
        }

        $server->save();
        return redirect()->route('server.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function show(Server $server)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function edit(Server $server)
    {
        return view('server.edit',compact('server'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServerRequest  $request
     * @param  \App\Models\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServerRequest $request, Server $server)
    {
        $server->name = $request->serverName;
        $server->url = $request->serverUrl;

        if(request()->hasFile('serverIcon'))
        {
            File::delete(public_path($server->icon));
            $dir = "storage/serverIcon";
            $newName = "serverIcon_".uniqid().'.'.$request->file('serverIcon')->extension();
            $request->serverIcon->storeAs("public/serverIcon/",$newName);
            $server->icon = $dir."/".$newName;
        }

        $server->update();
        return redirect()->route('server.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function destroy(Server $server)
    {
        if(File::exists(public_path($server->icon))){
            File::delete(public_path($server->icon));
        }
        return $server->delete();
    }
}
