/**
 * Created by vietv on 3/26/2017.
 * */

var nNtUrlApi = baseUrl + '../api/v1/nguoinopthues/'; // nguoi nop thue

$('#kqkttnntform').on('keyup keypress', function (e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
        e.preventDefault();
        return false;
    }
});

ko.bindingHandlers.nextFieldOnEnter = {
    init: function (element, valueAccessor, allBindingsAccessor) {
        $(element).on('keydown', 'input,select,textarea', function (e) {
            var self = $(this)
                , form = $(element)
                , focusable
                , next
            ;
            if (e.keyCode === 13 && event.shiftKey) {
                var content = this.value;
                var caret = getCaret(this);
                var s1 = content.substring(0, caret);
                var s2 = caret !== content.length ? content.substring(caret, content.length - 1) : "";
                this.value = s1 + "\n" + s2;
                e.stopPropagation();
            } else if (e.keyCode === 13) {
                focusable = form.find('input,textarea,select');
                var nextIndex = focusable.index(this) === focusable.length - 1 ? 0 : focusable.index(this) + 1;
                next = focusable.eq(nextIndex);

                var collapse = null;

                if ($(this).data('date')) {
                    if (!checkDateValiate(this.value)) {
                        $(this).parent().find('.help-block').html("Sai định dạng ngày tháng năm");
                        $(this).parent().addClass('has-error');
                        can_save = false;
                        return;
                    }
                    else {
                        $(this).parent().removeClass('has-error');
                        $(this).parent().find('.help-block').html("");
                    }
                }

                if ($(this).data('int')) {
                    if (!checkIntegerValiate(this.value)) {
                        $(this).parent().find('.help-block').html($(this).parent().find('.control-label'));
                        $(this).parent().addClass('has-error');
                        return;
                    }
                    else {
                        $(this).parent().removeClass('has-error');
                        $(this).parent().find('.help-block').html("");
                    }
                }

                switch (this.id) {
                    case 'truongdoankiemtra-truongdoan':

                        break;
                    case 'quyetdinhxuly-soqdxuly':

                        break;
                    case 'lichsunopsaukiemtra-danoptienphat':
                        $("#hanhvi").attr("aria-expanded", "true");
                        collapse = $('#collapseFour');
                        break;
                    case 'baocaokiemtra-ghichu':
                        $("#notruythu").attr("aria-expanded", "true");
                        collapse = $('#collapseThree');
                        break;
                    default:
                        break;
                }

                if (collapse != null) {
                    collapse.addClass('in');
                    collapse.css("height", "auto");
                }

                if(next[0].id === "baocaokiemtra-qdhtthuockhruirotrongnam") {
                    $('html, body').animate({
                        "scrollTop": next.offset().top + 700
                    }, 'fast','swing', function () {
                        next.select2('open');
                    });
                } else {
                    next.focus();
                    if (next.data('info')) {
                        next.select2('open');
                    }
                }
                return false;
            }
        });
    }
};

setInterval(function () {
    $('#22').html(add22().toLocaleString());
    $('#31').html(add31().toLocaleString());
    $('#36').html((add36()).toLocaleString());
    // $('#54').html(add54().toLocaleString());
    // $('#58').html(add58().toLocaleString());
    // $('#66').html(add66().toLocaleString());
    // $('#68').html(add68().toLocaleString());
    // $('#72').html((add73() + add74()).toLocaleString());
    // $('#73').html(add73().toLocaleString());
    // $('#74').html(add74().toLocaleString());
}, 50);

function add22() {
    var total = 0;
    var temp = parseInt($('#ketquakttaitrusonnt-sothuetruythuvat').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#ketquakttaitrusonnt-sothuetruythutndn').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#ketquakttaitrusonnt-sothuetruythutncn').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#ketquakttaitrusonnt-sothuetruythuttdb').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#ketquakttaitrusonnt-sothuetruythukhac').val());
    if (temp) {
        total += temp;
    }

    return total;
}

function add31() {
    var total = 0;
    var temp = parseInt($('#ketquakttaitrusonnt-tienphat').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#ketquakttaitrusonnt-tienkksai').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#ketquakttaitrusonnt-tienphatnopcham').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#ketquakttaitrusonnt-tienphatviphamhanhchinhkhac').val());
    if (temp) {
        total += temp;
    }

    return total;
}

function add36() {
    var total = add22()+add31();
    var temp = parseInt($('#ketquakttaitrusonnt-sothuekhongduochoan').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#ketquakttaitrusonnt-sothuetruyhoan').val());
    if (temp) {
        total += temp;
    }

    return total;
}

ko.applyBindings({});

function focusNextInput() {

    if ($(this).val()) {

        var collapse = null;

        switch (this.id) {
            case 'nguoinopthue-masothue':

                getNguoiNopThueInfo(this.value);

                break;
            case 'quyetdinhkiemtra-soqdkiemtra':

                break;
            case 'quyetdinhxuly-soqdxuly':

                break;
            case 'baocaokiemtra-nganhnghekinhdoanh':
                $("#nhapquyetdinhdauvao").attr("aria-expanded", "true");
                collapse = $('#collapseOne');
                break;
            case 'baocaokiemtra-kiemtratheoquyettoanchidao':
                $("#nhapquyetdinhdaura").attr("aria-expanded", "true");
                collapse = $('#collapseTwo');
                break;
            default:
                break;
        }

        if (collapse !== null) {
            collapse.addClass('in');
            collapse.css("height", "auto");
        }

        // find next id and focus
        var form = $("div.ketquakttaitrusonnt-form");
        var focusable = form.find('input,select,button,textarea');
        var nextIndex = focusable.index(this) === focusable.length - 1 ? 0 : focusable.index(this) + 1;
        var next = focusable.eq(nextIndex);

        next.focus();
        if (next.data('info')) {
            next.select2('open');
        }
    }

}

function getNguoiNopThueInfo(id) {
    if (id > 0) {
        $.ajax({
            url: nNtUrlApi + id
        }).done(function (data) {
            $("#nguoinopthue-tennguoinop").html(data.tenNguoiNop);
        });
    }
}

$('#baocaokiemtra-doikiemtra').keyup(function () {
    this.value = this.value.toUpperCase();
});

function checkDateValiate(date) {
    var pattern = /(^(0?[1-9]|1[0-9]|2[0-9]|3[0-1])\/(0?[1-9]|1[0-2])\/([0-9]{2}|[0-9]{4})$)|^$/;

    return pattern.test(date);
}

function checkIntegerValiate(integer) {
    var pattern = /^[0-9]*$/;

    return pattern.test(integer);
}

//-------------------------shift enter handler-----------------------
function getCaret(el) {
    if (el.selectionStart) {
        return el.selectionStart;
    } else if (document.selection) {
        el.focus();

        var r = document.selection.createRange();
        if (r == null) {
            return 0;
        }

        var re = el.createTextRange(),
            rc = re.duplicate();
        re.moveToBookmark(r.getBookmark());
        rc.setEndPoint('EndToStart', re);

        return rc.text.length;
    }
    return 0;
}
//------------------------- end shift enter handler-----------------------

