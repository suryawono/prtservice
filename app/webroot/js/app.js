$(document).ready(function () {
})
function changeStatus(id, status, url) {
    $.ajax({
        type: "PUT",
        url: url,
        data: {id: id, status: status},
        dataType: "JSON",
        success: function (data) {
            alert(data.message);
        },
        error: function () {

        }
    })
}