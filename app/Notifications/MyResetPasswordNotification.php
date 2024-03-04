<?php
/* minha própria classe de notificação de reset de senha */
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

//essa classe será chamada no metodo sobreescrito de User sendPasswordResetNotification($token)
class MyResetPasswordNotification extends Notification
{
    public $token;
    public $email;
    public $name;
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $email, $name)
    {
        $this->token=$token;
        $this->email=$email;
        $this->name=$name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

    //responsável por trazer texto do cabeçalho ,assunto etc da notificação
    //o caminho da classe original é \vendor\laravel\framework\src\Illuminate\Auth\Notifications\ResetPassword.php
    //O caminho da view que renderiza a notificação é \vendor\laravel\framework\src\Illuminate\Notifications\resources\views\email.blade.php
    public function toMail($notifiable)
        //url para redefinição que estará no botão da notificação
    {   $url=url(route('password.reset',[$this->token])."?email=$this->email");
        $minutes= config('auth.passwords.'.config('auth.defaults.passwords').'.expire');

        return (new MailMessage)
        ->greeting("Olá $this->name")
        ->subject(('Notificação de redefinição de senha'))
        ->line(('Você está recebendo este email por que nós recebemos uma solicitação de redefinição de senha para seu usuário'))
        ->action(('Redefinir senha'), $url)
        ->line(("Este link de redefinição de senha vai expirar em $minutes minutos"))
        ->salutation("Obrigado!")
        ->line(('Se você não solicitou nenhuma pedido de redefinição de senha desconsidere este email'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
