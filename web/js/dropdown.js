/**
 * Created by vietv on 3/27/2017.
 */




$("#baocaokiemtra-nganhnghekd").select2().select2("val", "8");

$( "#a_1" ).click(function(event) {
    $("#nhapquyetdinhdauvao").attr("aria-expanded", "true");
    var collapse = $('#collapseOne');

    collapse.addClass('in');
    collapse.css("height", "auto");

    var select = $("#quyetdinhkiemtra-soqdkiemtra");
    select.focus();
    select.select2('open');

    event.preventDefault();
});

$( "#a_2" ).click(function() {
    $("#nhapquyetdinhdaura").attr("aria-expanded", "true");
    var collapse = $('#collapseTwo');

    collapse.addClass('in');
    collapse.css("height", "auto");

    var select = $("#baocaokiemtra-ngaykybbkt");
    select.focus();

    event.preventDefault();
});

$( "#a_3" ).click(function() {
    var collapse = $('#collapseThree');

    collapse.addClass('in');
    collapse.css("height", "auto");

    var select = $("#baocaokiemtra-truythuthuegtgt");
    select.focus();

    event.preventDefault();
});

$( "#a_4" ).click(function() {
    var collapse = $('#collapseFour');

    collapse.addClass('in');
    collapse.css("height", "auto");

    var select = $("#baocaokiemtra-hanhvivipham");
    select.focus();

    event.preventDefault();
});



