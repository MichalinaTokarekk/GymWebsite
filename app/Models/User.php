<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Specialization;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use SoftDeletes;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'imie',
        'nazwisko',
        'email',
        'password',
        'opis',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function isOnlyUser(): bool
    {
        if($this->hasRole(config('auth.roles.user')) && 
            !$this->hasRole(config('auth.roles.admin')) &&
            !$this->hasRole(config('auth.roles.worker')) &&
            !$this->hasRole(config('auth.roles.trainer')) &&
            !$this->hasRole(config('auth.roles.physiotherapist')) &&
            !$this->hasRole(config('auth.roles.dietician'))
        ){
            return true;
        }else{
            return false;
        }
    }

    public function isAdmin(): bool
    {
        return $this->hasRole(config('auth.roles.admin'));
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function competitions()
    {
        return $this->belongsToMany(Competition::class)->withTimestamps();
    }

    public function specializations()
    {
        return $this->belongsToMany(Specialization::class)->withTimestamps();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function tariffs()
    {
        return $this->belongsToMany(Tariff::class); // Use the correct table name here
    }
    
    
    protected function image(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if ($value === null) {
                    return null;
                }
                return config('filesystems.users_dir')
                    . '/' . $value;
            },
        );
    }


    public function imageUrl(): string
    {
        return $this->imageExists()
        ? Storage::url($this->image)
        : Storage::url(config('app.no-image'));
    }

    public function imageExists(): bool
    {
        return $this->image !== null
            && Storage::disk('public')->exists($this->image);
    }


    public function hasTariff($tariffName)
    {
        return $this->tariffs()->where('tariffs.name', $tariffName)->exists();
    }

    public function isTariffActive($tariffName)
    {
        $tariff = $this->tariffs()->where('tariffs.name', $tariffName)->first();

        return $tariff && ($tariff->data_zakonczenia === null || now() <= $tariff->data_zakonczenia);
    }

    

}
