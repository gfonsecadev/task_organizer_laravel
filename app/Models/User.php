<?php

namespace App\Models;

use App\Notifications\MyResetPasswordNotification;
use App\Notifications\MyVerificationEmailNotification;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

//A interface MustVerifyEmail nos garante que o usuário somente terá acesso se fizer a verificação de email na criação da conta
//Para que a verificação de email funcione no arquivo de rotas colocar a rota auth com array como: Auth::routes(["verify"=> true])
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    //como eu segui a nomenclatura para chave estrangeira do Laravel a foreign eu não preciso informar
   //esse metodo é somente para fins didáticos pois não utilizei
   //foi mais facil usar um where nas tarefas
    public function tasks(){
       return $this->hasMany(Task::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //esse metodo é implementado na classe herdada Authentificable
    //é responsável por disparar notificação de reset de senha
    //sobreescreverei para poder customizar a classe que customizará a view
    public function sendPasswordResetNotification($token)
    {  /*  essa é a classe original
        $this->notify(new ResetPasswordNotification($token)); */

        //minha classe customizada
        $this->notify(new MyResetPasswordNotification($token, $this->email, $this->name));
    }

    //Segue o mesmo do metodo acima estou sobreescrevendo
    public function sendEmailVerificationNotification()
    {   /* essa é a classe original
        $this->notify(new VerifyEmail); */

        //minha classe customizada
        $this->notify(new MyVerificationEmailNotification($this->name));
    }

}
