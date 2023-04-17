<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $validatedData)
 * @method static factory()
 * @method followers()
 * @method following()
 */
class User extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'email','email_verified_at', 'password', 'bio', 'profile_image_url',
    ];

    protected $hidden = [
        'password',
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
