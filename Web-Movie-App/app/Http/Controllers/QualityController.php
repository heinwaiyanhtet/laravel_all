<?php

namespace App\Http\Controllers;

use App\Models\Quality;
use App\Http\Requests\StoreQualityRequest;
use App\Http\Requests\UpdateQualityRequest;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class QualityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }


    public function ssd(){
        $qualities = Quality::latest()->get();
        return Datatables::of($qualities)
            ->editColumn('created_at', function ($each) {
                return Carbon::parse($each->created_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('plus-icon', function ($each) {
                return null;
            })
            ->addColumn('action', function ($each) {
                $edit = "";
                $del = "";
                $edit = '<a href="'.route('quality.edit', $each->id).'" class="btn mr-1 btn-success btn-sm rounded-circle"><i class="fa-solid fa-pen-to-square fw-light"></i></a>';
                $del = '<a href="'.route('quality.destroy',$each->id).'" class="btn btn-danger btn-sm rounded-circle del-btn" data-id="' . $each->id . '"><i class="fa-solid fa-trash-alt fw-light"></i></a>';

                return '<div class="action-icon text-nowrap">' . $edit . $del . '</div>';
            })
            ->rawColumns(['action', 'icon'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $qualities = Quality::latest("id")->get();
        return view('quality.create',compact('qualities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQualityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQualityRequest $request)
    {
        $quality = new Quality();
        $quality->quality_name = $request->quality;
        $quality->save();
        return redirect()->route('genre.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quality  $quality
     * @return \Illuminate\Http\Response
     */
    public function show(Quality $quality)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quality  $quality
     * @return \Illuminate\Http\Response
     */
    public function edit(Quality $quality)
    {
        return view('quality.edit',compact('quality'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQualityRequest  $request
     * @param  \App\Models\Quality  $quality
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQualityRequest $request, Quality $quality)
    {
        $quality->quality_name = $request->quality;
        $quality->update();
        return redirect()->route('genre.index')->with('status',"quality Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quality  $quality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quality $quality)
    {
       return $quality->delete();
    }
}
