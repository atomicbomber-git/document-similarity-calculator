<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    public $fillable = [
        'title', 'abstract', 'chapter_1', 'chapter_2', 'chapter_5'
    ];
}
