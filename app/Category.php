<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ["title" , "slug"];
    
    public function menu()
    {
        return $this->hasMany(Menu::class);
    }
}