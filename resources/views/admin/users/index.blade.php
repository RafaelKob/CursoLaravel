@extends('admin.layouts.app1')

@section('title', 'Listagem dos usuários')

@section('content')

{{-- Dentro da seção content coloca o conteudo dinamico da pagina --}}

    <h1>Usuários</h1>

    <a href="{{ route('users.create') }}">Adicionar Usuário</a> {{--Adicionar usuario--}}

    <x-alert/> {{-- utilizando o component criado alert.blade.php --}}

    <table>
        <thead>
            <tr>
                <th>Nome: </th>
                <th>Email: </th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        {{--
           @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user-> email }}</td>
                    <td>-</td>
                </tr>
            @endforeach
        Dessa forma mostra todos os dados, mas se nao tiver nenhum ficara em branco, com forelse é possivel colocar um tipo de else se tiver vazio
        --}}

            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user-> email }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                        <a href="{{ route('users.show', $user->id) }}">Detalhes</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="100">Nenhum usuario cadastrado no banco</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $users->links() }} {{-- Para fazer os links automaticos de paginação do comando usado no Usercontroler.php --}}

@endsection
