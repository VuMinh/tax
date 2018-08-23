/**
 * Created by Minh on 4/6/2017.
 */
var urlApi = "http://localhost" + baseUrl.replace('web', 'api');

var bCThanhTra = baseUrl + '../api/v1/baocaothanhtras';
var urlQDthanhtra = baseUrl + "bao-cao-thanh-tra/get-quyet-dinh-thanh-tra";
var urlQDtruythu = baseUrl + 'bao-cao-thanh-tra/get-quyet-dinh-truy-thu';
var actionQdTtUrl = baseUrl + '/bao-cao-thanh-tra/get-quyet-dinh-thanh-tra';
var actionSearchQdTt = baseUrl + 'bao-cao-thanh-tra/search-quyet-dinh-thanh-tra';
var actionBcTtUrl = baseUrl + '/bao-cao-thanh-tra/get-bao-cao-thanh-tra';
var actionSearchQdTruythu = baseUrl + 'bao-cao-thanh-tra/search-quyet-dinh-truy-thu';
var nguoiNopThue = baseUrl + '../api/v1/nguoinopthues/'; // nguoi nop thue
var qdThanhtra = baseUrl + '../api/v1/quyetdinhthanhtras';
var qDTruyThu = baseUrl + '../api/v1/quyetdinhtruythus';
var lSnopTtra = baseUrl + '../api/v1/lichsunopthanhtras';

$('#bcttform').on('keyup keypress', function (e) {
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
            if (e.keyCode == 13) {
                focusable = form.find('input,textarea,select');
                var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
                next = focusable.eq(nextIndex);
                var collapseInput = null;

                if ($(this).data('date')) {
                    if (!checkDateValiate(this.value)) {
                        $(this).parent().find('.help-block').html("Sai định dạng ngày tháng năm");
                        $(this).parent().addClass('has-error');
                        return;
                    }
                    else {
                        $(this).parent().removeClass('has-error');
                        $(this).parent().find('.help-block').html("");
                    }
                }

                if ($(this).data('int')) {
                    if (!checkIntegerValiate(this.value)) {
                        $(this).parent().find('.help-block').html("Trường này phải là số");
                        $(this).parent().addClass('has-error');
                        return;
                    }
                    else {
                        $(this).parent().removeClass('has-error');
                        $(this).parent().find('.help-block').html("");
                    }
                }

                switch (this.id) {
                    case 'baocaothanhtra-truongdoan':
                        $("#quyetdinhthanhtra").attr("aria-expanded", "true");
                        collapseInput = $('#collapseOne');

                        break;
                    case 'datevalidation-ngayqdthanhtra':
                        $("#tongthuthue").attr("aria-expanded", "true");
                        collapseInput = $('#collapseThree');

                        break;
                    case 'baocaothanhtra-tienphat1020':
                        $('#qdtruythu').attr('aria-expanded', 'true');
                        collapseInput = $('#collapseFour');

                        break;
                    case 'quyetdinhtruythu-soqdtruythu':

                        break;
                    case 'datevalidation-ngayqdtruythu':
                        $("#nopthanhtra").attr("aria-expanded", "true");
                        collapseInput = $('#collapseFive');

                        break;

                    default:
                }

                if (collapseInput != null) {
                    collapseInput.addClass('in');
                    collapseInput.css("height", "auto");
                }

                next.focus();
                if (next.data('info')) {
                    next.select2('open');
                }

                return false;
            }
        });
    }
};

function focusNextInput() {
    if ($(this).val()) {
        var collapse = null;
        switch (this.id) {
            case 'nguoinopthue-masothue':

                getNguoiNopThueInfo($(this).val());

                $("#quyetdinhthanhtra").attr("aria-expanded", "true");
                collapse = $('#collapseOne');

                break;
            case 'quyetdinhthanhtra-soqdthanhtra':
                checkQuyetdinhthanhtra();

                break;
            default:

        }

        if (collapse != null) {
            collapse.addClass('in');
            collapse.css("height", "auto");
        }

        var form = $("div.baocaothanhtra-form");
        var focusable = form.find('input,select,button,textarea');
        var nextIndex = focusable.index(this) === focusable.length - 1 ? 0 : focusable.index(this) + 1;
        var next = focusable.eq(nextIndex);

        next.focus();
        if (next.data('info')) {
            next.select2('open');
        }
    }
}


ko.applyBindings({});

function checkQuyetdinhthanhtra() {

    delay(0);

    var soqdthanhtra = $('#quyetdinhthanhtra-soqdthanhtra option:selected').text();
    if (soqdthanhtra && $('#quyetdinhthanhtra-soqdthanhtra').val()) {
        var promise = $.getJSON(actionSearchQdTt + '?so_qdthanhtra=' + soqdthanhtra);
        promise.done(function (data) {
            clearData(2);

            if (data.length == 0) {
                $('#id_qdthanhtra').val(0);
                saveQuyetDinhThanhTra();
            }
            else {
                getQuyetDinhThanhTraInfo(data[0].id);
                $('#id_qdthanhtra').val(data[0].id);
            }

            loading = 0;
            delay(1);

        });
    }
}

setInterval(function () {
    $('#7').html(add7().toLocaleString());
    $('#19').html(add19().toLocaleString());
}, 50);

function add7() {
    var total = 0;
    var temp = parseInt($('#baocaothanhtra-vattruythu').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#baocaothanhtra-tndn').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#baocaothanhtra-ttdb').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#baocaothanhtra-tncn').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#baocaothanhtra-monbai').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#baocaothanhtra-tienphat005').val());
    if (temp) {
        total += temp;
    }

    temp = parseInt($('#baocaothanhtra-tienphat1020').val());
    if (temp) {
        total += temp;
    }

    return total;
}

function add19() {
    var total = 0;
    var temp = parseInt($('#lichsunopthanhtra-danopthue').val());
    if (temp) {
        total = add7() - temp;
    }

    return total;
}



function getNguoiNopThueInfo(id) {
    if (id > 0) {
        $.ajax({
            url: nguoiNopThue + id
        }).done(function (data) {
            $("#tendoanhnghiep").html(data.tenNguoiNop);
            $("#id_nguoinopthue").val(data.id);
            console.log(data.tenNguoiNop);
        });
    }
}

function checkQuyetDinhTruyThu() {

    var soqdtruythu = $('#quyetdinhtruythu-soqdtruythu').val();

    if (soqdtruythu) {
        var promise = $.getJSON(actionSearchQdTruythu + '?so_qdtruythu=' + soqdtruythu);
        promise.done(function (data) {
            if (data.length == 0) {
                $('#id_qdtruythu').val(0);
                saveQuyetDinhTruyThu();
            }
            else {
                getQDTruythuInfo(data[0].id);
                $('#id_qdtruythu').val(data[0].id);
            }

        });
    }
}


$('#w0').on('keyup keypress', function (e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
        e.preventDefault();
        return false;
    }
});

// Enter was pressed without shift key
$("textarea").keydown(function (e) {
    // Enter was pressed without shift key
    if (e.keyCode == 13 && !e.shiftKey) {
        // prevent default behavior
        e.preventDefault();
    }
});

$('#baocaothanhtra-doikiemtra').keyup(function () {
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