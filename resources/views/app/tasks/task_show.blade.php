@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <img src="{{ asset('images/task_icon.png') }}" width="50px" alt="...">
                <h3 class="card-title">{{ ucfirst($task->name_task) }}</h3>
            </div>

            <div class="card-body">
                <strong>Data final:</strong>
                <p>Você tem até o dia
                   <strong>{{ date('d/m/y', strtotime($task->date_limit_task)) }}</strong>
                    para finalizar esta tarefa</p>
                <strong>Descrição:</strong>
                <p> {{ $task->description_task }}</p>
            </div>
            <div class="card-footer text-center">

                <a href="{{route("task.index")}}" class="btn btn-secondary w-25">Voltar</a>

            </div>
        </div>
    </div>
@endsection
