$(document).ready(function () {
    var parametros = {

    };
    var ruta = 'banks';
    $.ajax({
        url: ruta,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        dataType: 'json',
        data: parametros,
        success: function (data) {
            console.log(data.getBankListResult.item);
            b = data.getBankListResult.item;
            resultado = '';
            for (var i = 0 in b) {
                resultado += '<option value="'+b[i].bankCode+'">'+b[i].bankName+'</option>';
            }
            $('#banks').html(resultado);
        }
    });
});

function validarBank() {
    bank =   $('#banks').val();

    if (bank == 0){
        $('#message').html('Debe seleccionar un banco');
    }else {
        $('#formBank').submit();
    }
}

function datosDefecto() {
    $('#document').val('1092943113');
    $('#firstName').val('Juan Carlos');
    $('#lastName').val('Alvarez Lagos');
    $('#company').val('BANDIT');
    $('#emailAddress').val('jcalvarez31@misena.edu.co');
    $('#address').val('Calle 26 #12-14 bellavista');
    $('#province').val('Norte de Santander');
    $('#city').val('Cucuta');
    $('#phone').val('3168645825');
    $('#mobile').val('3168645825');
}