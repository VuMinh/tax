var id;
var lenght;

function insert() {
    var settings = {
        "async": true,
        "crossDomain": true,
        "url": baseUrl + "../api/v1/nguoinopthues",
        "method": "POST",
        "data": {
            "maSoThue": $('#nguoinopthue-masothue').val(),
        }
    };

    $.ajax(settings).done(function (response) {
        console.log(response);
        $(document).ready(function () {
            $("input[id=idvalue]").val(response.id);
            return id = response.id;
        });
    });
}

function update() { // update data after save()
    var settings = {
        "async": true,
        "crossDomain": true,
        "url": baseUrl + "../api/v1/nguoinopthues/" + id,
        "method": "PATCH",
        "headers": {
            "content-type": "application/x-www-form-urlencoded",
            "cache-control": "no-cache",
            "postman-token": "c0e6005d-be66-1bc6-d8a2-dd4c20ce5cfc"
        },
        "data": {
            "tenNguoiNop": $('#nguoinopthue-tennguoinop').val(),
            "ghiChu": $('#nguoinopthue-ghichu').val(),
            "diaChi": $('#nguoinopthue-diachi').val(),
            'emailTbthue': $('#nguoinopthue-emailtbthue').val()
        }
    }

    $.ajax(settings).done(function (response) {
        console.log(response);
    });
}

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

                var settings = {
                    "async": true,
                    "crossDomain": true,
                    "url": baseUrl + "../api/v1/nguoinopthues",
                    "method": "GET",
                    "headers": {
                        "content-type": "application/x-www-form-urlencoded",
                        "cache-control": "no-cache",
                        "postman-token": "13266a87-bfd3-ea74-bd6e-e9f63a523f61"
                    },
                }

                $.ajax(settings).done(function (response) {
                    console.log(response);
                    lenght = $(response.items).length;
                    console.log(lenght);
                    for (i = 0; i < lenght; i++) {
                        if ($('#nguoinopthue-masothue').val() == response.items[i].maSoThue) {
                            $("input[id=idvalue]").val(1);
                            id = response.items[i].id;
                        }
                        else {
                            $("input[id=idvalue]").val(0);
                        }
                    }
                    if ($("input[id=idvalue]").val() == 0) {
                        insert();
                    }
                    else {
                        update();
                    }
                });

            }
        });
    }
};

ko.applyBindings({});