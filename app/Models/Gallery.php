<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    // Table name (optional if it follows convention)
    protected $table = 'gallery';
public $timestamps = false;
    // Mass assignable attributes
    protected $fillable = [
        'image',
        'caption',
    ];
}