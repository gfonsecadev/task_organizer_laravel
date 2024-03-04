<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <style>
            /* recurso do Dompdf para quebrar pagina no pdf */
            .page-break{
                /* page-break-before: always; */
                page-break-after: always;
            }
        </style>
    </head>

<body >
    <div class=" bg-secondary text-center text-white p-4"><h1>{{'Tarefas de '.auth()->user()->name}}</h1></div>
    <table  class="table table-secondary table-striped table-bordered text-center" style="table-layout: fixed;">
        <thead style="font-size: 20px">
            <tr>
            <th>id</th>
            <th>Prazo final</th>
            <th >Descrição</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ date("d/m/y" , strtotime($task->date_limit_task)) }}</td>
                    <td style="word-wrap: break-word;">{{ $task->description_task }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>

{{-- <div class="page-break"></div>
<h3>pagina1</h3> --}}

</body>

</html>
