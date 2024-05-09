<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory , SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['title','body','image','publish_date', 'status'];

    public function getImageAttribute($value){
        return asset('images'.'/'.$value);
    }
}
