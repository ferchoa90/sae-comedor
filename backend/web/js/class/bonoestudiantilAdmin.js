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
            $('#table_formularios').DataTable({
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
                    {"data": "nombresrep"},
                    {"data": "cedularep"},
                    {"data": "nombresocio"},
                    {"data": "cedulasocio"},
                    {"data": "provincia"},
                    {"data": "direccion"},
                    {"data": "celular"},
                    {"data": "telefono"},
                    {"data": "correo"},
                    {"data": "nombrehijo"},
                    {"data": "cedulahijo"},
                    {"data": "gradoac"},
                    {"data": "nombrehijo2"},
                    {"data": "cedulahijo2"},
                    {"data": "gradoac2"},
                    {"data": "nombrehijo3"},
                    {"data": "cedulahijo3"},
                    {"data": "gradoac3"},
                    {"data": "id"},
                    {"data": "fechacreacion"},
                    //{"data": "button"},
                ]
            });
            loading(0);
        });
});


