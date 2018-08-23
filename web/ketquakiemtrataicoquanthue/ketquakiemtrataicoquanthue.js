/**
 * Created by vietv on 3/26/2017.
 * */

var nNtUrlApi = baseUrl + '../api/v1/nguoinopthues/'; // nguoi nop thue

$('#kqkttcptform').on('keyup keypress', function (e) {
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
            if (e.keyCode === 13) {
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

                if (collapse != null) {
                    collapse.addClass('in');
                    collapse.css("height", "auto");
                }


                next.focus();
                if (next.data('info')) {
                    next.select2('open');
                }
            }
        });
    }
};

setInterval(function () {
    $('#63').html(add63().toLocaleString());
    $('#49').html(add49().toLocaleString());
    $('#48').html((add49() + add54() + add58()).toLocaleString());
    $('#54').html(add54().toLocaleString());
    $('#58').html(add58().toLocaleString());
    $('#66').html(add66().toLocaleString());
    $('#68').html(add68().toLocaleString());
    $('#72').html((add73() + add74()).toLocaleString());
    $('#73').html(add73().toLocaleString());
    $('#74').html(add74().toLocaleString());
}, 50);

function add73() {
    var total = 0;
    var temp = parseInt($('#baocaokiemtra-nodongnamtruocchuyensang').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#lichsunopsaukiemtra-danopdongnamtruoc').val());
    if (temp) {
        total -= temp;
    }

    return total;
}

function add74() {
    var total = add49() + add54() + add58(); //48
    var temp = parseInt($('#baocaokiemtra-nodongphatsinhtrongnam').val());
    if (temp) {
        total += temp; // +65
    }

    total -= add68();

    return total;
}

function add68() {
    var total = 0;
    var temp = parseInt($('#lichsunopsaukiemtra-danopphatsinhtruythu').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#lichsunopsaukiemtra-danopphatsinhtruyhoan').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#lichsunopsaukiemtra-danoptienphat').val());
    if (temp) {
        total += temp;
    }

    return total;
}

function add63() {
    var total = 0;
    var temp = parseInt($('#baocaokiemtra-nodongnamtruocchuyensang').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#baocaokiemtra-nodongphatsinhtrongnam').val());
    if (temp) {
        total += temp;
    }

    return total;
}

function add66() {
    var total = 0;
    var temp = parseInt($('#lichsunopsaukiemtra-danopdongnamtruoc').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#lichsunopsaukiemtra-danopphatsinhtruythu').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#lichsunopsaukiemtra-danopphatsinhtruyhoan').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#lichsunopsaukiemtra-danoptienphat').val());
    if (temp) {
        total += temp;
    }

    return total;
}

function add49() {
    var total = 0;
    var temp = parseInt($('#baocaokiemtra-truythuthuegtgt').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#baocaokiemtra-truythuthuetndn').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#baocaokiemtra-truythuthuetncn').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#baocaokiemtra-truythuthuekhac').val());
    if (temp) {
        total += temp;
    }

    return total;
}

function add54() {
    var total = 0;
    var temp = parseInt($('#baocaokiemtra-truyhoanthuegtgt').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#baocaokiemtra-truyhoanthuetncn').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#baocaokiemtra-truyhoanthuekhac').val());
    if (temp) {
        total += temp;
    }

    return total;
}

function add58() {
    var total = 0;
    var temp = parseInt($('#baocaokiemtra-phattronthue').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#baocaokiemtra-phathanhchinhkhac1020').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#baocaokiemtra-phatchamnop').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#baocaokiemtra-phatkhac').val());
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
            default:
                break;
        }

        // find next id and focus
        var form = $("div.ketquakiemtrataicoquanthue-form");
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
            $("#id_nguoinopthue").val(data.id);
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

