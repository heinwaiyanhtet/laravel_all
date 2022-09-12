<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;

    public function server_icon_path(){
        if($this->icon)
        {
            return asset($this->icon);
        }
    }
}
