<?php

namespace App\Classes;

//use Illuminate\Support\Facades\Request;

use Illuminate\Support\Facades\Storage;

class FileControl
{
    public static function fileSave($inputName,$storeDir=""){
        $dir = "public/".$storeDir;
        $newName = $inputName."_".uniqid().".".request()->file($inputName)->extension();
//        request()->file('cover')->($dir,$newName);
        Storage::disk("spaces")->put($newName,request()->file('cover'));
        return $newName;
    }
}
