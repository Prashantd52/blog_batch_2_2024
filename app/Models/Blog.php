<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "blogs";

    public function tags()      //many to many relationship
    {
        return $this->belongsToMany(Tag::class);
    }

    public function category()  //one to many  inverse relationship
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
