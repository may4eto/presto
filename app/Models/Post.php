<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Category;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Post extends Model
{
    use HasFactory;
    use Searchable;
    protected $fillable = [
        'title',
        'description',
        /* 'img', */
        'price',
        'category_id',
        'user_id',
    ];

    public function toSearchableArray()
    {
        $array = [
            'id'=>$this->id,
            'title'=>$this->title,
            'description'=>$this->description,
        ];

        // Customize the data array...

        return $array;
    }

    static public function toBeRevisionedCount(){
        return Post::where('is_accepted', null)->count();
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function favouriteUsers(){
        return $this->belongsToMany(User::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }
}
