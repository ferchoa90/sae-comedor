/**
 * Created by danielzarate on 23/10/17.
 */

function loading(stat) {
    if (stat == 1) {
        /*('#loading-area').removeClass('loading-off');
        $('#loading-area').removeClass('loading-on');
        $('body').addClass('modal-open');*/
        $('#loading').show();

    }
    if (stat == 0) {
        /*$('#loading-area').removeClass('loading-on');
        $('#loading-area').addClass('loading-off');
        $('body').removeClass('modal-open');*/
        $('#loading').hide();
    }
    return true;
}

function notificacion(msg,tipo)
{
    if (tipo=="success")
    {
        alertify.success(msg);
    }

    if (tipo=="error")
    {
        alertify.error(msg);
    }

    if (tipo=="warning")
    {
        alertify.warning(msg);
    }
}