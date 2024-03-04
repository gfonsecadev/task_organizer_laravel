<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    //use renderiza uma trait
    //uma trait é um mecanismo que permite a reutilização de código em diferentes classes.
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.

     * @var string
     */

     //ESSE METODO ABAIXO EXISTE NO CONTEXTO DO use ResetsPasswords
     //Para alterar as validações eu sobreescrevi o método.
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:4',
        ];
    }
    protected $redirectTo = RouteServiceProvider::HOME;
}
