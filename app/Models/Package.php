<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    // Table name (optional, Laravel assumes 'packages')
    protected $table = 'package';

    // Primary key
    protected $primaryKey = 'packageid';

    // Auto-incrementing primary key
    public $incrementing = true;

    // Data type of the primary key
    protected $keyType = 'int';

    // Fillable fields
    protected $fillable = [
        'packageName',
        'price',
        'image',
        'keywords',
    ];
}
