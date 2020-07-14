jQuery(document).ready(function($) {
    let type_payment = $("#pago_entrega");
    let btn_paypal = $('#btn-paypal');
    let form_payment = $('#form-payment');
    type_payment.change(function(event) {
        if ($(this).is(':checked')) {
            btn_paypal.removeClass('btn-warning')
            btn_paypal.addClass('btn-primary')
            btn_paypal.html(`<i class="fas fa-credit-card mr-2"></i> Proceder compra`);
        } else {
            btn_paypal.removeClass('btn-primary');
            btn_paypal.addClass('btn-warning')
            btn_paypal.html(`<i class="fab fa-paypal mr-2"></i> PayPal`);
        }
    });
    form_payment.submit(function(event) {
        event.preventDefault();
        let type = (type_payment.is(':checked')) ? 1 : 0;
        $.ajax({
            url: '../processing',
            type: 'POST',
            dataType: 'json',
            data: JSON.stringify({
                action: 'created',
                type: type
            }),
            beforeSend: function() {
                type_payment.attr('disabled', 'true');
                btn_paypal.addClass('disabled')
                btn_paypal.html('<i class="fas fa-spinner fa-spin mr-2 "></i> procesando')
            },
        }).done(function(response) {
            const {
                data,
                success,
                msg,
                url
            } = response;
            console.log(response)
            if (success) {
                swal("correcto!", msg, "success");
            }
            if (!success) {
                swal("Advertencia!", msg, "error");
            }
            setTimeout(function() {
                window.location.href = url;
            }, 1000);
        });
    });
});