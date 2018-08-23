/**
 * Created by Minh on 4/6/2017.
 */

var qDktUrlApi = baseUrl + '../api/v1/quyetdinhkiemtras'; // quyet dinh kiem tra
var qDttUrlApi = baseUrl + '../api/v1/quyetdinhthanhtras'; // quyet dinh thanh tra
var nNtUrlApi = baseUrl + '../api/v1/nguoinopthues/'; // nguoi nop thue
var sTdoiUrlApi = baseUrl + '../api/v1/sotheodoisauhoanthues'; // so theo doi sau hoan thue
var qDthhtUrlApi = baseUrl + '../api/v1/quyetdinhthuhoihoanthues'; // quyet dinh thanh tra sau hoan thue
var actionQdktUrl = baseUrl + 'so-theo-doi-sau-hoan-thue/get-quyet-dinh-kiem-tra';//lấy quyet dinh kiem tra
var actionQdTtUrl = baseUrl + 'so-theo-doi-sau-hoan-thue/get-quyet-dinh-thanh-tra';//lấy quyết định thanh tra
var actionQdThhtUrl = baseUrl + 'so-theo-doi-sau-hoan-thue/get-quyet-dinh-thu-hoi-hoan-thue';
var actionSearchQdkt = baseUrl + 'so-theo-doi-sau-hoan-thue/search-quyet-dinh-kiem-tra';
var actionSearchQdtt = baseUrl + 'so-theo-doi-sau-hoan-thue/search-quyet-dinh-thanh-tra';
var actionStdshtUrl = baseUrl + 'so-theo-doi-sau-hoan-thue/get-so-theo-doi-sau-hoan-thue-by-qdkt';// get so theo doi sau hoan thue by mst
var actionStdshtUrltt = baseUrl + 'so-theo-doi-sau-hoan-thue/get-so-theo-doi-sau-hoan-thue-by-qdtt';
var qDthhApi = baseUrl + '../api/v1/quyetdinhthuhoihoanthues';
var qDxuphat = baseUrl + '../api/v1/quyetdinhxuphats';
var vBhoanthue = baseUrl + '../api/v1/vanbanhoanthues';

$('#stdshform').on('keyup keypress', function (e) {
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

                //auto open tab
                var collapse = null;

                switch (this.id) {
                    case 'quyetdinhkiemtra-soqdkiemtra':
                        if (!this.value) {
                            $(this).parent().find('.help-block').html("Số QĐ không được để trống");
                            $(this).parent().addClass('has-error');
                            return;
                        }
                        else {
                            $(this).parent().removeClass('has-error');
                            $(this).parent().find('.help-block').html("");
                        }
                        break;
                    case 'sotheodoisauhoanthue-sothuekhongduochoan':
                        $("#quyetdinhthuhoi").attr("aria-expanded", "true");
                        collapse = $('#collapseThree');

                        break;
                    case 'quyetdinhthuhoihoanthue-sotienthuethuhoi':
                        $("#quyetdinhxuphat").attr("aria-expanded", "true");
                        collapse = $('#collapseFour');

                        break;
                    case 'quyetdinhxuphat-tienchamnop':
                        $("#vanbanhoanthue").attr("aria-expanded", "true");
                        collapse = $('#collapseFive');

                        break;
                    case 'vanban-sotienlai':
                        $("#danopnsnn").attr("aria-expanded", "true");
                        collapse = $('#collapseSix');

                        break;
                    default:
                }

                if (collapse != null) {
                    collapse.addClass('in');
                    collapse.css("height", "auto");
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

ko.applyBindings({});


function focusNextInput() {

    if ($(this).val()) {

        var collapse = null;


        switch (this.id) {
            case 'nguoinopthue-masothue':

                getNguoiNopThueInfo($(this).val());

                $("#quyetdinhkiemtra-thanhtra").attr("aria-expanded", "true");
                collapse = $('#collapseTwo');

                break;
            case 'sotheodoisauhoanthue-latochuc':
                $("#truonghophoanthue").attr("aria-expanded", "true");
                collapse = $('#collapseOne');
                break;

            default:

        }

        if (collapse != null) {
            collapse.addClass('in');
            collapse.css("height", "auto");
        }

        // find next id and focus
        var form = $("div.sotheodoisauhoanthue-form");
        var focusable = form.find('input,select,button,textarea');
        var nextIndex = focusable.index(this) === focusable.length - 1 ? 0 : focusable.index(this) + 1;
        var next = focusable.eq(nextIndex);

        next.focus();
        if (next.data('info')) {
            next.select2('open');
        }

    }

}

function checkDateValiate(date) {
    var pattern = /(^(0?[1-9]|1[0-9]|2[0-9]|3[0-1])\/(0?[1-9]|1[0-2])\/([0-9]{2}|[0-9]{4})$)|^$/;

    return pattern.test(date);
}

function checkIntegerValiate(integer) {
    var pattern = /^[0-9]*$/;

    return pattern.test(integer);
}

function getNguoiNopThueInfo(id) {
    if (id > 0) {
        $.ajax({
            url: nNtUrlApi + id
        }).done(function (data) {
            $("#nguoinopthue-tennguoinop").html(data.tenNguoiNop);
            $("#id_nguoinopthue").val(data.id);
            console.log(data.tenNguoiNop);
        });
    }

}