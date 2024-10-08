<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Auth\Access\Gate as AccessGate;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        //$user = User::first(); -- chamou apenas o primeiro usuario
        //return "Ola {$user->name}! ({$user->email})"; // dificilmente retorna strings
        //return view('admin.users.index', compact('user'));
        
        $users = User::paginate(15); //para paginar de forma automatica pelo laravel e facilitar o desempenho para nao carregar tudo //User::all(); //parece estatico mas é dinamico
        return view('admin.users.index', compact('users'));
    }

    public function create() {
        return view('admin.users.create'); //convenção deixar o nome do metodo com o mesmo nome da view 'create'
    }

    public function store(StoreUserRequest $request) //simplificação do laravel, dessa forma não preciso colocar na função $request = new Request;
    {
        //dd($request->get('name')); //da pra pegar apenas o nome dessa forma ou outro dado
        //dd($request->all()); pegaria todos com o all
        //dd($request->except('_token')); dd serve para verificar qual array estara requisitando
        User::create($request->validated()); //pega apenas valores validados

        return redirect() 
                    -> route('users.index') //retorna para a pagina de registro automaticamente
                    -> with('success', 'Usuário criado com sucesso'); //mostrar mensagem automatica de usuario criado com sucesso apos redirecionar
        
        
        /* criada pelo professor do curso
        User::create($request->validated());

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuário criado com sucesso');
        */
    }

    public function edit(string $id)
    {
        //$user = User::where('id', '=', $id)->fists(); //o comando where serve para buscar o user correto - primeiro campo a coluna, segundo campo qual comparação sera feita, e com qual variavel
        //$user = User::where('id', $id)->fists(); //por padrão a comparação é de igual entao nao precisa por, poderia usar firstorfail() que retornaria erro 404 ao invez de null
        
        
        if (!$user = User::find($id)) {
            return redirect()->route('users.index')->with('message', 'edit Usuario não encontrado');
        }
        return view('admin.users.edit', compact('user'));

        /* Feito pelo professor do curso
        // $user = User::where('id', '=', $id)->first();
        // $user = User::where('id', $id)->first(); // ->firstOrFail();
        if (!$user = User::find($id)) {
            return redirect()->route('users.index')->with('message', 'Usuário não encontrado');
        }

        return view('admin.users.edit', compact('user'));
        */
    }

    public function update(UpdateUserRequest $request, string $id)
    {   
        if (!$user = User::find($id)) {
            return back()->with('message', 'update Usuario não encontrado');
        }

        //$data = $request->validated() errado porque o validated pegaria inclusive a senha como null se nao fosse informado nada dando erro
        $data = $request->only(['name', 'email']);
        if($request->password) {
            $data ['password'] = bcrypt($request->password);
        }

        $user -> update($data);

        return redirect() 
                    -> route('users.index') //retorna para a pagina de registro automaticamente
                    -> with('success', 'Usuário editado com sucesso');


        /*
        if (!$user = User::find($id)) {
            return back()->with('message', 'Usuário não encontrado');
        }
        $data = $request->only('name', 'email');
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuário editado com sucesso');
        */
    }

    public function show(string $id)
    {
        if (!$user = User::find($id)) {
            return redirect()->route('users.index')->with('message', ' show Usuario não encontrado');
        }
        return view('admin.users.show', compact('user'));

        /*
        if (!$user = User::find($id)) {
            return redirect()->route('users.index')->with('message', 'Usuário não encontrado');
        }

        return view('admin.users.show', compact('user'));
        */
    }

    public function destroy(string $id)
    {
        //Da para usar o gate criado para verificar dentro da função se é um admin ao invez de usar o can no blade
        /*
        if (Gate::denies('is-admin')) {
            return redirect()->route('users.index')->with('message', 'Você não é um admnistrador');
        } */


        if (!$user = User::find($id)) {
            return redirect()->route('users.index')->with('message', 'destroy Usuario não encontrado');
        }

        if (optional(Auth::user())->id === $user->id) {
            return redirect()->route('users.index')->with('message', 'Você não pode deletar o seu próprio perfil');
        }
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuário deletado com sucesso');
        

        /*
        // if (Gate::denies('is-admin')) {
        //     return back()->with('message', 'Você não é um administrador');
        // }
        if (!$user = User::find($id)) {
            return redirect()->route('users.index')->with('message', 'Usuário não encontrado');
        }
        if (Auth::user()->id === $user->id) {
            return back()->with('message', 'Você não pode deletar o seu próprio perfil');
        }
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuário deletado com sucesso');
        */
        
    }
}
