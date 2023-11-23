<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
      'created_at' => 'datetime:d/m/Y H:i:s',
      'updated_at' => 'datetime:d/m/Y H:i:s',
      'deleted_at' => 'datetime:d/m/Y H:i:s',

    ];
    protected $fillable = [
        'name',
        'uf'
    ];
}
