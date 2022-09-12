<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserRequest;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function ssd(Request $request)
    {
        $users = User::latest()->get();
        return DataTables::of($users)
            ->editColumn('created_at', function ($each) {
                return Carbon::parse($each->created_at)->format('Y-m-d H:i:s');
            })
            ->editColumn('status', function ($each) {
                if ($each->status == '0') {
                    return ' <span class="badge bg-success text-white">UnBanned</span>';
                } else if($each->status == '1') {
                    return ' <span class="badge rounded-pill bg-danger text-white">Ban</span>';
                }
                else{
                    return '<span>-</span>';
                }
            })
            ->editColumn('profile_img', function ($each) {
                return '<img src="' . $each->server_icon_path() . '" alt="" class="border border-1 border-white shadow-sm profile-thumb" />';
            })
            ->addColumn('plus-icon', function ($each) {
                return null;
            })
            ->addColumn('action', function ($each) {
                $edit = "";
                $detail = "";
                $del = "";

                $edit = '<a href="'.route('user.edit', $each->id).'" class="btn mr-1 btn-success btn-sm rounded-circle"><i class="fa-solid fa-pen-to-square fw-light"></i></a>';

                $detail = '<a href="' . route('user.show', $each->id) . '" class="btn mr-1 btn-secondary btn-sm rounded-circle"><i class="fa-solid fa-circle-info"></i></a>';

                $del = '<a href="#" class="btn btn-danger btn-sm rounded-circle del-btn" data-id="' . $each->id . '"><i class="fa-solid fa-trash-alt fw-light"></i></a>';

                return '<div class="action-icon text-nowrap">' . $edit . $detail . $del . '</div>';
            })
            ->rawColumns(['action', 'profile_img', 'status'])
            ->make(true);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(StoreUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->status = $request->status;
        $user->password = Hash::make($request->password);
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $newName = 'profile_' . uniqid() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put('profile/' . $newName, file_get_contents($file));
            $user->profile_photo = $newName;
        }
        $user->save();

        return redirect()->route('user.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Created', 'message' => 'Employee is successfully created']);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->hasFile('profile_photo')) {
            Storage::disk('public')->delete('profile/' . $user->profile_photo);
            $file = $request->file('profile_photo');
            $newName = 'profile_' . uniqid() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put('profile/' . $newName, file_get_contents($file));

            $user->profile_photo = $newName;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->status = $request->status;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->update();

        return redirect()->route('user.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Updated', 'message' => 'User is successfully updated']);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        Storage::disk('public')->delete('profile/' . $user->profile_photo);
        return $user->delete();
    }

}
