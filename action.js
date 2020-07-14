jQuery(document).ready(function($) {
    Brand();
    Producto();
    CountCart();
    /*load producto brand*/
    function Brand() {
        $.ajax({
            url: "valid.php",
            method: "POST",
            data: {
                brand: 1,
            },
        }).done(function(data) {
            $(".category").html(data);
        });
    }

    function Producto() {
        $.ajax({
            url: "valid.php",
            method: "POST",
            data: {
                product: 1,
            },
        }).done(function(data) {
            $(".conte-all").html(data);
        });
    }

    function CountCart() {
        $.ajax({
            url: "valid.php",
            method: "POST",
            data: {
                count: 1,
            },
        }).done(function(data) {
            $(".all_cant").text(data);
        });
    }
    $("body").delegate(".favorit", "click", function(event) {
        event.preventDefault();
        $.ajax({
            url: "valid.php",
            method: "POST",
            data: {
                fav: 1,
            },
        }).done(function(data) {
            $(".conte-all").html(data);
        });
    });
    /*eventos */
    $("body").delegate(".bran_item", "click", function(event) {
        event.preventDefault();
        var id_brand = $(this).attr("category");
        $(".bran_item").removeClass("active");
        $(this).toggleClass("active");
        $.ajax({
            url: "valid.php",
            method: "POST",
            data: {
                select_brand: 1,
                brand_id: id_brand,
            },
            success: function(data) {
                $(".conte-prod").html(data);
            },
        });
    });
    $("body").delegate(".view_det", "click", function() {
        var id_prod = $(this).attr("value");
        active_modal();
        $.ajax({
            url: "valid.php",
            method: "POST",
            data: {
                view_prod: 1,
                idProd: id_prod,
            },
        }).done(function(data) {
            $(".conte").html(data);
        });
    });
    /*agregar a favorito*/
    $("body").delegate(".love", "click", function() {
        var id_prod = $(this).attr("value");
        $.ajax({
            url: "valid.php",
            method: "POST",
            data: {
                idlove: 1,
                id_Prod: id_prod,
            },
        }).done(function(data) {
            $(".msj").html(data);
            /*console.log(data);*/
        });
    });
    /*eliminar producto de favorito*/
    $("body").delegate(".edit", "click", function() {
        var id_prod = $(this).attr("value");
        var prod = $(this).closest(".box-prod");
        $.ajax({
            url: "valid.php",
            method: "POST",
            data: {
                removef: 1,
                id_Prod: id_prod,
            },
        }).done(function(data) {
            if (data != 0) {
                prod.remove();
            }
        });
    });
    /*visualizar producto agregado*/
    $("body").delegate(".addCart", "click", function() {
        var id_prod = $(this).attr("value_id");
        active_modal();
        View_carrito();
        $.ajax({
            url: "valid.php",
            method: "POST",
            data: {
                addProd: 1,
                idCart: id_prod,
            },
        }).done(function(data) {
            if (data != 0) {
                $(".container-prod").html(data);
                setTimeout(function() {
                    CountCart();
                }, 100);
            }
        });
    });
    /*visualizar carrito*/
    $(".cart").click(function() {
        View_carrito();
        $.ajax({
            url: "valid.php",
            method: "POST",
            data: {
                cart_view: 1,
            },
        }).done(function(data) {
            $(".container-prod").html(data);
        });
    });
    /*elimnar carrito*/
    $("body").delegate(".trash", "click", function(event) {
        event.preventDefault();
        var id_cart = $(this).attr("val_trash");
        $.ajax({
            url: "valid.php",
            method: "POST",
            data: {
                del_cart: 1,
                idCart: id_cart,
            },
        }).done(function(data) {
            $(".detail-cart").html(data);
        });
    });
    /*cerrar sesion class="logut"  */
    $("body").delegate(".logut", "click", function(event) {
        event.preventDefault();
        console.log("cerrar sesion");
        $.ajax({
            url: "valid.php",
            method: "POST",
            data: {
                logut: 1,
            },
        }).done(function(data) {
            $(".sms").html(data);
        });
    });
    /*vaciar carrito */
    $("body").delegate("#clean", "click", function(event) {
        event.preventDefault();
        console.log($(this).attr("id"));
        $.ajax({
            url: "valid.php",
            method: "POST",
            data: {
                removeCart: 1,
            },
        }).done(function(data) {
            setTimeout(function() {
                location.reload();
            }, 100);
        });
    });
    /*vaciar carrito */
    $("body").delegate("#pay_right", "click", function(event) {
        event.preventDefault();
        console.log($(this).attr("id"));
        $.ajax({
            url: "valid.php",
            type: "POST",
            dataType: "json",
            data: {
                paym: 1,
            },
        }).done(function(data) {
            console.log(data);
            if (data.status) {
                window.location.href = "payment.php";
            } else {
                swal({
                    title: "debes iniciar sesion para realizar pago!",
                    icon: "warning",
                    button: "aceptar",
                });
            }
            // $(".men").html(data);
        });
    });
    /*aumentar cantidad producto*/
    $("body").delegate(".plus", "click", function(event) {
        event.preventDefault();
        var _this = $(this);
        PlusCant(_this);
        CalcImpo(_this, 1);
    });
    /*restar cantidad producto*/
    $("body").delegate(".rest", "click", function(event) {
        event.preventDefault();
        var _this = $(this);
        ResCant(_this);
        CalcImpo(_this, 0);
    });

    function PlusCant(_this) {
        var cant = _this.closest(".item_prod");
        var _val = cant.find("input").val();
        var _id = cant.find("input").attr("idval");
        setTimeout(function() {
            CalcSubt(_this);
        }, 100);
        $.ajax({
            url: "valid.php",
            method: "POST",
            data: {
                pmas: 1,
                idp: _id,
            },
        }).done(function(data) {
            cant.find("input").attr("value", data);
        });
    }

    function card_icon(name) {
        switch (name) {
            case "visa":
                {
                    return '<i class="fab fa-cc-visa"></i>';
                }
            case "mastercard":
                {
                    return '<i class="fab fa-cc-mastercard"></i>';
                }
            case "amex":
                {
                    return '<i class="fab fa-cc-amex"></i>';
                }
            case "discover":
                {
                    return '<i class="fab fa-cc-discover"></i>';
                }
            case "diners_club_carte_blanche":
                {
                    return '<i class="fab fa-cc-diners-club"></i>';
                }
            case "jcb":
                {
                    return '<i class="fab fa-cc-jcb"></i>';
                }
            default:
                {
                    return '<i class="far fa-credit-card"></i>';
                }
        }
    }

    function cc_format(value) {
        var v = value.replace(/\s+/g, "").replace(/[^0-9]/gi, "");
        var matches = v.match(/\d{4,16}/g);
        var match = (matches && matches[0]) || "";
        var parts = [];
        for (i = 0, len = match.length; i < len; i += 4) {
            parts.push(match.substring(i, i + 4));
        }
        if (parts.length) {
            return parts.join(" ");
        } else {
            return value;
        }
    }

    function date_format(value) {
        var v = value.replace(/\s+/g, "").replace(/[^0-9]/gi, "");
        var matches = v.match(/\d{2,5}/g);
        var match = (matches && matches[0]) || "";
        var parts = [];
        for (i = 0, len = match.length; i < len; i += 2) {
            parts.push(match.substring(i, i + 2));
        }
        if (parts.length) {
            return parts.join("/");
        } else {
            return value;
        }
    }
    if ($("#card_number").length) {
        let icon = "";
        let icon_card = $(".card-icon");
        $("#card_number").validateCreditCard(function(result) {
            if (result.card_type != null) {
                icon = card_icon(result.card_type.name);
            } else {
                icon = card_icon("");
            }
            $(this).val(cc_format($(this).val().trim()))
            icon_card.html(icon);
        });
    }
    if ($('#card_date').length) {
        $('#card_date').on('input', function() {
            $(this).val(date_format($(this).val().trim()));
        });
    }

    function validatator() {
        var valid = true;
        var message = "";
        var cvvRegex = /^[0-9]{3,3}$/;
        var card_number = $("#card_number");
        var card_date = $("#card_date");
        var card_cvv = $("#card_cvv");
        card_number.css("border", "1px solid #ced4da");
        card_date.css("border", "1px solid #ced4da");
        card_cvv.css("border", "1px solid #ced4da");
        if (card_number.val() == "" || card_date.val() == "" || card_cvv.val() == "") {
            message += "<p> - completa los campos </p>";
            if (card_number.val() == "") {
                card_number.css("border", "1px solid #ff8c8c");
            }
            if (card_date.val() == "") {
                card_date.css("border", "1px solid #ff8c8c");
            }
            if (card_cvv.val() == "") {
                card_cvv.css("border", "1px solid #ff8c8c");
            }
            valid = false;
        }
        if(card_date.val()!=''){          
          let format_date = card_date.val().split('/');
          
          if (format_date[0] > 12) {
              message += "<div> - Expiration date is Invalid </div>";
              card_date.css("border", "1px solid #ff8c8c");
              valid = false;
          }
          let date = new Date();
          if (format_date[1] <= parseInt(date.getFullYear().toString().substr(-2)) || format_date[1] > parseInt(date.getFullYear().toString().substr(-2)) + 5) {
              message += "<div> - Expiration date is Invalid2 </div>";
              card_date.css("border", "1px solid #ff8c8c");
              valid = false; 
          }
        }
        if (card_number.val() != "") {
            card_number.validateCreditCard(function(result) {
                if (!result.valid) {
                    message += "<div> - Card Number is Invalid</div>";
                    card_number.css("border", "1px solid #ff8c8c");
                    valid = false;
                }
            });
        } else if (card_cvv.val() != "" && !cvvRegex.test(card_cvv.val())) {
            message += "<div> - CVV is Invalid</div>";
            card_cvv.css("border", "1px solid #ff8c8c");
            valid = false;
        }
        if (message.trim() != "") {
            $("#card-msg").html(message);
        }
        return valid;
    }

    $('.numero').on("cut copy paste", function(e) {
        e.preventDefault();
    });
    $("#payment-process").submit(function(event) {
        event.preventDefault();
        console.log(validatator());
    });
    /*Realizar pago*/
    $("body").delegate(".send_pay_", "click", function(event) {
        event.preventDefault();
        return false;
        $.ajax({
            url: "valid.php",
            method: "POST",
            data: {
                reg_pay: 1,
            },
        }).done(function(data) {
            $(".sms").html(data);
        });
    });

    function ResCant(_this) {
        var cant = _this.closest(".item_prod");
        var _val = cant.find("input").val();
        var _id = cant.find("input").attr("idval");
        if (_val === 0) {
            cant.find("input").attr("value", 1);
        } else {
            setTimeout(function() {
                CalcSubt(_this);
            }, 100);
            $.ajax({
                url: "valid.php",
                method: "POST",
                data: {
                    pres: 1,
                    idp: _id,
                },
            }).done(function(data) {
                cant.find("input").attr("value", data);
            });
        }
    }

    function CalcSubt(_this) {
        var item = _this.closest(".item_prod");
        var _id = item.find("input").attr("idval");
        $.ajax({
            url: "valid.php",
            method: "POST",
            data: {
                psubt: 1,
                idp: _id,
            },
        }).done(function(data) {
            $("#subt").text("S/. " + data);
            console.log(data);
        });
    }

    function CalcImpo(_this, valor) {
        var item = _this.closest(".item_prod");
        var canti = parseInt(item.find("input").attr("value"));
        var _pre = item.find(".prec").text();
        var prec = parseFloat(_pre);
        console.log(canti);
        console.log(prec);
        if (canti >= 1) {
            if (valor == 0) {
                if (canti == 1) {
                    canti = 1;
                } else {
                    canti = parseInt(canti) - 1;
                }
            } else {
                canti = parseInt(canti) + 1;
            }
            var newImpo = parseFloat(canti * prec);
            item.find(".imp").text("S/ " + newImpo.toFixed(2));
        }
    }
    /*suscripcion de email*/
    $("body").delegate("#suscrib", "submit", function(event) {
        event.preventDefault();
        var email = $("#sus_email").val();
        if (email != "") {
            $.ajax({
                url: "valid.php",
                method: "POST",
                data: {
                    sus: 1,
                    email_sus: email,
                },
            }).done(function(data) {
                $(".sms").html(data);
                setTimeout(function() {
                    $(".sms").html("");
                    $("#sus_email").val("");
                }, 1000);
            });
        } else {
            $(".sms").html('<p class="error">ingresa su email </p>');
            setTimeout(function() {
                $(".sms").html("");
                $("#sus_email").val("");
            }, 1000);
        }
    });
    /*Register form, login form, update form (capture all events)*/
    $("form").on("submit", function(event) {
        event.preventDefault();
        var forname = $(this).attr("value_name"); /*form name*/
        var form = $(this).closest("form");
        if (forname == "sig_up") {
            if (ValidarUp()) {
                var _nombre = $("#nombre").val();
                var _direccion = $("#direccion").val();
                var _email = $("#email").val();
                var _telefono = $("#telefono").val();
                var _pwd = $("#pass").val();
                $.ajax({
                    url: "reg.php",
                    method: "POST",
                    data: {
                        singup: 1,
                        nombre: _nombre,
                        direccion: _direccion,
                        email: _email,
                        telefono: _telefono,
                        pwd: _pwd,
                    },
                }).done(function(data) {
                    $(".msj").html(data);
                });
                form.find("input[type=text], input[type=email], input[type=password]").val("");
                return false;
            }
        }
        if (forname == "sign") {
            if (ValidarLog()) {
                var _usu = $("#correo_l").val();
                var _pass = $("#pwd_l").val();
                $.ajax({
                    url: "reg.php",
                    method: "POST",
                    data: {
                        sign: 1,
                        usu: _usu,
                        pass: _pass,
                    },
                }).done(function(data) {
                    $(".msj").html(data);
                });
                form.find("input[type=text], input[type=email], input[type=password]").val("");
                return false;
            }
        }
        if (forname == "update") {
            if (ValidarUpdate()) {
                var _nombre = $("#c_nombre").val();
                var _direccion = $("#c_direccion").val();
                var _email = $("#c_email").val();
                var _telefono = $("#c_telefono").val();
                $.ajax({
                    url: "reg.php",
                    method: "POST",
                    data: {
                        update_info: 1,
                        nombre: _nombre,
                        direccion: _direccion,
                        email: _email,
                        telefono: _telefono,
                    },
                }).done(function(data) {
                    $(".msj").html(data);
                });
                /*form.find('input[type=text], input[type=email], input[type=password]').val('');
                return false;*/
            }
        }
        if (forname == "Change_pass") {
            if (ValChangePas()) {
                var oldpass = $("#pass_old").val();
                var newpass = $("#pass_new").val();
                var samepass = $("#pass_same").val();
                $.ajax({
                    url: "reg.php",
                    method: "POST",
                    data: {
                        changp: 1,
                        oldp: oldpass,
                        newp: newpass,
                        samep: samepass,
                    },
                }).done(function(data) {
                    $(".msj").html(data);
                });
            }
        }
        if (forname == "search") {
            var texto = $(".search_prod").val();
            var idcate = $("select.category").val();
            $.ajax({
                url: "valid.php",
                method: "POST",
                data: {
                    search: 1,
                    cate: idcate,
                    searchn: texto,
                },
            }).done(function(data) {
                $(".conte-all").html(data);
            });
        }
    });

    function ValChangePas() {
        var oldpass = $("#pass_old").val();
        var newpass = $("#pass_new").val();
        var samepass = $("#pass_same").val();
        if (oldpass == "" || newpass == "" || samepass == "") {
            swal({
                title: "la contraseña no debe ser vacio!",
                icon: "warning",
                button: "ok",
            });
            return false;
        }
        if (newpass != samepass) {
            swal({
                title: "las contraseñas no coinciden!",
                icon: "warning",
                button: "ok",
            });
            return false;
        }
        if (newpass == oldpass || samepass == oldpass) {
            swal({
                title: "la contraseña no debe ser igual a la antigua!",
                icon: "warning",
                button: "ok",
            });
            return false;
        }
        return true;
    }

    function ValidarUpdate() {
        if ($("#c_nombre").val() == "") {
            swal({
                title: "El nombre no debe ser vacio!",
                icon: "warning",
                button: "ok",
            });
            return false;
        }
        if ($("#c_direccion").val() == "") {
            swal({
                title: "La direccion no debe ser vacio!",
                icon: "warning",
                button: "ok",
            });
            return false;
        }
        if ($("#c_email").val() == "") {
            swal({
                title: "Email no debe ser vario!",
                icon: "warning",
                button: "ok",
            });
            return false;
        }
        if ($("#c_telefono").val() == "") {
            swal({
                title: "El telefono no debe ser vacio!",
                icon: "warning",
                button: "ok",
            });
            return false;
        }
        return true;
    }

    function ValidarLog() {
        if ($("#correo_l").val() == "") {
            swal({
                title: "Ingrese su correo!",
                icon: "warning",
                button: "ok",
            });
            return false;
        }
        if ($("#pwd_l").val() == "") {
            swal({
                title: "Ingrese su correo!",
                icon: "warning",
                button: "ok",
            });
            return false;
        }
        return true;
    }

    function ValidarUp() {
        if ($("#nombre").val() == "") {
            swal({
                title: "Ingrese su Nombre!",
                icon: "warning",
                button: "ok",
            });
            return false;
        }
        if ($("#direccion").val() == "") {
            swal({
                title: "Ingrese su Direccion!",
                icon: "warning",
                button: "ok",
            });
            return false;
        }
        if ($("#email").val() == "") {
            swal({
                title: "Ingrese su Correo!",
                icon: "warning",
                button: "ok",
            });
            return false;
        }
        if ($("#telefono").val() == "") {
            swal({
                title: "Ingrese su Telefono!",
                icon: "warning",
                button: "ok",
            });
            return false;
        }
        if ($("#pass").val() == "") {
            swal({
                title: "Ingrese su Contraseña!",
                icon: "warning",
                button: "ok",
            });
            return false;
        }
        return true;
    }
    $("#close_v").click(function() {
        $(".cart_prod").animate({
            width: "0px",
        }, 100);
        setTimeout(function() {
            $(".view_cart_prod").css("display", "none");
        }, 200);
    });

    function View_carrito() {
        $(".view_cart_prod").css("display", "block");
        $(".cart_prod").animate({
            width: "350px",
        }, 100);
    }
    $("body").delegate(".close_mod", "click", function() {
        active_modal();
    });

    function active_modal() {
        $(".modal").toggleClass("active_mod");
        $("body").toggleClass("openBody");
    }
});