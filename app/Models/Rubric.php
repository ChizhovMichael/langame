<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Rubric extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return HasMany
     */
    public function container(): HasMany
    {
        return $this->hasMany(RubricContainer::class);
    }

    /**
     * @return HasManyThrough
     */
    public function relationship(): HasManyThrough
    {
        return $this->hasManyThrough(RubricRelationship::class, RubricContainer::class);
    }
}
