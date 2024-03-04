{{-- essa view será disparada pela classe correspondente markdown --}}
@component('mail::message')
# Criação de nova tarefa de identificação {{$idTask}}

Uma nova tarefa foi criada no seu perfil com data final: <strong>{{$dateTask}}</strong>. Clique no botão abaixo para mais detalhes

@component('mail::button', ['url' => $urlTask])
Ver tarefa
@endcomponent

Atenciosamente,<br>
{{ config('app.name') }}
@endcomponent
