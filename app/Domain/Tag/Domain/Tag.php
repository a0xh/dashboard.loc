<?php

namespace App\Domain\Tag\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Application\Enums\StatusEnum;
use Illuminate\Support\Str;

class Tag extends Model
{
    use Sluggable;

    protected $table = 'tags';
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
        'media',
        'type',
        'status',
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
            'user_id' => 'string',
            'data' => 'array',
        ];
    }

    public static function booted(): void
    {
        static::creating(function (Tag $tag) {
            $tag->id = Str::uuid();
        });
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
    
    protected function data(): Attribute
    {
        return Attribute::make(
            get: fn ($data) => json_decode($data),
            set: fn ($data) => json_encode($data),
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\User\Domain\User::class);
    }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(\App\Domain\Post\Domain\Post::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(\App\Domain\Product\Domain\Product::class);
    }
}
