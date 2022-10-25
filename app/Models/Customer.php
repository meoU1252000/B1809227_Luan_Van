<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
class Customer extends Model implements Authenticatable
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
}
