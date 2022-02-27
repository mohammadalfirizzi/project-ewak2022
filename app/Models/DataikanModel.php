<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class DataikanModel extends Model
{
    use SoftDeletes;
    protected $table = 'dataikan';
    protected $guarded = [];
    protected $fillable = [
        'nama_ikan'
    ];
    protected $hidden;
}
