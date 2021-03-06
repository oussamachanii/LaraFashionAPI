<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Rating;
use App\Models\Purchase;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable  , HasApiTokens ,    SoftDeletes ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'country',
        'region',
        'city',
        'address',
        'code_postal',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function purchases(){
        return $this->hasMany(Purchase::class);
    }
    public function rating(){
        return $this->hasMany(Rating::class);
    }
    public function scopeSearch($query)
    {
            $query->where('first_name', 'LIKE', '%'.request('search').'%')
            ->orWhere('last_name', 'LIKE', '%'.request('search').'%')
            ->orWhere('email', 'LIKE', '%'.request('search').'%')
            ->orWhere('country', 'LIKE', '%'.request('search').'%')
            ->orWhere('region', 'LIKE', '%'.request('search').'%')
            ->orWhere('city', 'LIKE', '%'.request('search').'%')
            ->orWhere('address', 'LIKE', '%'.request('search').'%')
            ->orWhere('code_postal', '=', request('search'))
            ;
            return $query;
    }
}
