<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ValidaFormRequest;

use App\Orcamento;

use Illuminate\Support\Facades\DB;


class ClienteController extends Controller
{
    /* function responsavel por exibir a tabela e as mensagens na tela principal */
    public function cadastro(Request $request)
    {
        $cadastros = Orcamento::all();
        $mensagem = $request->session()->get('mensagem');
        return view("cadastro.index", compact('cadastros', "mensagem"));
    }
    /* function responsavel por redirecionar para a tela de cadastro e passar os dados necessarios */
    public function create(Request $request)
    {
        $btn='Adicionar Novo';
        $time = 'time';
        $type = 'date';
        $id = '';
        $titulo = "Adicionar";
        return view('cadastro.create', compact("titulo", "id", "type", "time", "btn"));
    }

    /* function responsavel por cadastra os dado no banco de dados */
    public function store(ValidaFormRequest $request)
    {
        $cadastros = Orcamento::create($request->all());

        $request->session()
            ->flash(
                'mensagem',
                "Orçamento cadastrado com sucesso"
            );
        return redirect()->route('tabela_orcamentos');
    }
    /* function responsavel por excluir os dados */
    public function destroy(Request $request)
    {
        Orcamento::destroy($request->id);
        $request->session()
            ->flash(
                'mensagem',
                "Orçamento foi excluido com sucesso"
            );
        return redirect()->route('tabela_orcamentos');
    }
    /* function responsavel por preencher o formulario para aeditação*/
    public function edit(Request $request, $id){
        $orcamentos = DB::select(
            'select * from orcamentos where id = :id', ['id' => $id]
        );

        foreach ($orcamentos as $user) {

        }
        $btn= "Editar";
        $time = 'text';
        $type = 'text';
        $titulo = 'Editar';
        return view('cadastro.create', compact("titulo", "user", "orcamentos", "id", "type", "time", "btn"));
    }
    /* function responsavel por editar os dados do banco */
    public function editar(ValidaFormRequest $request, $id){
        // Pegando os nomes que foram passados pelo request
        $codigo = $request->codigo;
        $cliente = $request->cliente;
        $data = $request->data;
        $hora = $request->hora;
        $vendedor = $request->vendedor;
        $valor = $request->valor;
        $descricao = $request->descricao;

        /* Pegando o valor do banco atraves do $id passado por parametro na
        rota:    */
        $cadastros = Orcamento::find($id);
        $cadastros->codigo = $codigo;
        $cadastros->cliente = $cliente;
        $cadastros->data = $data;
        $cadastros->hora = $hora;
        $cadastros->vendedor = $vendedor;
        $cadastros->valor = $valor;
        $cadastros->descricao = $descricao;
        $cadastros->save(); //salvando os novos dados passado pelo request no msm id

        $request->session() // enviando mensagem de sucesso
                ->flash(
                    'mensagem',
                    "Orçamento atualizado com sucesso"
                );
        return redirect()->route('tabela_orcamentos');
    }
}

