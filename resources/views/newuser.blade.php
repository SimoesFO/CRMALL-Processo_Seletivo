<?php
$id = isset( $_GET['id'] ) ? $_GET['id'] : '';
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> -->
        <link href="<?php echo asset('js/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?php echo asset('js/datatables/datatables.min.css') ?>" rel="stylesheet">
        <link href="<?php echo asset('js/datatables/plugins/bootstrap/datatables.bootstrap.css') ?>" rel="stylesheet">
        <link href="<?php echo asset('js/bootstrap-datepicker/css/datepicker.css') ?>" rel="stylesheet">

        <!-- Styles -->
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                background-color: #f8f9f9 ;
            }
        </style>
    </head>
    <body>
        <div class="col-md-6 col-md-offset-3">
            <div style="text-align: center; color: #555;">
                <h1>CRMALL - Processo Seletivo</h1>
                <br /><br />
            </div>

            <div>
                <form>
                    <input type="hidden" class="form-control" id="id" name="id" value="<?= $id ?>">
                    <div class="form-group row">
                        <label for="nome" class="col-sm-2 col-form-label">Nome:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control required" id="nome" name="nome">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nascimento" class="col-sm-2 col-form-label">Nascimento:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control required" id="nascimento" name="nascimento">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sexo" class="col-sm-2 col-form-label">Genêro:</label>
                        <div class="col-sm-10">
                            <select id="sexo" name="sexo" class="form-control" required>
                                <option value="M" selected>Masculino</option>
                                <option value="F">Feminino</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cep" class="col-sm-2 col-form-label">Cep:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control required" id="cep" name="cep">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="endereco" class="col-sm-2 col-form-label">Endereço:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control required" id="endereco" name="endereco">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="numero" class="col-sm-2 col-form-label">Numero:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control required" id="numero" name="numero">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="complemento" class="col-sm-2 col-form-label">Complemento:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="complemento" name="complemento">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bairro" class="col-sm-2 col-form-label">Bairro:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control required" id="bairro" name="bairro">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="uf" class="col-sm-2 col-form-label">UF:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control required" id="uf" name="uf">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cidade" class="col-sm-2 col-form-label">Cidade:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control required" id="cidade" name="cidade">
                        </div>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <button class="btn btn-default" id="btn-voltar" onclick="history.back()">Voltar</button>
                        <button class="btn btn-primary" id="btn-salvar">Salvar</button>
                    </div>
                </form>
            </div>
        </div>

        <script type="text/javascript" src="<?php echo asset('js/jquery.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo asset('js/bootstrap/js/bootstrap.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo asset('js/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo asset('js/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js') ?>"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $(function() {

                $("#nascimento").datepicker({
                    format: 'dd/mm/yyyy',
                    todayHighlight: true,
                    clearBtn: true,
                    orientation: "bottom auto",
                    language: 'pt-BR'
                });

                $("#cep").on('change', function() {
                    let cep = $(this).val();

                    getCEP(cep);
                });

                $("#btn-salvar").on('click', function(e) {
                    e.preventDefault();
                    let errors = validaForm();

                    if(errors.length == 0) {
                        salvarCadastro();
                        return;
                    }

                    let message = errors.join("<br />");

                    Swal.fire({
                        position: 'top',
                        icon: 'warning',
                        title: "Campos Obrigatórios",
                        html: message,
                        showConfirmButton: true,
                    });

                });

                let id = '<?= $id ?>';
                carregaCadastro(id);

            });


            function validaForm() {

                let requires = document.querySelectorAll('.required');

                let message = Array();
                requires.forEach(element => {
                    let name = element.name;
                    name = name.charAt(0).toUpperCase() + name.slice(1);

                    if(!element.value)
                        message.push(`O campo <b>'${name}'</b> é obrigatório`);
                });

                return message;
            }


            function salvarCadastro() {

                let id = $("#id").val();
                let method = id > 0 ? 'PUT' : 'POST';


                let nome = $("#nome").val();
                let nascimento = $("#nascimento").val();
                let sexo = $("#sexo").val();
                let cep = $("#cep").val();
                let endereco = $("#endereco").val();
                let numero = $("#numero").val();
                let complemento = $("#complemento").val();
                let bairro = $("#bairro").val();
                let uf = $("#uf").val();
                let cidade = $("#cidade").val();

                $.ajax({
                    type: method,
                    url: `http://localhost:8000/api/users/${id}`,
                    async: true,
                    dataType: 'json',
                    data: {
                        nome,
                        nascimento: nascimento.split('/').reverse().join('-'),
                        sexo,
                        cep,
                        endereco,
                        numero,
                        complemento,
                        bairro,
                        uf,
                        cidade
                    },
                    beforeSend: function () {},
                    success: function (data) {
                        Swal.fire({
                            position: 'top',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    complete: function() {},
                    fail: function() {}
                });
            }

            function getCEP(cep) {
                $.ajax({
                    type: "GET",
                    url: `https://viacep.com.br/ws/${cep}/json/`,
                    async: true,
                    dataType: 'json',
                    beforeSend: function () {},
                    success: function (data) {
                        $("#endereco").val(data.logradouro);
                        $("#complemento").val(data.complemento);
                        $("#bairro").val(data.bairro);
                        $("#uf").val(data.uf);
                        $("#cidade").val(data.localidade);
                    },
                    complete: function() {},
                    fail: function() {}
                });
            }

            function carregaCadastro(id) {
                if(!id) return;

                $.ajax({
                    type: "GET",
                    url: `http://localhost:8000/api/users/${id}`,
                    async: true,
                    dataType: 'json',
                    beforeSend: function () {},
                    success: function (data) {
                        $("#nome").val(data.nome);
                        $("#nascimento").val( data.nascimento.split('-').reverse().join('/') );
                        $("#sexo").val(data.sexo).change();
                        $("#cep").val(data.cep);
                        $("#endereco").val(data.endereco);
                        $("#numero").val(data.numero);
                        $("#complemento").val(data.complemento);
                        $("#bairro").val(data.bairro);
                        $("#uf").val(data.uf);
                        $("#cidade").val(data.cidade);
                    },
                    complete: function() {},
                    fail: function() {}
                });
            }
        </script>
    </body>
</html>
