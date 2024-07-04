<?php

namespace App\Domain\Product\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Application\Enums\StatusEnum;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\{Str, Number};

class Product extends Model
{
    use Sluggable;

    protected $table = 'products';
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
        'price',
        'content',
        'status',
        'views',
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
            'price' => 'float',
            'content' => 'string',
            'status' => StatusEnum::class,
            'views' => 'int',
            'category_id' => 'string',
            'user_id' => 'string',
            'data' => 'array',
        ];
    }

    public static function booted(): void
    {
        static::creating(function (Product $product) {
            $product->id = Str::uuid();
        });
    }

    protected function data(): Attribute
    {
        return Attribute::make(
            get: fn ($data) => json_decode($data),
            set: fn ($data) => json_encode($data),
        );
    }

    protected function price(): Attribute
    {
        $locale = app()->getLocale();

        switch ($locale) {
            case 'ru':
                $currency = 'RUB';
                $rate = 1;
                break;
            case 'en':
                $currency = 'USD';
                $rate = 1 / 85.75;
                break;
            
            default:
                $currency = 'EUR';
                $rate = 1 / 92.42;
                break;
        }

        return Attribute::make(
            get: fn ($price) => Number::currency(
                $price * $rate, in: $currency, locale: $locale
            )
        );
        
    }

    protected function views(): Attribute
    {
        return Attribute::make(
            get: fn ($count) => Number::abbreviate($count)
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
    
    public function comments(): MorphToMany
    {
        return $this->belongsToMany(\App\Domain\Comment\Domain\Comment::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(\App\Domain\Order\Domain\Order::class);
    }
}
