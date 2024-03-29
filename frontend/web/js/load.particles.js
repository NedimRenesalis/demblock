

(function ($) {
    "use strict";
    jQuery(document).on("ready", function () {

      particlesJS('particles-js',
  
        {
          "particles": {
            "number": {
              "value": 100,
              "density": {
                "enable": true,
                "value_area": $(window).width()/2
              }
            },
            "color": {
              "value": "#fff"
            },
            "shape": {
              "type": "dot",
              "stroke": {
                "width": 0,
                "color": "transparent"
              },
              "polygon": {
                "nb_sides": 8
              },
              "image": {
                "src": "img/github.svg",
                "width": 100,
                "height": 100
              }
            },
            "opacity": {
              "value": 0.3083770200778445,
              "random": false,
              "anim": {
                "enable": false,
                "speed": 1,
                "opacity_min": 0.1,
                "sync": false
              }
            },
            "size": {
              "value": 8.33451405615796,
              "random": true,
              "anim": {
                "enable": false,
                "speed": 40,
                "size_min": 0.1,
                "sync": false
              }
            },
            "line_linked": {
              "enable": true,
              "distance": 116.68319678621143,
              "color": "#ffffff",
              "opacity": 0.35838410441479224,
              "width": 0.833451405615796
            },
            "move": {
              "enable": true,
              "speed": 3,
              "direction": "none",
              "random": false,
              "straight": false,
              "out_mode": "out",
              "bounce": false,
              "attract": {
                "enable": false,
                "rotateX": 1166.8319678621144,
                "rotateY": 1200
              }
            }
          },
          "interactivity": {
            "detect_on": "canvas",
            "events": {
              "onhover": {
                "enable": false,
                "mode": "grab"
              },
              "onclick": {
                "enable": true,
                "mode": "push"
              },
              "resize": true
            },
            "modes": {
              "grab": {
                "distance": 400,
                "line_linked": {
                  "opacity": 1
                }
              },
              "bubble": {
                "distance": 400,
                "size": 40,
                "duration": 2,
                "opacity": 8,
                "speed": 3
              },
              "repulse": {
                "distance": 200,
                "duration": 0.4
              },
              "push": {
                "particles_nb": 4
              },
              "remove": {
                "particles_nb": 2
              }
            }
          },
          "retina_detect": true
        }
  
      );
    });
  
  })(jQuery);
  
  
  
  /*================================ End ====================================*/