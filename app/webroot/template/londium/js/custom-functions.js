$(document).ready(function () {
    $(".navigation").find(".active").parentsUntil($(".navigation")).siblings(".level-closed").trigger("click");
    $(".datetime").datetimepicker({
        format:"Y-m-d H:i"
    })
})

function filterReload() {
    $(".toggle-bar").click(function () {
        var target = $(this).data("toggle-target");
        $(".toggle-target").not("*[data-toggle-id='" + target + "']").hide();
        $("*[data-toggle-id='" + target + "']").slideToggle();
    })
}

function displayError(data) {

}

function exp(type, link) {
    switch (type) {
        case "print":
            window.open(link);
            break;
    }
}