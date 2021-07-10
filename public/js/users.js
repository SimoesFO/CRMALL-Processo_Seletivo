$("#tbl_01").dataTable({
    dom: 'Blfrtip',
    info:     true,
    paging:   false,
    pageLength: 25,
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
    ordering: false,
    order: [[ 0, "desc" ]],
    serverMethod: 'get',
    ajax: {
        url: "http://localhost:8000/api/users"
    },
    buttons: [],
    language: {
        url: "/js/datatables/Portuguese-Brasil.json"
    },
    initComplete: function() {}
});


$(document).on('click', '.btn-editar', function(e) {
    let id = $(this).data('id');
    window.location = 'http://localhost:8000/newuser?id='+id;
});

$(document).on('click', '.btn-excluir', function(e) {
    let id = $(this).data('id');

    $.ajax({
        type: 'DELETE',
        url: `http://localhost:8000/api/users/${id}`,
        async: true,
        dataType: 'json',
        beforeSend: function () {},
        success: function (data) {
            $("#tbl_01").DataTable().ajax.reload();
        },
        complete: function() {},
        fail: function() {}
    });
});
