<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageKeyword extends Model
{
    use HasFactory;
protected $table= 'pagekeywords';
    protected $fillable = [
        'sectionname',
        'keywords',
    ];
}
