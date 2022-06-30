var urlflag;
var urlSelf;

$(document).ready(function() {
    loading(1);
    urlflag = $('#urlflag').val();
    urlSelf = $('#urlself').val();
    var url = (urlflag == 'false') ? urlSelf + "registros" : "registros";
    $.post(url, { '_csrf-backend': $('#token').val() })
        .done(function(data) {
            var data = JSON.parse(data);
            $('#table_usuarios').DataTable({
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
                    { "data": "id" },
                    { "data": "nombres" },
                    { "data": "apellidos" },
                    { "data": "username" },
                    { "data": "email" },
                    { "data": "tipo" },
                    { "data": "fechacreacion" },
                    { "data": "estatus" },
                    { "data": "button" },
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
        function() {
            var url = (urlflag == 'false') ? urlSelf + "delete?id=" + id_reg : "delete?id=" + id_reg;
            console.log(url)
            $.post(url, {
                '_csrf-backend': $('#token').val()
            }).done(function(data) {
                loading(0);
                $.notify('Registro eliminado', "success");
            });
        });
}

$(document).on("click", "#btn_update", function() {

    var msg = " Todos los campos son obligatorios. ";
    var respuestas = {};

    var obj = {
        //nombre : $("#nombre").val(),
        //descripcion : $("#descripcion").val(),
        nombres: $("#nombres").val(),
        apellidos: $("#apellidos").val(),
        //perfil: $("#perfil").val(),
        //sucursal: $("#sucursal").val(),
        correo: $("#correo").val(),
        nombreu: $("#nusuario").val(),
        //pass: $("#pass").val(),
        estado: $("#estado").val(),
    };
    if (validarForm(obj)) {
        showMessages("Error", msg, "warning");
    } else {
        hideMessages();
        /*Metodo Post de datos para grabar*/
        var obj = {
            //nombre : $("#nombre").val(),
            //descripcion : $("#descripcion").val(),
            nombres: $("#nombres").val(),
            apellidos: $("#apellidos").val(),
            perfil: $("#perfil").val(),
            sucursal: $("#sucursal").val(),
            correo: $("#correo").val(),
            nombreu: $("#nusuario").val(),
            password: $("#contrasenia").val(),
            estado: $("#estado").val(),
        };
        editReg(obj);
    }
});


function validarForm(datos) {
    var cont = 0;
    console.log(datos);

    $.each(datos, function(index, element) {
        //console.log(index+' :'+element.trim().length);
        if (element.trim() == "" || element.trim().length == 0) {
            if (cont == 0) { $("#" + index).focus(); }
            cont++;
        }
    });
    if (cont > 0) { return true; } else { return false; }
}


function editReg(datos) {
    swal({
            title: "Grabar Registro",
            text: "Esta seguro que la información ingresada es correcta?",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#32bc38",
            confirmButtonText: "Grabar",
            closeOnConfirm: true
        },
        function() {
            loading(1);
            var action = $('#action').val();
            //var file2 = $('#imagen');   //Ya que utilizas jquery aprovechalo...
            //var archivo = document.getElementById('imagen').files;
            //var archivo2 = document.getElementById('imagenmobile').files;

            /* var myFile = archivo[0]; */
            /* console.log("A:",archivo);
            console.log("N: ",myFile.name); */
            var request = new XMLHttpRequest();
            request.open('POST', action, /* async = */ false);
            var formData = new FormData(document.getElementById('formSlider'));

            //formData.append('files',archivo);
            //formData.append('files2',archivo);
            formData.append('estado', datos.estado);
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
                success: function(data) {
                    var data = jQuery.parseJSON(data);
                    loading(0);
                    if (data.success) {
                        loading(1);
                        $.notify('Se ha actualizado el usuario');
                        if (data.id) {
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
}

function editReg() {
    var id_cust = $(this).attr("id");
    var value = {
        id_cust: id_cust
    };
    $.ajax({
        url: "get_cust.php",
        type: "POST",
        data: value,
        success: function(data, textStatus, jqXHR) {
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
        error: function(jqXHR, textStatus, errorThrown) {
            swal("Error!", textStatus, "error");
        }
    });
}

function showMessages(head, message, tipo) {
    loading(0);
    hideMessages();
    $("#messages").show();
    var html = '<div class="alert alert-' + tipo + '"><strong>' + head + '!</strong> ' + message + '</div>';
    $("#messages").html(html);
}

function hideMessages() {
    loading(0);
    $("#messages").hide();
    $("#messages").html("");
}

/*
 $.notifyDefaults({
 type: 'success',
 delay: 500
 });*/