<?php

namespace App\Domain\Role\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'slug', 'data'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(\App\Domain\User\Domain\User::class);
    }
}
