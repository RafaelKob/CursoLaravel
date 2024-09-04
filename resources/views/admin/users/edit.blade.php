@extends('admin.layouts.app1')

@section('title', 'Editar Usuario')

@section('content')

    <h1>Editar o usuario {{ $user->name }}</h1>

    <x-alert/> {{-- utilizando o component criado alert.blade.php --}}

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf() {{--Autenticação usando função do laravel--}}
        {{--<input type="text" name="_method" value="PUT"> mudar metodo manualmente ja que nao suporta o put--}} 
        @method('put') {{-- Laravel ja da esse metodo mais facil --}}
        <input type="text" name="name" placeholder="Nome" value="{{ $user->name }}">
        <input type="email" name="email" placeholder="E-mail" value="{{ $user->email }}">
        <input type="password" name="password" placeholder="Senha"> {{--tirar se nao quiser deixar usuario mudar a senha dessa forma--}}
        <button type="submit">Cadastrar</button>
    </form>

@endsection


<?php
/*
@extends('admin.layouts.app')

@section('title', 'Criar Novo Usuário')

@section('content')
    @include('admin.users.partials.breadcrumb')
    <div class="py-6">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-4">
            Novo Usuário
        </h2>
    </div>
    {{-- @include('admin.includes.errors') --}}
    <form action="{{ route('users.store') }}" method="POST">
        @include('admin.users.partials.form')
    </form>
@endsection
*/
?>

<?php
/*
@extends('admin.layouts.app')

@section('title', 'Editar o Usuário')

@section('content')
    @include('admin.users.partials.breadcrumb')
    <div class="py-6">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-4">
            Editar o Usuário {{ $user->name }}
        </h2>
    </div>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @method('put')
        @include('admin.users.partials.form')
    </form>
@endsection
*/
?>