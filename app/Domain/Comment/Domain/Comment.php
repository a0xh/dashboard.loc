<?php

namespace App\Domain\Comment\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Application\Enums\StatusEnum;

class Comment extends Model
{
    protected $table = 'comments';
    
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
        'content',
        'comment_id',
        'status',
        'user_id',
        'data'
    ];

    protected function casts(): array
    {
        return [
            'content' => 'string',
            'comment_id' => 'int',
            'status' => StatusEnum::class,
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

    public function comments(): HasMany
    {
        return $this->hasMany(self::class);
    }

    public function childrenComments(): HasMany
    {
        return $this->hasMany(self::class)->with('comments');
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
