<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    /* Aqui van los campos que se van agregar */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* Definiendo la funciòn para ver la relaciòn */
    public function posts(){
        /* Has Many es de 1:M En la relacion de uno a mucho */
        /* 1:M */
        /* En caso cuando no lo detecte se tiene uqe identificar en parte de las migraciones definidas  */
        return $this->hasMany(Post::class); /* autor_id, para que tenga referencia de lo que se va a realizar allí */    
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }


}
