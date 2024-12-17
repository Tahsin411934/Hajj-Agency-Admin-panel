<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionContent extends Model
{
    use HasFactory;

    protected $table = 'sectionContent'; // Table name (optional if the table name follows Laravel's convention)
public $timestamps = false;
    protected $fillable = [
        'sectionName',
        'title',
        'content',
        'image',
    ];
}
