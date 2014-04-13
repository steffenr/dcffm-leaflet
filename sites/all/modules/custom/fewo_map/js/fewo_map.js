(function($) {
  // Set zoom for leaflet map on specific pages.
  $(document).bind('leaflet.map', function(e, map, lMap) {
    // Zoom out map on specific node pages.
    if ($('#fewo_map_sidebar').length) {
      var sidebar = L.control.sidebar('fewo_map_sidebar', {
        closeButton: false,
        position: 'left'
      });
      lMap.addControl(sidebar);
      setTimeout(function() {
        sidebar.show();
      }, 500);
    }

    // Add weatcher overlay.
    var weatherLayer = new OsmJs.Weather.LeafletLayer({lang: 'ru'});
    lMap.addLayer(weatherLayer);

    $('.sidebar-toggle').click(function(e) {
      sidebar.toggle();
    });

    $('#fewo_map_sidebar a').click(function(e) {
      // Skip real link clicks
      e.preventDefault();
      var latitude = $(this).data('lat');
      var longitude = $(this).data('lon');
      lMap.setView({lat: latitude, lng: longitude}, 16);
    });
  });
})(jQuery);
