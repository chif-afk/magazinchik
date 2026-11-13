<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory;
    use Sluggable;

        protected $fillable = [
        'title',
        'slug',
        'content',
        'category_id',
        'status_id',
        'img',
        'price',
        'old_price',
        'hit',
        'sale',
        'qty',
    ];

    protected $casts = [
        'hit' => 'boolean',
        'sale' => 'boolean',
        'price' => 'decimal:2',
        'old_price' => 'decimal:2',
    ];
        public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function getImage() {
        if (!$this->img) {
            return asset('no-image.png');
        } else {
            return asset("storage/{$this->img}");
        }
    }
}
