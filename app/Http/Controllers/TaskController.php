<?php

namespace App\Http\Controllers;

use App\Exports\TasksExport;
use App\Mail\MessageTaskMail;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        //retorna true ou falso
        //exemplo de uso do helper auth
        /* if(auth()->check()){
            $nome=auth()->user()->name;
            $id=auth()->user()->id;
            $email=auth()->user()->email;

        }
        return "chemamos até aqui! $nome de id $id e email  $email"; */
        //retornará somente as tarefas do usuário logado

        //ordenando a coluna por data mais velha pra mais nova onde o usurio é o logado
        //paginação também foi aplicado
        $tasks=DB::table('tasks')->where("user_id",auth()->user()->id)->orderBy("date_limit_task")->paginate(5);

        return view("app.tasks.task_index",["tasks"=>$tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /* redenriza a view de criação */
    public function create()
    {
        return view("app.tasks.task_create_edit");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /* recebe da view de criação os dados para serem salvos no BD */
    public function store(Request $request)
    {
        $rules=[
            "name_task"=>"required",
            "date_limit_task"=>"required",
            "description_task"=> "required"
        ];
        $params=[
            "name_task.required"=>"Insira um nome  para esta Task.",
            "date_limi_task.required"=>"Insira uma data.",
            "description_task.required"=>"Insira uma descrição"
        ];
        /* criei um variavel para adicionar a mais o id do usuário autenticado para preencher a foreign */
        $request->validate($rules,$params);
        $allData=$request->all();
        $allData["user_id"]=auth()->user()->id;
        //o retorno da persistencia no BD é o objeto Task
        $task= Task::create($allData);
        //enviamos um email para o usuário ativo com Markdown Mailables personalizada
        Mail::to(auth()->user()->email)->send(new MessageTaskMail($task));

        return redirect()->route("task.show",$task->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $Task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        if(auth()->user()->id== $task->user_id){
        return view("app.tasks.task_show",["task"=>$task]);
        }
        return redirect()->route("task.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $Task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view("app.tasks.task_create_edit",["task"=>$task]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $Task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        if($task->user_id== auth()->user()->id){
            $task->update($request->all());
            return redirect()->route("task.show",$task->id);
        }
        return redirect()->route("task.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $Task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route("task.index");
    }

    //recupero a extensão de arquivo que o usuário deseja fazer o download
    public function export($type){

        //se a variavel recebida estiver no array ao lado
        if(in_array($type,['xls', 'csv', 'pdf'])){//esse utilizará o laravel excel para xls e csv e  laravel excel com extensão mpdf para pdf;
       return Excel::download(new TasksExport, "task.$type");

        }elseif($type=='pdf_custom'){//esse utilizará o DomPdf
            $tasks=auth()->user()->tasks()->get();//tarefas do usuario
            $pdf = Pdf::loadView('app.tasks.task_export_pdf',['tasks'=>$tasks]);//carregamento da view
            //$pdf->getDomPDF()->setPaper("a4","landscape");//tipo de papel e orientação
            //return $pdf->download('task.pdf');//faz o download
            return $pdf->stream('task.pdf');//abri um leitor de pdf no navegador
        }
        //se o não for passado um tipo de arquivo aceito redireciona para index
        return redirect()->route('task.index');


    }
}
