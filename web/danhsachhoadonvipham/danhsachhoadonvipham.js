/**
 * Created by vietv on 3/26/2017.
 * */

var nNtUrlApi = baseUrl + '../api/v1/nguoinopthues/'; // nguoi nop thue

$('#hdvpform').on('keyup keypress', function (e) {
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


                next.focus();
                if (next.data('info')) {
                    next.select2('open');
                }
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

                getNguoiMuaInfo(this.value);

                break;
            case 'danhsachhoadonvipham-ghichu1':

                getNguoiBanInfo(this.value);

                break;
            default:
                break;
        }

        // find next id and focus
        var form = $("div.danhsachhoadonvipham-form");
        var focusable = form.find('input,select,button,textarea');
        var nextIndex = focusable.index(this) === focusable.length - 1 ? 0 : focusable.index(this) + 1;
        var next = focusable.eq(nextIndex);

        next.focus();
        if (next.data('info')) {
            next.select2('open');
        }
    }

}

function getNguoiMuaInfo(id) {
    if (id > 0) {
        $.ajax({
            url: nNtUrlApi + id
        }).done(function (data) {
            $("#nguoimua").html(data.tenNguoiNop);
        });
    }
}

function getNguoiBanInfo(id) {
    if (id > 0) {
        $.ajax({
            url: nNtUrlApi + id
        }).done(function (data) {
            $("#nguoiban").html(data.tenNguoiNop);
        });
    }
}


