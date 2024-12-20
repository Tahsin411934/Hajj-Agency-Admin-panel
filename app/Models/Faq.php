<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    // Specify the table name if it's different from the model name
    protected $table = 'faq';
    public $timestamps =false;

    // Define the fillable properties for mass assignment
    protected $fillable = [
        'question',
        'answer',
    ];
}
