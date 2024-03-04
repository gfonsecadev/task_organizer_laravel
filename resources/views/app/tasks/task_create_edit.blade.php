@extends('layouts/app')

@section('content')
    <div class="container">
        {{-- se a variavel estiver setada então é atualização senão é criação --}}
        @if (isset($task))
            <form method="post" action={{ route('task.update', $task->id) }}>
                @csrf
                @method('PUT')
            @else
                <form method="post" action={{ route('task.store') }}>
                    @csrf
        @endif

       {{-- neste formulario utilizei logica da variavel $errors para declarar classe css do  bootstrap para os inputs e para imprimor uma div contendo o erro --}}
        <div class="form-group">
            <label for="nameId">Nome da tarefa</label>
            <input type="text" class="form-control {{ $errors->has('name_task') ? 'is-invalid' : '' }}" name="name_task"
                value="{{ isset($task) ? $task->name_task : old('name_task') }}" id="nameId">
            <div style="color: red">{{ $errors->has('name_task') ? $errors->first('name_task') : '' }}</div>
        </div>

        <div class="form-group ">
            <label for="dateLimitId">Data limite</label>
            <input type="date" class="form-control {{ $errors->has('date_limit_task') ? 'is-invalid' : '' }}"
                name="date_limit_task" value="{{ isset($task) ? $task->date_limit_task : old('date_limit_task') }}"
                name="date_limit_task" id="dateLimitId">
            <div style="color: red">{{ $errors->has('date_limit_task') ? $errors->first('date_limit_task') : '' }}</div>
        </div>

        <div class="form-group ">
            <label for="descriptionId">Descrição da tarefa</label>
            <textarea class="form-control {{ $errors->has('description_task') ? 'is-invalid' : '' }}" maxlength="500"
                     name="description_task" id="descriptionId" rows="3">{{ isset($task) ? $task->description_task : old('description_task') }}</textarea>
            <div style="color: red">{{ $errors->has('description_task') ? $errors->first('description_task') : '' }}
            </div>
        </div>

        <div class="d-flex justify-content-around">
           <button type="submit" class="btn btn-primary w-25">{{ isset($task) ? 'Atualizar tarefa' : 'Criar tarefa' }}</button>
           <a href="{{route('task.index')}}" class="btn btn-danger w-25">Cancelar</a>
        </div>
    </form>
    </div>
@endsection
