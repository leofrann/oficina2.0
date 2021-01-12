<!-- Recebendo o layout da layout.blade.php -->
@extends ('layout')
<!-- Passando os dados para o cabeçalho -->
@section ('cabecalho')
<!-- passando o titulo que irar no cabeçalho -->
    {{ $titulo }}
    <a href="/cliente">
    <button class="btn btn-dark">Voltar</button>
    </a>
@endsection
<!-- Passando os dados para o conteudo da pagina -->
@section ('conteudo')
<!-- verificando se a algum erro no formulario -->
@if ($errors->any())
<!-- exibindo erro -->
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- div que contem o conteudo da pagina -->
<div class="container mt-5">
<!-- verificando o id para decidir se vai para o form de cadastrar ou o de editar -->
@if(!$id)
    <form method="post" >
    @csrf

@else
    <form method="post" action='/cliente/{{ $id }}/editar' >
        @method('PUT')
        @csrf
@endif
        <div class="form-group container w-50">

            <div class="d-flex justify-content-between ">
                <div class="container-fluid col-lg-7">
                    <label for="cliente" class="form-label">Nome do Cliente: </label>
                    <input type="text" class="form-control" id="cliente" value="@if(!empty($user->codigo)){{$user->cliente}}@endif " name="cliente">
                </div>
                <div class="container-fluid col-lg-5">
                    <label for="data" class="form-label ">Data: </label>
                    <input type="{{ $type }}" class="form-control " id="data" value="@if(!empty($user->codigo)){{\Carbon\Carbon::parse($user->data)->format('d/m/Y')}}@endif " name="data" >
                </div>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <div class="container-fluid col-lg-8">
                    <label for="vendedor" class="form-label">Nome do vendedor: </label>
                    <input type="text" class="form-control" id="vendedor" value="@if(!empty($user->codigo)){{$user->vendedor}}@endif " name="vendedor">
                </div>
                <div class="container-fluid col-lg-4">
                    <label for="hora" class="form-label">Horario: </label>
                    <input type="{{ $time }}" class="form-control " id="hora" value="@if(!empty($user->codigo)){{$user->hora}}@endif " name="hora">
                </div>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <div class="container-fluid">
                    <label for="codigo" class="form-label">Codigo: </label>
                    <input type="text" class="form-control" id="codigo" value="@if(!empty($user->codigo)){{$user->codigo}}@endif "  name="codigo" >
                </div >

                <div class="container-fluid">
                    <label for="valor" class="form-label">Valor: </label>
                    <input type="text" class="form-control" id="valor" value="@if(!empty($user->codigo)){{$user->valor}}@endif " name="valor">
                </div>
            </div>

            <div class="mt-3 container-fluid">
                <label for="descricao" class="form-label">Descrição: </label>
                <textarea type="text" class="form-control" id="descricao" value="" name="descricao">@if(!empty($user->codigo)){{$user->descricao}}@endif </textarea>
            </div>
            <div class="mt-3 container-fluid">
                <button class="mt-5 btn btn-dark">{{ $btn }}
                </button>
            </div>
        </div>

    </form>
</div>
@endsection
