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
        nombre : $("#nombre").val(),
        pagina : $("#pagina").val(),
        //descripcion : $("#descripcion").val(),
        imagen : $("#imagen").val(),
        /*superior : $("#superior").val(),*/
        tipo : $("#tipo").val(),
        vista : $("#vista").val(),
        orden : $("#orden").val(),
        estado : $("#estado").val(),
    };
    if (validarForm(obj)) {
        showMessages("Error", msg, "warning");
    } else {
        hideMessages();
        /*Metodo Post de datos para grabar*/
        saveData(obj);
    }
});

function validarForm(datos) {
    var cont = 0;
    console.log(datos); 

    $.each(datos, function (index, element) {
        //console.log(index+' :'+element.trim().length); 
        if (element.trim()=="" || element.trim().length  == 0 ){
            if (cont==0){ $("#"+index).focus(); }
            cont++;
        }
    });
    if (cont > 0) { return true; } else { return false; }
}

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
            var action = $('#action').val();
            var file2 = $('#imagen');   //Ya que utilizas jquery aprovechalo...
            var archivo = document.getElementById('imagen').files;

            /* var myFile = archivo[0]; */
            /* console.log("A:",archivo);
            console.log("N: ",myFile.name); */
            var request = new XMLHttpRequest();
            request.open('POST', action, /* async = */ false);
            var formData = new FormData(document.getElementById('formSlider'));

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
                        $.notify('Se ha generado un nuevo archivo de descarga');
                        if (data.id)
                        {
                            window.location.href = "verdescarga?id=" + data.id;
                        }
                    } else {
                        loading(0);
                        $.notify(data.Mensaje);
                        console.log("error");
                        //swal("Error", "Can't delete customer data, error : " + data.error, "error");
                    }
                }
            });
            //request.send(formData);
            /* $.post(action, {
                data: formData
            }).done(function (data) {
                var data = jQuery.parseJSON(data);
                loading(0);
                $.notify('Se ha generado una nueva fecha de pronóstico');
                if (data.resp) {
                    loading(1);
                    window.location.href = "view?id=" + data.id;
                } else {
                    console.log("error");
                    //swal("Error", "Can't delete customer data, error : " + data.error, "error");
                }
            }); */
        });
    return true;
}

$(document).on("click", "#btn_update", function () {

    var msg = " Todos los campos son obligatorios. ";
    var respuestas = {};

    var obj = {
        //nombre : $("#nombre").val(),
        //descripcion : $("#descripcion").val(),
        enlace : $("#enlace").val(),
        orden : $("#orden").val(),
        estado : $("#estado").val(),
    };
    if (validarForm(obj)) {
        showMessages("Error", msg, "warning");
    } else {
        hideMessages();
        /*Metodo Post de datos para grabar*/
        editReg(obj);
    }
});

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
        function () {
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
                        $.notify('Se ha actualizado el banner');
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
}

/*
 $.notifyDefaults({
 type: 'success',
 delay: 500
 });*/

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