<?php

namespace App\Domain\Post\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Application\Enums\StatusEnum;

class Post extends Model
{
    use Sluggable;

    protected $table = 'posts';
    
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
        'media',
        'content',
        'status',
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
            'media' => 'string',
            'content' => 'string',
            'status' => StatusEnum::class,
            'category_id' => 'int',
            'user_id' => 'int',
            'data' => 'array',
        ];
    }
    
    protected function data(): Attribute
    {
        return Attribute::make(
            get: fn ($data) => json_decode($data),
            set: fn ($data) => json_encode($data),
        );
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\User\Domain\User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Category\Domain\Category::class);
    }
    
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(\App\Domain\Tag\Domain\Tag::class);
    }
}
