<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'post_id',
    ];

    public function post(){
        return $this->belongsTo(Post::class);
    }

    static public function getUrlByFilePath($filePath, $w = null, $h = null)
    {
        if (!$w && !$h){
            return Storage::url($filePath);
        }

        $path = dirname($filePath);
        $filename = basename($filePath);

        $file = "{$path}/crop{$w}x{$h}_{$filename}";
        return Storage::url($file);

    }
    public function getUrl($w = null, $h = null){

        return Image::getUrlByFilePath($this->file, $w, $h);
    }
}
