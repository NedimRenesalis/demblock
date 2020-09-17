
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

  /*  $('#registerform-location').on('change', function(){
        var $me = $(this);
        var text = $me.find(':selected').text();
        var value = $me.find(':selected').val();

        $('#registerform-dialcode').val(value);

    });*/
    
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

    $('.register-failed-close').on('click', function(){
        $('.registration-failed').hide();
    });

    $('#advertsearch-order').on('change', function(){
        $('.search-again').click();
    });

    var pathEls = document.querySelectorAll('path');
    for (var i = 0; i < pathEls.length; i++) {
    var pathEl = pathEls[i];
    var offset = anime.setDashoffset(pathEl);
    pathEl.setAttribute('stroke-dashoffset', offset);
    anime({
        targets: pathEl,
        strokeDashoffset: [offset, 0],
        duration: anime.random(1000, 3000),
        delay: anime.random(0, 2000),
        loop: true,
        direction: 'alternate',
        easing: 'easeInOutSine',
        autoplay: true
    });
    }

    function fitElementToParent(el, padding) {
        var timeout = null;
        function resize() {
          if (timeout) clearTimeout(timeout);
          anime.set(el, {scale: 1});
          var pad = padding || 0;
          var parentEl = el.parentNode;
          var elOffsetWidth = el.offsetWidth - pad;
          var parentOffsetWidth = parentEl.offsetWidth;
          var ratio = parentOffsetWidth / elOffsetWidth;
          timeout = setTimeout(anime.set(el, {scale: ratio}), 10);
        }
        resize();
        window.addEventListener('resize', resize);
      }
      
      var sphereAnimation = (function() {
      
        var sphereEl = document.querySelector('.sphere-animation');
        var spherePathEls = sphereEl.querySelectorAll('.sphere path');
        var pathLength = spherePathEls.length;
        var hasStarted = false;
        var aimations = [];
      
        fitElementToParent(sphereEl);
      
        var breathAnimation = anime({
          begin: function() {
            for (var i = 0; i < pathLength; i++) {
              aimations.push(anime({
                targets: spherePathEls[i],
                stroke: {value: ['rgba(255,75,75,1)', 'rgba(80,80,80,.35)'], duration: 500},
                translateX: [2, -4],
                translateY: [2, -4],
                easing: 'easeOutQuad',
                autoplay: false
              }));
            }
          },
          update: function(ins) {
            aimations.forEach(function(animation, i) {
              var percent = (1 - Math.sin((i * .35) + (.0022 * ins.currentTime))) / 2;
              animation.seek(animation.duration * percent);
            });
          },
          duration: Infinity,
          autoplay: false
        });
      
        var introAnimation = anime.timeline({
          autoplay: false
        })
        .add({
          targets: spherePathEls,
          strokeDashoffset: {
            value: [anime.setDashoffset, 0],
            duration: 3900,
            easing: 'easeInOutCirc',
            delay: anime.stagger(190, {direction: 'reverse'})
          },
          duration: 2000,
          delay: anime.stagger(60, {direction: 'reverse'}),
          easing: 'linear'
        }, 0);
      
        var shadowAnimation = anime({
            targets: '#sphereGradient',
            x1: '25%',
            x2: '25%',
            y1: '0%',
            y2: '75%',
            duration: 30000,
            easing: 'easeOutQuint',
            autoplay: false
          }, 0);
      
        function init() {
          introAnimation.play();
          breathAnimation.play();
          shadowAnimation.play();
        }
        
        init();
      
      })();

    // FIRST TYPER
    var typed = new Typed('#first-typing', {
        strings: [
            "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries", 
            "Also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum"
        ],
        typeSpeed: 20,
        backSpeed: 20,
        //fadeOut: true,
        loop: true
    });

    // SECOND TYPER
    var typed2 = new Typed('#second-typing', {
        strings: [
            "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries", 
            "Also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum"
        ],
        typeSpeed: 20,
        backSpeed: 20,
        //fadeOut: true,
        loop: true
    });

    // THIRD TYPER
    var typed3 = new Typed('#third-typing', {
        strings: [
            "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries", 
            "Also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum"
        ],
        typeSpeed: 20,
        backSpeed: 20,
        //fadeOut: true,
        loop: true
    });

    // FOURTH TYPER
    var typed4 = new Typed('#fourth-typing', {
        strings: [
            "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries", 
            "Also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum"
        ],
        typeSpeed: 20,
        backSpeed: 20,
        //fadeOut: true,
        loop: true
    });

});
