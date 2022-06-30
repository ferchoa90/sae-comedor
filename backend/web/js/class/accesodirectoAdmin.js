var urlflag;
var urlSelf;
$(document).ready(function () {
    loading(1);
    urlflag = $('#urlflag').val();
    urlSelf = $('#urlself').val();
    var url = (urlflag == 'false') ? urlSelf + "registros" : "registros";
    $.post(url, {'_csrf-backend': $('#token').val()})
        .done(function (data) {
            var data = JSON.parse(data);
            $('#table_slider').DataTable({
                "paging": true,
                "fixedHeader": true,
                "lengthChange": true,
                "scrollX": true,
                "colReorder": true,
                "searching": true,
                "orderCellsTop": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "pageLength": 10,
                "data": data,
                "language": {
                    "search": "Buscar: ",
                    "zeroRecords": "No se encontraron registros para la búsqueda.",
                    "info": "Página _PAGE_ de _PAGES_ |  Total: _MAX_ registros",
                    "infoEmpty": "No existen registros.",
                    "lengthMenu": "Registros por página  _MENU_",
                    "infoFiltered": "(Filtrado de _MAX_ registros).",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "paginate": {
                        "first": "Inicio",
                        "last": "Final",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                },
                "columns": [
                    {"data": "num"},
                    {"data": "nombre"},
                    {"data": "descripcion"},
                    {"data": "link"},
                    {"data": "previmage"},
                    {"data": "fechacreacion"},
                    {"data": "orden"},
                    {"data": "estatus"},
                    {"data": "button"},
                ]
            });
            loading(0);
        });
});


function deleteReg(elem) {
    var id_reg = elem.dataset.id;
    swal({
            title: "Eliminar Registro",
            text: "Esta seguro de eliminar el registro?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#32bc38",
            confirmButtonText: "Continuar",
            closeOnConfirm: true
        },
        function () {
            var url = (urlflag == 'false') ? urlSelf + "/delete?id=" + id_reg : "delete?id=" + id_reg;
            $.post(url, {
                _csrf: $('#token').val()
            }).done(function (data) {
                loading(0);
                $.notify('Registro eliminado', "success");
            });
        });
}

$(document).on("click", "#btnsave", function () {
    var id_cust = $("#txtid").val();
    var name = $("#txtname").val();
    var gender = $("#cbogender").val();
    var country = $("#txtcountry").val();
    var phone = $("#txtphone").val();
    var crud = $("#crudmethod").val();
    if (name == '' || name == null) {
        swal("Warning", "Please fill customer name", "warning");
        $("#txtname").focus();
        return;
    }
    var value = {
        id_cust: id_cust,
        name: name,
        gender: gender,
        country: country,
        phone: phone,
        crud: crud
    };
    $.ajax(
        {
            url: "save.php",
            type: "POST",
            data: value,
            success: function (data, textStatus, jqXHR) {
                var data = jQuery.parseJSON(data);
                if (data.crud == 'N') {
                    if (data.result == 1) {
                        $.notify('Successfull save data');
                        var table = $('#table_trivia').DataTable();
                        table.ajax.reload(null, false);
                        $("#txtname").focus();
                        $("#txtname").val("");
                        $("#txtcountry").val("");
                        $("#txtphone").val("");
                        $("#crudmethod").val("N");
                        $("#txtid").val("0");
                        $("#txtnama").focus();
                    } else {
                        swal("Error", "Can't save customer data, error : " + data.error, "error");
                    }
                } else if (data.crud == 'E') {
                    if (data.result == 1) {
                        $.notify('Successfull update data');
                        var table = $('#table_trivia').DataTable();
                        table.ajax.reload(null, false);
                        $("#txtname").focus();
                    } else {
                        swal("Error", "Can't update customer data, error : " + data.error, "error");
                    }
                } else {
                    swal("Error", "invalid order", "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                swal("Error!", textStatus, "error");
            }
        });
});
