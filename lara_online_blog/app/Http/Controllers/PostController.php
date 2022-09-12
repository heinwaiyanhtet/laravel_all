<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Info;
use App\Models\Article;
use App\Models\Photo;
use App\Models\Post;
use App\MyInfo;
use Faker\Core\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class PostController extends Controller
{

    use MyInfo;

    public static $myName = "hhz";

    public static function showMyName(){
        return "my name is ".Self::myName;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


//        return $this->myMyName;

//        $posts = Post::search()->latest('id')->paginate(5);


        return dd((new Article())->unPublishedPost());

//        if(View::exists("post.indexasd")){
//            return "view shi tal";
//        }else{
//            return "view ma shi buu";
//        }

        return view('post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('create',Post::class);
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {


//        DB::transaction(function () use($request){


        DB::beginTransaction();
        try {

            $post = new Post();
            $post->title = $request->title;
            $post->slug = $request->title;
            $post->description = $request->description;
            $post->excerpt = Str::words($request->description,20);
            $post->category_id = $request->category;
            $post->user_id = Auth::id();
            $post->is_publish = true;
            $post->save();
            logger("save post");

            //save tag to pivot table
            $post->tags()->attach($request->tags);
            logger("save post_tag");

            // auto create folder

            if(!Storage::exists("public/thumbnail")){
                Storage::makeDirectory("public/thumbnail");
            }

            Info::savePhoto($post->id);

            DB::commit();

        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }





//        });

        return redirect()->route('post.index')->with('status',"Post Created");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $post;
        return view('post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        Gate::authorize('update',$post);
        return view('post.edit',compact('post'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {


        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description,20);
        $post->category_id = $request->category;
        $post->update();

        // delete all record form pivot
        $post->tags()->detach();

        //save tag to pivot table
        $post->tags()->attach($request->tags);




        return redirect()->route('post.index')->with('status',"Post Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        Gate::authorize('delete',$post);


        foreach ($post->photos as $photo){
            //file delete
            Storage::delete('public/photo/'.$photo->name);
            Storage::delete('public/thumbnail/'.$photo->name);
        }

        // delete all record from hasMany
        $post->photos()->delete();

        // delete all record form pivot
        $post->tags()->detach();

        $post->delete();
        return redirect()->back()->with('status',"Post Deleted");

    }
}
