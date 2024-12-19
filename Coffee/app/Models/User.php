<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'address',
        'profile_image',
        'phone_number',
        'gender',
        'role',
        'password',
        'code',
        'expice_at',
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
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function generateCode()
    {
        $this->timestamps = false;
        $this->code = rand(100000, 999999);
        $this->expice_at = now()->addMinute(30);
        $this->save();
    }


    public function restCode()
    {
        $this->timestamps = false;
        $this->code = null;
        $this->expice_at = null;
        $this->save();
    }

    public function product_reviews()
    {
        return $this->hasMany(Product_review::class);
    }
}
