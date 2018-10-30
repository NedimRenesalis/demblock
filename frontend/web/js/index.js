
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

    $('#registerform-location').on('change', function(){
        var $me = $(this);
        var text = $me.find(':selected').text();
        var value = $me.find(':selected').val();

        $('#registerform-dialcode').val(value);

    });
    
    $('#registerform-password').on('keyup', function() {
        // do something
        var strength = 0;
        var numberOfChars = false;
        var following = false;
        var contains = false;

        if(this.value.length == 0) {
            $('.pcs__strenght-text').text('Weak');
            $('.pcs__flags span').css('background', '#c0c0c0');
            $('.pcs__flags span:first-child').css('background', '#ff0000');
        }

        if(this.value.length >= 6) {
            strength++;
            numberOfChars = true;
            $('.pcc__char-count .pcc__icon').css('background-position-y','0');
        } else {
            $('.pcc__char-count .pcc__icon').css('background-position-y','-13px');
        }

        if(this.value.match(/^[a-zA-Z0-9\-!$%^&*()_+|~=`{}\[\]:";'<>?,.\/]+$/i)) {
            strength++;
            contains = true;
            $('.pcc__symbol .pcc__icon').css('background-position-y','0');
        } else {
            $('.pcc__symbol .pcc__icon').css('background-position-y','-13px');
        }

        if(this.value.match(/[a-z]{2}/i) || this.value.match(/[A-Z]{2}/i) ||
            this.value.match(/[0-9]{2}/i) || this.value.match(/[0!$%^&*()_+|~=`{}\[\]:";'<>?,.\/]{2}/i)) {
            strength++;
            following = true;
            $('.pcc__following-symbol .pcc__icon').css('background-position-y','0');
        } else {
            $('.pcc__following-symbol .pcc__icon').css('background-position-y','-13px');
        }


        if(strength === 1){
            $('.pcs__strenght-text').text('Weak');
            $('.pcs__flags span').css('background', '#c0c0c0');
            $('.pcs__flags span:first-child').css('background', '#ff0000');
        } else if(strength === 2){
            $('.pcs__strenght-text').text('Medium');
            $('.pcs__flags span').css('background', '#ff9900');
            $('.pcs__flags span:last-child').css('background', '#c0c0c0');
        } else if(strength === 3){
            $('.pcs__strenght-text').text('Strong');
            $('.pcs__flags span').css('background', '#10e735');
        }

        $('.password-checker').show();
        setTimeout(function(){  $('.password-checker').hide(); }, 2000);
    });

    $('body').on('click', function(){
        $('.password-checker').hide();
    });

    $('#advertimage-imagesgallery').on('filebatchselected', function() {
        $('#advertimage-imagesgallery').fileinput("upload");
    });
    
    $('.file-loading').on('filesorted', function(event, params) {
        $.post($('#advertimage-imagesgallery').data('sort-company-images'), { images: JSON.stringify(params.stack) }, function(json) {}, 'json');
    });
});
