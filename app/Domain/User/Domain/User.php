<?php

namespace App\Domain\User\Domain;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Application\Enums\StatusEnum;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    
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
        'media',
        'first_name',
        'last_name',
        'email',
        'password',
        'status',
        'data'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'media' => 'string',
            'first_name' => 'string',
            'last_name' => 'string',
            'email' => 'string',
            'status' => StatusEnum::class,
            'data' => 'array',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get and set the data.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function data(): Attribute
    {
        return Attribute::make(
            get: fn ($data) => json_decode($data),
            set: fn ($data) => json_encode($data),
        );
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(\App\Domain\Role\Domain\Role::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(\App\Domain\Caregory\Domain\Caregory::class);
    }

    public function tags(): HasMany
    {
        return $this->hasMany(\App\Domain\Tag\Domain\Tag::class);
    }
}
