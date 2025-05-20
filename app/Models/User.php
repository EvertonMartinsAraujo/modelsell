<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

     /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
     protected $table = 'user';
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'role'
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



        //REGRAS PARA CRIAÇÃO
    public static function regras(){
        return [
            'id' => 'required|Integer',
	        'name' => 'required|string|max:200',
	        'email' => 'email|unique',
            'password' => 'required|string|min:6|max:20',
            'role' => 'required'
            
	    ];
    }
    //RETORNO
    public static function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'email.email' => 'O e-mail informado é invalido',
	        'email.unique' => 'O e-mail informado ja possui cadastro',
            'password.min' => 'Senha muito curta',
            'password.max' => 'A senha ultrapassou o limite permitido',
        ];    
    }



    ///////////////////////////JWT
        use Notifiable;

    // Rest omitted for brevity

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

}
