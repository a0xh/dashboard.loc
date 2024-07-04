<?php

namespace App\Domain\Page\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Application\Enums\StatusEnum;
use Illuminate\Support\Str;

class Page extends Model
{
    use Sluggable;

    protected $table = 'pages';
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
        'views',
        'content',
        'status',
        'user_id',
        'data',
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
            'views' => 'int',
            'user_id' => 'string',
            'data' => 'array',
        ];
    }

    public static function booted(): void
    {
        static::creating(function (Page $page) {
            $page->id = Str::uuid();
        });
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
}
