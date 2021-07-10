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
