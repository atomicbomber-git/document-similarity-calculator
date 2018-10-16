<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    public $fillable = [
        'title', 'abstract', 'chapter_1', 'chapter_2', 'chapter_5',
        'student_name', 'student_id', 'study_program', 'seminar_date',
        'advisor_1_id', 'advisor_2_id', 'advisor_1_name', 'advisor_2_name'
    ];
}
