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
            $('#table_menus').DataTable({
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
                    {"data": "direccion"},
                    {"data": "provincia"},
                    {"data": "ciudad"},
                    {"data": "lat"},
                    {"data": "long"},
                    {"data": "fechacreacion"},
                    {"data": "estado"},
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
            var url = (urlflag == 'false') ? urlSelf + "/eliminarsecundario?id=" + id_reg : "eliminarsecundario?id=" + id_reg;
            $.post(url, {
                _csrf: $('#token').val()
            }).done(function (data) {
                loading(0);
                $.notify('Registro eliminado', "success");
            });
        });
}
