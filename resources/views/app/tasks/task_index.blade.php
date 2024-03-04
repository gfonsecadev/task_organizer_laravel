@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between px-3">
            <h2 class="font-weight-bold">Minhas tarefas</h2>
            <!-- Split dropend button -->

            <div class="d-flex">
                <div class=" dropdown">
                    <span role="button" class="dropdown-toggle " data-toggle="dropdown">
                        <i class="bi bi-download text-success" style="font-size: 2rem"></i>
                    </span>

                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('task.export', 'xls') }}" target="_blank">Excel</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('task.export', 'csv') }}" target="_blank">Csv</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('task.export', 'pdf') }}" target="_blank">Pdf simples</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('task.export', 'pdf_custom') }}" target="_blank">Pdf customizado</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <a href="{{ route('task.create') }}" class="bi bi-plus-circle-fill text-primary ml-3"
                        style="font-size: 2rem;"></a>
                </div>
            </div>
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="text-center" scope="col">identificador</th>
                    <th class="text-center" scope="col">Nome da tarefa</th>
                    <th class="text-center" scope="col">Data final</th>
                    <th class="text-center" scope="col">Visualizar</th>
                    <th class="text-center" scope="col">Editar</th>
                    <th class="text-center" scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <th class="text-center" scope="row">{{ $task->id }}</th>
                        <td class="text-center">{{ $task->name_task }}</td>
                        <td class="text-center">{{ date('d/m/Y', strtotime($task->date_limit_task)) }}</td>
                        <td class="text-center" class="text-center"><a href="{{ route('task.show', $task->id) }}">
                                <i class="bi bi-eye-fill"></i></a>
                        </td>

                        <td class="text-center" class="text-center"><a href="{{ route('task.edit', $task->id) }}">
                                <i class="bi bi-pencil-fill text-success"></i></a>
                            </td">

                        <td class="text-center" class="text-center">
                            <form id="form_{{ $task->id }}" action="{{ route('task.destroy', $task->id) }}"
                                method="post">
                                @csrf
                                @method('DELETE')
                                <a role="button" onclick="document.getElementById('form_{{ $task->id }}').submit()">
                                    <i class="bi bi-trash3-fill text-danger "></i>
                                </a>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        {{-- a paginação só será mostrada se mais de 1 pagina existir --}}
        @if ($tasks->lastPage() > 1)
            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item {{ $tasks->currentPage() == 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $tasks->previousPageUrl() }}">Anterior</a>
                    </li>

                    @for ($i = 1; $i <= $tasks->lastPage(); $i++)
                        {{-- logica para aplicar classe css do bootstrap na li de acordo com a rota ativa --}}
                        <li class="page-item {{ $tasks->currentPage() == $i ? 'active' : '' }}">

                            <a class="page-link" href="{{ $tasks->url($i) }}">{{ $i }}</a>

                        </li>
                    @endfor

                    <li class="page-item  {{ $tasks->currentPage() == $tasks->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $tasks->nextPageUrl() }}">Próximo</a>
                    </li>
                </ul>
            </nav>
        @endif
    </div>
@endsection
