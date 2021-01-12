<!-- Recebendo o layout da layout.blade.php -->
@extends ('layout')
<!-- Passando os dados para o cabeçalho -->
@section('cabecalho')
  <h2> Lista de Orçamentos </h2>
  <a href="{{ route('add_orcamento') }}" class="btn btn-dark " style="right: 3%;">
    Cadastrar
  </a>
@endsection
<!-- Passando os dados para o conteudo da pagina -->
@section('conteudo')
<!-- verificando se tem mensagem para ser exibida -->
  @if(!empty($mensagem))
    <div class="container alert alert-success mt-5" >
      {{ $mensagem }}
    </div>
  @endif

  <!-- div que exibira mensagens de erro caso os campos de data não estejam preenchidos corretamente -->
  <div class="container alert alert-danger mt-5" id="erro" style="display: none">
  </div>

<!-- div que contem todo o conteudo da pagina -->
  <div class="container">
    <div class="d-flex justify-content-between w-100 mt-5">
        <div>
            <label for="cliente" class="">Cliente:
                <input class="form-control col-12" id="cliente" type="text" onkeyup="filtroCliente()" placeholder="Digite o nome do Cliente">
            </label>
            <label for="vendedor" class="">Vendedor:
                <input class="form-control col-12" id="vendedor" type="text" onkeyup="filtroVendedor()" placeholder="Digite o nome do Vendedor">
            </label>
        </div>
        <div>
            <label for="cliente" class="">Data Inicio:
                <input class="form-control col-12" type="date" id="inicio" placeholder="Data Inicio">
            </label>
            <label for="cliente" class="">Data Fim:
                <input class="form-control col-12" type="date" id="fim" placeholder="fim">
            </label>
            <button class="btn bg-secondary text-white btn-sm mb-1" onclick="filtroData()" style="height: 40px">Filtrar pela Data</button>
        </div>
    </div>

    <br>
    <table class="table table-bordered table-striped">
      <thead>
        <th scope="col">Cliente</th>
        <th scope="col">Vendedor</th>
        <th scope="col">Data</th>
        <th scope="col" class="text-center">Detahes</th>
      </thead>
      <tbody id="myTable">
        @foreach($cadastros as $cadastro )
          <tr>
            <td>{{$cadastro->cliente}}</td>
            <td>{{$cadastro->vendedor}}</td>
            <td>{{\Carbon\Carbon::parse($cadastro->data)->format('d/m/Y')}}</td>
            <td>
              <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $cadastro->id }}" class="d-flex text-dark" style="text-decoration:none">
                <i class="fa fa-plus mt-1" style="font-size:24px; margin: 0 auto;"></i>
              </a>

            </td>
            <td>
              <form method="post" class="d-flex justify-content-around align-items-center"
                action="/cliente/{{ $cadastro->id }}"
                onsubmit="return confirm('Tem certeza que deseja remover o cliente: {{ addslashes($cadastro->cliente) }} ?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">
                  <i class="fa fa-trash-o" style="font-size:20px; color:#fff"></i>
                </button>
              </form>
            </td>
            <td>
              <a href="/cliente/editar/{{ $cadastro->id }}" class="d-flex justify-content-around align-items-center">
                <button class="btn btn-primary btn-sm" >
                  <i class="fa fa-edit"></i>
                </button>
              </a>
            </td>

          </tr>
          <!-- Modal -->
          <div class="modal fade " id="exampleModal{{ $cadastro->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-md modal-dialog-centered">
              <div class="modal-content bg-light">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Detalhes do Orçamento</h5>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="container bg-light">
                    <div class="d-flex justify-content-around ">
                        <div class="col-md-6">
                            <p><h6>Codigo:</h6>{{$cadastro->codigo}}</p>
                        </div>
                        <div class="col-md-6">
                            <p><h6>Valor:</h6>{{$cadastro->valor}}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-around">
                        <div class="col-md-6">
                            <p><h6>Cliente:</h6>{{$cadastro->cliente}}</p>
                        </div>
                        <div class="col-md-6">
                            <p><h6>Vendedor:</h6>{{$cadastro->vendedor}}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-around">
                        <div class="col-md-6">
                            <p><h6>Data:</h6>{{\Carbon\Carbon::parse($cadastro->data)->format('d/m/Y')}}</p>
                        </div>
                        <div class="col-md-6">
                            <p><h6>Horario:</h6>{{$cadastro->hora}}</p>
                        </div>
                    </div>
                    <hr>

                    <div class="container">
                        <p><h6>Descrição:</h6>{{$cadastro->descricao}}</p>
                    </div>
                    <hr>
                </div>
              </div>
            </div>
          </div>
          <!-- fim do modal -->
        @endforeach
      </tbody>
    </table>
  </div>

  <script type="text/javascript">
    /* function filtroCliente responsavel por filtra na tabela atraves do campo clientes */
    function filtroCliente() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("cliente");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) /* criando um loop na tr para pegar uma td espesifica */
        {
            td = tr[i].getElementsByTagName("td")[0]; /* buscando na tr a sua primeira td */
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) { /* ferificando na tabela se a na primeira td da primeira coluna o texto digitado no input */
                    tr[i].style.display = ""; /* se o texto for encontrado nada acontecera com a tabela */
                } else {
                    tr[i].style.display = "none"; /* se o texto não for encontrado a tr inteira sera escondida */
                }
            }
        }
    }

    /* function filtroVendedor responsavel por filtra na tabela atraves do campo vendedor */
    function filtroVendedor() {
        var input1, filter, table, tr, td, i;
        input = document.getElementById("vendedor");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        /* criando um loop na tr para pegar uma td espesifica */
        for (i = 0; i < tr.length; i++)
        {
         /* buscando na tr a sua segunda td */
         td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                /* ferificando na tabela se a na primeira td da primeira coluna o texto digitado no input */
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    /* se o texto for encontrado nada acontecera com a tabela */
                    tr[i].style.display = "";
                } else {
                    /* se o texto não for encontrado a tr inteira sera escondida */
                    tr[i].style.display = "none";
                }
            }
        }
    }

    /* function filtroData responsavel por filtra na tabela atraves do campo Data */
    function filtroData() {
      var input1, input2, table, tr, td, i, divErro;
      input1 = document.getElementById("inicio");
      input2 = document.getElementById("fim");

      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");

      divErro = document.getElementById("erro");
      /* verifica primeiro se os campos data estão vazios */
      if(input1.value == "" || input1.value == ""){
        /* exibi a divErro */
        divErro.style.display = "";
        /* exibe a mensagem para o usuario */
        divErro.textContent = "Por favor verifique se os campos de data estão corretos";
      }
      /* se os campos estiverem coretos ele começa a execultar o filtro */
      else{
        /* criando um loop na tr para pegar uma td espesifica */
        for (i = 0; i < tr.length; i++)
        {
          /* buscando na tr a sua ultima td */
          td = tr[i].getElementsByTagName("td")[2];
          /* formatando a data */
          str = td.innerHTML
          dateIndex = (str.substr(6)+'-'+str.substr(3, 2)+'-'+str.substr(0, 2));

          const dateStart = input1.value;
          const dateEnd = input2.value;
          /* verificando se a data inicial digita é maior do que a data final */
          if (input1.value > input2.value ) {
            /* exibi a divErro */
            divErro.style.display = "";
            /* exibe a mensagem para o usuario */
            mensagemDeErro.textContent = "A data de incio não pode ser maior do que a data final";

          } else {
            /* ferificando na tabela se a na primeira td da primeira coluna o texto digitado no input */
            if (dateStart <= dateIndex && dateEnd >= dateIndex) {
              /* se o texto for encontrado nada acontecera com a tabela */
              tr[i].style.display = "";
            }
            else {
              /* se o texto não for encontrado a tr inteira sera escondida */
              tr[i].style.display = "none";
            }
          }
        }
      }
    }
  </script>



@endsection
