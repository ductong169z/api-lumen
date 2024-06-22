<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    protected $fillable = ['type', 'pack', 'content'];

    public function package()
    {
        return $this->belongsTo(Package::class, 'pack', 'id');
    }

}
