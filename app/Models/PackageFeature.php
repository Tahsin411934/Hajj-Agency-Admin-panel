<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageFeature extends Model
{
    use HasFactory;
 protected $table = "packagefeatures";
    protected $fillable = [
        'packageid',
        'description',
        'image',
    ];

    // Define relationship with the Packages model
    public function package()
    {
        return $this->belongsTo(Package::class, 'packageid');
    }
}
