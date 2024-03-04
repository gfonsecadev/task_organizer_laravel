<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageTaskMail extends Mailable
{
    public $idTask;
    public $urlTask;
    public $dateTask;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    /* passarei a tarefa para a view ter acesso a ela */
    public function __construct(Task $task)
    {
        $this->idTask=$task->id;
        $this->urlTask="http://localhost:8000/app/task/$task->id";
        //strtotime converte para timestamp e date converte o timestamp para o formato desejado
        $this->dateTask=date('d/m/y',strtotime($task->date_limit_task));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //esse metodo chama a view vinculada na hora da criação
        return $this->markdown('emails.message-task')->subject("Nova Tarefa no Task Organizer");
    }
}
