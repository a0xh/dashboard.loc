<?php

namespace App\Domain\Category\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Application\Enums\StatusEnum;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Str;

class Category extends Model
{
    use Sluggable;
    
    protected $table = 'categories';
    protected $keyType = 'string';

    public $incrementing = false;
    
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
            'category_id' => 'string',
            'user_id' => 'string',
            'data' => 'array',
        ];
    }

    public static function booted(): void
    {
        static::creating(function (Category $category) {
            $category->id = Str::uuid();
        });
    }
    
    protected function data(): Attribute
    {
        return Attribute::make(
            get: fn ($data) => json_decode($data),
            set: fn ($data) => json_encode($data),
        );
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function categories(): HasMany
    {
        return $this->hasMany(self::class);
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
