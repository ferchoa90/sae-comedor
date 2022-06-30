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
                    {"data": "id"},
                    {"data": "nombre"},
                    {"data": "descripcion"},
                    {"data": "link"},
                    {"data": "fechacreacion"},
                    {"data": "orden"},
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

        swal({
            title: "Grabar Registro",
            text: "Esta seguro que la información ingresada es correcta?",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#32bc38",
            confirmButtonText: "Grabar",
            closeOnConfirm: true
        },
            function () {
                loading(1);
                var action = $('#action').val();
    
                var file2 = $('#imagen');   //Ya que utilizas jquery aprovechalo...
                var archivo = document.getElementById('imagen').files;
                /* var myFile = archivo[0]; */
                /* console.log("A:",archivo);
                console.log("N: ",myFile.name); */
                var request = new XMLHttpRequest();
                request.open('POST', action, /* async = */ false);
    
                var formData = new FormData(document.getElementById('formPartidos'));
                formData.append('files',archivo);
                formData.append('estado',datos.estado);
    
                //formData.append('_csrf',$('#token').val());
                $.ajax({
                    type: 'POST',
                    url: action, //Serverside handling script
                    enctype: 'multipart/form-data',
                    dataType: 'text', //Get back from PHP
                    processData: false, //Don't process the files
                    contentType: false,
                    cache: false,
                    data: formData,
                    success: function(data){
                        var data = jQuery.parseJSON(data);
                        loading(0);
                        if (data.success) {
                            loading(1);
                            $.notify('Se ha generado un nuevo equipo');
                            if (data.id)
                            {
                                window.location.href = "view?id=" + data.id;
                            }
                        } else {
                            loading(0);
                            $.notify(data.Mensaje);
                            console.log("error");
                            //swal("Error", "Can't delete customer data, error : " + data.error, "error");
    
                        }
                    }
                });
            });
        return true; 
});
function editReg() {
    var id_cust = $(this).attr("id");
    var value = {
        id_cust: id_cust
    };
    $.ajax(
        {
            url: "get_cust.php",
            type: "POST",
            data: value,
            success: function (data, textStatus, jqXHR) {
                var data = jQuery.parseJSON(data);
                $("#crudmethod").val("E");
                $("#txtid").val(data.id_cust);
                $("#txtname").val(data.name);
                $("#cbogender").val(data.gender);
                $("#txtcountry").val(data.country);
                $("#txtphone").val(data.phone);

                $("#modalcust").modal('show');
                $("#txtname").focus();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                swal("Error!", textStatus, "error");
            }
        });
}

/*
 $.notifyDefaults({
 type: 'success',
 delay: 500
 });*/
