
var nNtUrlApi = baseUrl + '../api/v1/nguoinopthues/'; // nguoi nop thue
var qdxlUrl = baseUrl + 'bao-cao-bao-hiem-xa-hoi/check-qdxl?qdxl=';
ko.bindingHandlers.nextFieldOnEnter = {
    init: function (element, valueAccessor, allBindingsAccessor) {
        $(element).on('keydown', 'input,select,textarea', function (e) {

            var self = $(this)
                , form = $(element)
                , focusable, nextIndex, listLength, curPos
                , next
                ;
            if (e.keyCode === 13 && event.shiftKey) {
                var content = this.value;
                var caret = getCaret(this);
                var s1 = content.substring(0, caret);
                var s2 = caret !== content.length ? content.substring(caret, content.length - 1) : "";
                this.value = s1 + "\n" + s2;
                e.stopPropagation();
            }else if (e.keyCode == 13) {
                focusable = form.find('input,textarea,select');
                if ($(this).data("type") === "angular-control") {
                    listLength = angular.element('#bcbhxhform').scope().listBCBHXHTN.length;
                    curPos = focusable.index(this);
                    nextIndex = focusable.index(this) + listLength >= focusable.length - 1 ? focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) - 8 * listLength + 1 : focusable.index(this) + listLength;
                    if (focusable.index(this) == focusable.length - listLength - 1) {
                        nextIndex = focusable.length - 1;
                    }
                } else {
                    nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
                }

                if (nextIndex == 7){
                    // var soQdxl = angular.element( document.querySelector( '#quyetdinhxuly-soqdxuly' )).val();
                    // var qdxl_exist = checkQdxl(soQdxl);
                    // console.log(qdxl_exist);
                }

                next = focusable.eq(nextIndex);

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

                angular.element('#bcbhxhform').scope().updateDataToDb();

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

    var form = $("div.baocaobaohiemxahoi-form");
    var focusable = form.find('input,select,button,textarea');
    var nextIndex = focusable.index(this) === focusable.length - 1 ? 0 : focusable.index(this) + 1;
    var next = focusable.eq(nextIndex);

    if(this.id == 'nguoinopthue-masothue'){
        getNguoiNopThueInfo(this.value);
    }

    next.focus();
    if (next.data('info')) {
        next.select2('open');
    }

}

var watchesApp = angular.module('ttxApp', []);
watchesApp.controller('bcktCtrl', ['$scope', '$http', '$filter', '$timeout', function ($scope, $http, $filter, $timeout) {
    $scope.listBCBHXHTN = [
        {
            "id": null,
            "mst": null,
            "soQdxlId": null,
            "namKtbhxh": null,
            "soBhxhPhaiNop": null,
            "soBhxhDaNop": null,
            "soKpcdPhaiNop": null,
            "soKpcdDaNop": null,
            "laoDongTrichBhxh": null,
            "laoDongChuaTrichBhxh": null,
            "laoDongTrichKpcd": null,
            "laoDongChuaTrichKpcd": null,
            "ghiChu": null,
            "ghiChu3": null,
            "ghiChu4": null

        }
    ];


    $scope.addAnswer = function () {
        $scope.listBCBHXHTN.push({
            "id": null,
            "mst": null,
            "soQdxlId": null,
            "namKtbhxh": null,
            "soBhxhPhaiNop": null,
            "soBhxhDaNop": null,
            "soKpcdPhaiNop": null,
            "soKpcdDaNop": null,
            "laoDongTrichBhxh": null,
            "laoDongChuaTrichBhxh": null,
            "laoDongTrichKpcd": null,
            "laoDongChuaTrichKpcd": null,
            "ghiChu": null,
            "ghiChu3": $("#nguoinopthue-masothue option:selected").html(),
            "ghiChu4": $("#quyetdinhxuly-soqdxuly").val()
        });
    };

    $scope.loadDataFromDb = function () {
        var curMst = $("#mst").val();
        var curSoQd = $("#qdxl").val();

        if (curMst == null || curSoQd == null || curMst == "" || curSoQd == "") {
            return;
        }

        if ($scope.mst !== curMst || $scope.soQdXLId !== curSoQd) {
            $scope.mst = curMst;
            $scope.soQdXLId = curSoQd;
            $http({
                "method": 'GET',
                "url": baseUrl + "../api/v1/baocaobaohiemxahoitheonams/mst-qd/" + curMst + "," + curSoQd
            }).success(function (data) {
                if (data.length > 0) {
                    $scope.listBCBHXHTN = data;
                } else {
                    $scope.listBCBHXHTN = [{
                        "id": null,
                        "mst": null,
                        "soQdxlId": null,
                        "namKtbhxh": null,
                        "soBhxhPhaiNop": null,
                        "soBhxhDaNop": null,
                        "soKpcdPhaiNop": null,
                        "soKpcdDaNop": null,
                        "laoDongTrichBhxh": null,
                        "laoDongChuaTrichBhxh": null,
                        "laoDongTrichKpcd": null,
                        "laoDongChuaTrichKpcd": null,
                        "ghiChu": null,
                        "ghiChu3": curMst,
                        "ghiChu4": curSoQd
                    }];
                }
            }).error(function (data, status, headers, config) {
            });
        }
    };

    $scope.loadDataFromDb1 = function () {
        var curMst = $("#nguoinopthue-masothue option:selected").html();
        var curSoQd = $("#quyetdinhxuly-soqdxuly").val();

        if (curMst == null || curSoQd == null || curMst == "" || curSoQd == "") {
            return;
        }
        angular.forEach($scope.listBCBHXHTN, function (bcbhxh) {
            bcbhxh.ghiChu3 = curMst;
            bcbhxh.ghiChu4 = curSoQd;
        });

    };

    $scope.loadDataFromDb();

    $scope.updateDataToDb = function () {
        var curMst = $("#nguoinopthue-masothue").val();
        var curSoQd = $("#quyetdinhxuly-soqdxuly").val();

        if (curMst == null || curSoQd == null || curMst == "" || curSoQd == "") {
            return;
        }

        $scope.loadDataFromDb1();

        console.log($scope.listBCBHXHTN);

        angular.forEach($scope.listBCBHXHTN, function (bcbhxh) {
            if (bcbhxh.namKtbhxh !== null) {
                if (bcbhxh.id === null) {
                    $http({
                        "method": 'POST',
                        "url": baseUrl + "../api/v1/baocaobaohiemxahoitheonams",
                        "data": bcbhxh
                    }).success(function (data) {
                        bcbhxh.id = data.id;
                    });
                } else {
                    $http({
                        "method": 'PUT',
                        "url": baseUrl + "../api/v1/baocaobaohiemxahoitheonams/" + bcbhxh.id,
                        "data": bcbhxh
                    }).success(function (data) {
                    });
                }
            }
        });
    };

}]);

$('#bcbhxhform').on('keyup keypress', function (e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
        e.preventDefault();
        return false;
    }
});

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
        });
    }
}
console.log(checkQdxl(4599));
function checkQdxl(id) {
    if (id > 0) {
        $.ajax({
            url: qdxlUrl + id
        }).done(function (data) {
            return data;
        });
    }
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