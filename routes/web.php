<?php

use App\Mail\MessageTaskMail;
use GuzzleHttp\Middleware;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//metódo principal de rotas
//verify nos garante que os usuário passem por verificação de email através da implementação da MustVerifyEmail em User
Auth::routes(["verify"=> true]);

//fins didádicos retorno da classe de email em uma rota
/*  Route::get('/send_email',function(){
    return new MessageTaskMail();
    //Mail::to("gilmar.testes05@gmail.com")->send(new MessageTestMail());
 }); */

//middleware antes do prefixo que agrupa as rotas
//middleware auth nos garante estar logado com um usuário válido e verified que o usúario criado tenha feito a verificação de email na criação da conta de usuário
Route::middleware(["auth","verified"])->prefix("/app")->group(function(){
    Route::resource("/task","App\Http\Controllers\TaskController");
});

/* rota para fazer download das tarefas utilizando o mesmo controlador acima mais criando uma rota adicional */
//coloquei fora do prefix app porque não funcionava dentro do mesmo.
Route::get("/task/export/{type}","App\Http\Controllers\TaskController@export")->name("task.export")->middleware("auth");
