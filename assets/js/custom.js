$(document).ready(function () {
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        autoplay: true,
        responsive: {
            0: {
                items: 3,
                nav: false
            },
            600: {
                items: 3,
                nav: false
            },
            1000: {
                items: 5,
                nav: false,
                loop: false
            }
        }
    });


    // Example starter JavaScript for disabling form submissions if there are invalid fields
    'use strict'

    $('.recaptcha-error-form-contact').hide();
    $('.recaptcha-error-form-cta').hide();

    /* FORM CONTACT */      
    $('.needs-validation').validate({
        submitHandler: function (form) {
          var response = grecaptcha.getResponse();
          console.log(response);
          //recaptcha failed validation
          if (response.length == 0) {
            $('.recaptcha-error-form-contact').show();
            return false;
          }
            //recaptcha passed validation
          else {
            $('.recaptcha-error-form-contact').hide();
            return true;
          }
        }
    });


    /* FORM CTA WPP */
    var num1 = Math.floor(Math.random() * 10);
    var num2 = Math.floor(Math.random() * 10);
    var resposta = num1 + num2;

    $("#label-captcha").html("Qual a soma de " + num1 + " + " + num2 + "?");

    $('#form-cta-wpp').validate({       
        submitHandler: function (form, e) {
            /* CAPTCHAJS */  
            var validation = $("#valida").val();
            //console.log(validation);        
            if (validation != resposta) {
                e.preventDefault();
                $("#mensagem").html('A soma está errada!');
            } else {
                $("#mensagem").hide(); 
                $("#btn-form-cta-wpp").html('enviando, por favor aguarde...');
                $("#btn-form-cta-wpp").attr("disabled", true);
                $("#form-cta-wpp").submit();                
            }
        }
    });

    /************************
    * VALIDATION FUNCTION
    ************************/
    function msg(msg, tipo) {
        var retorno = $(".msg");
        var tipo = (tipo === 'success') ? 'success' : (tipo === 'alert') ? 'warning' : (tipo === 'error') ? 'danger' : (tipo === 'info') ? 'info' : '';
        retorno.empty().fadeOut('fast', function () {
            return $(this).html('<div class="alert alert-' + tipo + '">' + msg + '</div>').fadeIn('slow');
        });
        //esconde a div depois de 5 segundos
        /* setTimeout(function() {
            retorno.fadeOut('slow');
        }, 3000); */
    }

});





