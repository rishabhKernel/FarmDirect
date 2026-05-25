<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

#[Fillable(['name', 'email', 'password', 'role', 'phone', 'bio', 'farm_name', 'location_data', 'language_pref', 'rating', 'city', 'state', 'pincode', 'address', 'language', 'email_notifications', 'sms_notifications', 'bid_alerts', 'price_alerts', 'two_factor_enabled', 'dark_mode', 'bank_accounts', 'profile_picture', 'cards', 'upi_id', 'is_suspended', 'is_verified'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at'    => 'datetime',
            'password'             => 'hashed',
            'email_notifications'  => 'boolean',
            'sms_notifications'    => 'boolean',
            'bid_alerts'           => 'boolean',
            'price_alerts'         => 'boolean',
            'two_factor_enabled'   => 'boolean',
            'dark_mode'            => 'boolean',
            'is_suspended'         => 'boolean',
            'is_verified'          => 'boolean',
        ];
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'role' => $this->role
        ];
    }
}
