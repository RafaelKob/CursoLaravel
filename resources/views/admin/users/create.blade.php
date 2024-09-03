@extends('admin.layouts.app1')

@section('title', 'Cadastro dos usuários')

@section('content')

    <h1>Novo Usuário</h1>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf() {{--Autenticação usando função do laravel--}}
        {{-- Forma de autentificação via token de forma geral
            <input type="text" name="_token" value="{{ csrf_token() }}">
        --}}
        <input type="text" name="name" placeholder="Nome">
        <input type="email" name="email" placeholder="E-mail">
        <input type="password" name="password" placeholder="Senha">
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