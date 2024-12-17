<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    // Define the table name (optional if naming matches convention)
    protected $table = 'blog';

    // Allow mass assignment for these fields
    protected $fillable = [
        'title',
        'shortdescription',
        'details',
        'image',
    ];
}
