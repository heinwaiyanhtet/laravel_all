<?php

namespace App;

use App\Models\Photo;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class Info
{

    public $projectName = "MMS IT Blog Project";

    public function showProjectName(){
        return $this->projectName;
    }


    public static function savePhoto($postId){
        if(request()->hasFile('photos')){

            foreach (request()->file('photos') as $photo){

                //store file
                $newName = uniqid()."_photo.".$photo->extension();
                $photo->storeAs("public/photo/",$newName);//storage

                //making thumbnail
                $img = Image::make($photo);
                //reduce photo size
                $img->fit(200,200);
                $img->save("storage/thumbnail/".$newName);//public

                //save in db
                $photo = new Photo();
                $photo->name = $newName;
                $photo->post_id = $postId;
                $photo->user_id = Auth::id();
                $photo->save();
            }
        }
    }

}
