<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        {{-- Bootstrap icons --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body style="background-size: 200px; background-attachment: fixed; background-image: url({{asset('images/background.png')}});" >
        <nav class="navbar bg-secondary navbar-expand-sm navbar-dark sticky-top">
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navTask">
                <h3 class="navbar-toggler-icon"></h3>
            </button>
            <div class="collapse navbar-collapse" id="navTask">
            <ul class="navbar-nav ml-auto">
            @if (Route::has('login'))

                    @auth
                      <li class="nav-item">  <a href="{{ url('/app/task') }}" class="nav-link">Minha conta</a></li>
                    @else
                     <li class="nav-item">   <a href="{{ route('login') }}" class="nav-link">Entrar</a></li>


                        @if (Route::has('register'))
                          <li class="nav-item">  <a href="{{ route('register') }}" class="nav-link">Cadastrar-se</a></li>
                        @endif
                    @endauth

            @endif
            </ul>
            </div>
        </nav>

        <div class="pt-4 pb-3 text-center" style="background-color: rgb(141,223,244)">
            <h1 class="font-weight-bold text-white">Organize suas tarefas com Task Organizer, uma maneira facil e intuitiva de acompanhar sua rotina.</h1>
            <img class="m-auto"  src="{{asset('images/container.png')}}" height="200">
        </div>

            <div class="container">
                <div class="row">
                    <div class="card col-12 col-sm-6 col-lg-3">
                        <div class="card-body text-center">
                            <img src="{{asset('images/notification.png')}}" height="100">
                            <div>
                                <h4>Notificações</h4>
                                <p>Receba uma notificação em seu email a cada tarefa criada</p>
                            </div>
                        </div>
                    </div>
                    <div class="card col-12 col-sm-6 col-lg-3">
                        <div class="card-body text-center">
                            <img src="{{asset('images/calendar.png')}}" height="100">
                            <div>
                                <h4>Calendário</h4>
                                <p>Escolha uma data para finalizar e nunca mais esqueça suas tarefas</p>
                            </div>
                        </div>
                    </div>
                    <div class="card col-12 col-sm-6 col-lg-3">
                        <div class="card-body text-center">
                            <img src="{{asset('images/task.png')}}" height="100">
                            <div>
                                <h4>Liberdade</h4>
                                <p>Total liberdade para criar editar ou excluir quando quiser</p>
                            </div>
                        </div>
                    </div>
                    <div class="card col-12 col-sm-6 col-lg-3">
                        <div class="card-body text-center">
                            <img src="{{asset('images/export_icon.png')}}" height="100">
                            <div>
                                <h4>Exporte</h4>
                                <p>Você tem total liberdade de fazer download de suas tarefas quando quiser</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="text-white row p-4" style="background:  rgb(171,195,255)">
                <div class="col-12 col-md-7">
                    <h2>O que é o Task Organizer?</h2>
                    <p class="lead mr-4">Sabemos como a rotina pode ser difícil de se organizar. Foi com isso que nasceu o Task Organizer seu amigo na hora de organizar sua vida. Com Task Organizer você cria sua tarefa e nunca mais esquece de cumpri-la.</p>
                </div>
                <img class="col-12 col-md-4" src="{{asset('images/what.png')}}">
            </div>

        <footer class="bg-secondary d-flex flex-column text-white text-center pt-2">
            <h4>Todos os direitos reservados</h4>
            <p>&copy; Task Organizer</p>
        </footer>
    </body>
</html>
