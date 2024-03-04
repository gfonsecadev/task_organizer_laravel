@extends('layouts.app')
{{-- view responsável por rederizar mensagem ao usuário para verificar email --}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verificação de endereço de email</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Um novo email foi enviado para seu endereço de email!
                        </div>
                    @endif

                    Para concluirmos seu cadastro e liberar o acesso precisamos confirmar seu endereço de email, por favor verifique sua caixa de entrada.
                    Se nenhum email foi recebido,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">clique aqui para solicitar outro.</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
