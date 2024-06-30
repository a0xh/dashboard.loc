<?php

namespace App\Domain\Category\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Application\Enums\StatusEnum;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use Sluggable;
    
    protected $table = 'categories';
    
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'keywords',
        'type',
        'status',
        'media',
        'category_id',
        'user_id',
        'data'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'title' => 'string',
            'slug' => 'string',
            'description' => 'string',
            'keywords' => 'string',
            'type' => 'string',
            'status' => StatusEnum::class,
            'media' => 'string',
            'category_id' => 'int',
            'user_id' => 'int',
            'data' => 'array',
        ];
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    
    protected function data(): Attribute
    {
        return Attribute::make(
            get: fn ($data) => json_decode($data),
            set: fn ($data) => json_encode($data),
        );
    }

    public function categories(): HasMany
    {
        return $this->hasMany(\App\Domain\Category\Domain\Category::class);
    }

    public function childrenCategories(): HasMany
    {
        return $this->hasMany(self::class)->with('categories');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\User\Domain\User::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(\App\Domain\Post\Domain\Post::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(\App\Domain\Product\Domain\Product::class);
    }
}
