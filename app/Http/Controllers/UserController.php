<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $user;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index() {
        $users = $this->user->all();
        $data = array("data" => array());

        foreach ($users as $value) {
            $id = $value->id;
            $sexo = $value->sexo == 'M' ? 'MASCULINO' : 'FEMININO';
            $nascimento = new \DateTime($value->nascimento);

            $editar = "<button class='btn btn-sm btn-warning btn-editar' data-id='$id'>Editar</button>";
            $excluir = "<button class='btn btn-sm btn-danger btn-excluir' data-id='$id'>Excluir</button>";

            $row = array(
                $id,
                $value->nome,
                $nascimento->format('d/m/Y'),
                $sexo,
                $value->cep,
                $value->endereco,
                $value->numero,
                $value->complemento,
                $value->bairro,
                $value->uf,
                $value->cidade,
                $editar,
                $excluir
            );
            $data['data'][] = $row;
        }


        return $data;
    }

    public function show($id) {
        return $this->user->find($id);
    }

    public function store(Request $req) {

        $this->user->create($req->all());

        return response()->json(['message' => 'Usuário criado com sucesso!']);
    }

    public function update($id, Request $req) {
        $course = $this->user->find($id);
        $course->update($req->all());
        return response()->json(['message' => 'Usuário atualizado com sucesso!']);
    }

    public function destroy($id) {

        $course = $this->user->find($id);
        $course->delete();
        return response()->json(['message' => 'Usuário removido com sucesso!']);
    }
}
