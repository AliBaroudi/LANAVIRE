( function( $ ) {

  $(document).ready(function(){

    window.ds_panorama_init = function(){

      $('.et_pb_ds_panorama').each(function(){
        $(this).find(".et_pb_ds_panorama_wrapper").panorama_viewer({
          repeat: $(this).data('repeat') == 1,            //false,              // The image will repeat when the user scroll reach the bounding box. The default value is false.
          direction: $(this).data('direction'),           //"horizontal",       // Let you define the direction of the scroll. Acceptable values are "horizontal" and "vertical". The default value is horizontal
          animationTime: $(this).data('animation-time'),  //700,                // This allows you to set the easing time when the image is being dragged. Set this to 0 to make it instant. The default value is 700.
          easing: $(this).data('easing'),                 //"ease-out",         // You can define the easing options here. This option accepts CSS easing options. Available options are "ease", "linear", "ease-in", "ease-out", "ease-in-out", and "cubic-bezier(...))". The default value is "ease-out".
          overlay: $(this).data('overlay') == 1,          //true                // Toggle this to false to hide the initial instruction overlay
        });

      });
    }

    if ( window.et_load_event_fired ) {
      window.ds_panorama_init();
    } else {
      $(window).load(function(){
        window.ds_panorama_init();
      });
    }

  });

} )( jQuery );
