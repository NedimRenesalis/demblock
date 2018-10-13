
$(document).ready(function () {

    var language = Cookies.get().language;
    var basePath = window.location.protocol + "//" + window.location.host + "/";

    if( language == undefined || (language != "BA" && language != "EN" && language != "DE")){
        Cookies.set("language","BA", basePath);
    }

    $("#" + Cookies.get("language")).hide();

    $("#BA").on("click", function () {
        Cookies.set("language","BA", basePath);
        location.reload();
    });
    $("#BA-mob").on("click", function () {
        Cookies.set("language","BA", basePath);
        location.reload();
    });
    $("#DE").on("click", function () {
        Cookies.set("language","DE", basePath);
        location.reload();
    });
    $("#DE-mob").on("click", function () {
        Cookies.set("language","DE", basePath);
        location.reload();
    });
    $("#EN").on("click", function () {
        Cookies.set("language","EN", basePath);
        location.reload();
    });
    $("#EN-mob").on("click", function () {
        Cookies.set("language","EN", basePath);
        location.reload();
    });

    $(".display-description").on("click", function () {
        var id = $(this).data('id');
        $(".advert-desc[data-desc-id=" + id + "]").toggle();
    });
});
