<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Models\User;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\Expression;
use Yajra\DataTables\Facades\DataTables;


class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('config');
    }


    public function ssd()
    {
        $genres = Genre::latest()->get();
        return Datatables::of($genres)
            ->editColumn('created_at', function ($each) {
                return Carbon::parse($each->created_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('plus-icon', function ($each) {
                return null;
            })
            ->addColumn('action', function ($each) {
                $edit = "";
                $del = "";
                $edit = '<a href="'.route('genre.edit', $each->id).'" class="btn mr-1 btn-success btn-sm rounded-circle"><i class="fa-solid fa-pen-to-square fw-light"></i></a>';
                $del = '<a href="'.route('genre.destroy',$each->id).'" class="btn btn-danger btn-sm rounded-circle delete-btn" data-id="'. $each->id.'"><i class="fa-solid fa-trash-alt fw-light"></i></a>';

                return '<div class="action-icon text-nowrap">' . $edit . $del . '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $generes = Genre::latest("id")->get();
        return view('genre.create',compact('generes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGenreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGenreRequest $request)
    {
        $genres = new Genre();
        $genres->genre = $request->genre;
        $genres->save();
        return redirect()->route('genre.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        return view('genre.show',compact('genre'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre)
    {
        return view('genre.edit',compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGenreRequest  $request
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGenreRequest $request, Genre $genre)
    {
        $genre->genre = $request->genre;
        $genre->update();
        return redirect()->route('genre.index')->with('status',"Genre Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        return $genre->delete();
    }
}
