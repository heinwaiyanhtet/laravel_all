<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = "posts";
    protected $hidden = ["title"];

    public function showMyName(){
        return "I'm Hein Htet Zan Form Model Article";
    }

    public function unPublishedPost(){
        return $this->where("is_publish",0)->get();
    }
}
