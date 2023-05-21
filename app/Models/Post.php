<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model {
    use HasFactory;

    protected $casts = [
        'published_at'=>'datetime'
    ];

    protected $fillable = ['title', 'slug', 'thumbnail', 'body', 'active', 'published_at', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function shortBody(){
        return Str::words(strip_tags($this->body),30);
    }

    public function getFormatedDate(){
        return $this->published_at->format("F jS Y");
    }

    public function getThumbnail(){
        if(str_starts_with($this->thumbnail,'http')){
            return $this->thumbnail;
        }
        return '/storage/'.$this->thumbnail;
    }
}
