<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'text',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function getDescription($limit)
    {
        return Str::limit($this->text, $limit);
    }

    public static function setNull($authorId)
    {
        Book::where('author_id', $authorId)->update([
            'author_id' => null,
        ]);
    }
}
