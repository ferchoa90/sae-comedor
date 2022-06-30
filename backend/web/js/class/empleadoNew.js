
var urlflag;
var urlSelf;



$(document).on("click", "#btn_save", function () {
    //var id_cust = $("#txtid").val();

    /* if (nombre == '' || nombre == null) {
        swal("Warning", "Please fill customer name", "warning");
        $("#txtname").focus();
        return;
    } */

    var msg = " Todos los campos son obligatorios. ";
    var respuestas = {};

    var obj = {
        nombres: $("#nombres").val(),
        apellidos: $("#apellidos").val(),
        idbio: $("#idbio").val(),
        cedula: $("#cedula").val(),
    };
    if (validarForm(obj)) {
        showMessages("Error", msg, "warning");
    } else {
        hideMessages();
        /*Metodo Post de datos para grabar*/
        var obj = {
            nombres: $("#nombres").val(),
            apellidos: $("#apellidos").val(),
            departamento: $("#departamento").val(),
            correo: $("#correo").val(),
            idbio: $("#idbio").val(),
            cedula: $("#cedula").val(),
            estado: $("#estado").val(),
        };
        saveData(obj);
    }
});

function saveData(datos) {
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
            
            $.ajax(
                {
                    url: "nuevoempleado",
                    type: "POST",
                    data: datos,
                    success: function (data, textStatus, jqXHR) {
                        var data = jQuery.parseJSON(data);
                        loading(0);
                        if (data.success) {
                            loading(1);
                            $.notify('Se ha agregado el empleado');
                            if (data.id)
                            {
                                window.location.href = "verempleado?id=" + data.id;
                            }
                        } else {
                            loading(0);
                            $.notify(data.Mensaje);
                            //console.log("error");
                            //swal("Error", "Can't delete customer data, error : " + data.error, "error");
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        $.notify("Error, no se han podido guardar los datos.");
                    }
                });
        });
    return true;
}

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
            var url = (urlflag == 'false') ? urlSelf + "/delete?id=" + id_reg : "delete?id=" + id_reg;
            $.post(url, {
                _csrf: $('#token').val()
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
        //estado: $("#estado").val(),
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
            tipo: $("#tipo").val(),
            cedula: $("#cedula").val(),
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
            //var request = new XMLHttpRequest();
            //request.open('POST', action, /* async = */ false);
            

            //formData.append('files',archivo);
            //formData.append('files2',archivo);
            //formData.append('estado', datos.estado);
            //formData.append('_csrf',$('#token').val());
            $.ajax({
                type: 'POST',
                url: action, //Serverside handling script
                //enctype: 'multipart/form-data',
                //dataType: 'text', //Get back from PHP
                //processData: false, //Don't process the files
                //contentType: false,
                cache: false,
                data: datos,
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
                        $.notify(data.mensaje);
                        console.log("error");
                        //swal("Error", "Can't delete customer data, error : " + data.error, "error");
                    }
                }
            });
        });
    return true;
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