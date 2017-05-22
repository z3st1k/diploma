/**
 * Created by Yaroslav on 15.03.2017.
 */

$.fn.serializeObject = function() {
    var o = Object.create(null),
        elementMapper = function(element) {
            element.name = $.camelCase(element.name);
            return element;
        },
        appendToResult = function(i, element) {
            var node = o[element.name];

            if ('undefined' != typeof node && node !== null) {
                o[element.name] = node.push ? node.push(element.value) : [node, element.value];
            } else {
                o[element.name] = element.value;
            }
        };

    $.each($.map(this.serializeArray(), elementMapper), appendToResult);
    return o;
};

function changeDealStatus(url, dealId, $status) {
    $.ajax({
        url: url + "deals/changeStatus",
        data: {
            status: $status,
            id: dealId
        },
        method: 'POST',
        success: function (response) {
            var data = $.parseJSON(response);

            if (data.code == 201) {
                $.notify(data.msg, {
                    align: "left",
                    verticalAlign: "top",
                    type: "success",
                    icon: "check"
                });

                setTimeout(function () {
                    location.reload();
                }, 1000);
            } else if (data.code == 101) {
                $.notify(data.msg, {
                    align: "left",
                    verticalAlign: "top",
                    type: "danger",
                    icon: "close"
                });
            }
        }
    });
}