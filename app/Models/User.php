<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Um usuário só pode ser de 1 tipo (cliente ou admin)
     * 
     * @return BelongsTo
     */
    public function userType() {
        
        return $this->belongsTo(UserType::class);
    }

    /**
     * Um usuário pode ser um cliente
     * 
     * @return HasOne
     */
    public function client() {

        return $this->hasOne(Client::class);
    }

    /**
     * Informa os campos que devem ser preenchidos ao enviar dados em 
     * massa para o banco de dados
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
}