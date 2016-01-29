$( document ).ready(function(){
  var map = null;
  var marker = null;
  load_map();
});

  function load_map() {
    var trebujena = new google.maps.LatLng(36.870781, -6.174377100000015);
    var myOptions = {
      center: trebujena,
      zoom: 15,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map($("#map_canvas").get(0), myOptions);
    marker = new google.maps.Marker({ position: trebujena });
    marker.setMap(map);
  }
