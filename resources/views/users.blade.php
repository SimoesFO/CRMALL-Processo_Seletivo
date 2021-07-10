<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link href="<?php echo asset('js/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?php echo asset('js/datatables/datatables.min.css') ?>" rel="stylesheet">
        <link href="<?php echo asset('js/datatables/plugins/bootstrap/datatables.bootstrap.css') ?>" rel="stylesheet">

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
        <div  class="col-md-8 col-md-offset-2">
            <div style="text-align: center; color: #555;">
                <h1>CRMALL - Processo Seletivo</h1>
            </div>

            <div>
                <button class="btn btn-primary" onclick="location.href='http://localhost:8000/newuser'">Novo</button>
                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="tbl_01">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Nascimento</th>
                            <th>Sexo</th>
                            <th>CEP</th>
                            <th>Endereço</th>
                            <th>Número</th>
                            <th>Complemento</th>
                            <th>Bairro</th>
                            <th>UF</th>
                            <th>Cidade</th>
                            <th>Editar</th>
                            <th>Remover</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        <script type="text/javascript" src="<?php echo asset('js/jquery.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo asset('js/bootstrap/js/bootstrap.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo asset('js/datatables/datatables.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo asset('js/datatables/plugins/bootstrap/datatables.bootstrap.js') ?>"></script>
        <script type="text/javascript" src="<?php echo asset('js/users.js') ?>"></script>
    </body>
</html>
