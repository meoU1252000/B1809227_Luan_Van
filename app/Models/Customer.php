<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
// use McCool\LaravelAutoPresenter\HasPresenter;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;
class Customer extends Model implements JwtSubject,Authenticatable
{
    use AuthenticableTrait;
    use HasApiTokens, Notifiable;

    use HasFactory;
    protected $table = 'customer';
    protected $primaryKey = 'id';
    protected $fillable = [
        'customer_name',
        'customer_phone',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

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
        return [];
    }

    public function get_address($id){
        return Customer_Address::where('customer_id', $id)->get();
    }
}
