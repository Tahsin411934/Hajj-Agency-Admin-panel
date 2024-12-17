<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageInclusionExclusion extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'packageInclusionExclusion';

    // Specify which attributes are mass assignable
    protected $fillable = [
        'type', 
        'description',
    ];

    // Automatically manage timestamps
    public $timestamps = true;
}
