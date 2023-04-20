<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(array $array)
 * @method static create(array $array)
 * @method static updateOrCreate(array $array)
 * @method static whereNotNull(string $string)
 */
class Follow extends Model
{
    use HasFactory;

    protected $fillable = ['follower_id', 'following_id'];

    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    public function following()
    {
        return $this->belongsTo(User::class, 'following_id');
    }
}
