<?php

namespace App\Exports;

use App\Models\Task;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TasksExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {  /*  //a tabela inteira será exportada
        return Task::all(); */

        //chamo o relacionamento criado na classe User que traz todas tarefas do usuario
        return auth()->user()->tasks()->get();

    }

    //classe implementada da interface WithHeadings
    //responsável por contruir os titulos das colunas da tarefa neste caso
    //essa versão é exigido o tipo de retorno por isso o ': array'
    public function headings() : array{
        return ["identificador", "Nome da tarefa","Data final", "Descrição"];
    }

    //classe implementada da interface WithMapping
    //responsável por percorrer cada linha da coluna
    //util para trazer ou manipularmos os dados como quizermos
    public function map($row) : array{
        return [$row->id,
                $row->name_task,
                date("d/m/y",strtotime($row->date_limit_task)),
                $row->description_task];
    }
}
