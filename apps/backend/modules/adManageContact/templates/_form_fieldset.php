<?php if ('NONE' != $fieldset): ?>
    <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
<?php endif; ?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<?php
//tọa độ mặc định
$lat = 16.120784;
$lng = 106.158487;
$zoom = 6;
$maptype = 'google.maps.MapTypeId.ROADMAP';
$title = '';
$new = 0;
$content = "";
if (!$form->isNew() && $ad_contact->lat && $ad_contact->lng) {
    $new = 1;
    $lat = $ad_contact->lat;
    $lng = $ad_contact->lng;
    $zoom = $ad_contact->zoom;
    $maptype = $ad_contact->maptypeid;

    $content = '<div id="content">' .
            '<div id="siteNotice">' .
            '</div>' .
            '<h3 id="firstHeading" class="firstHeading"></h3>' .
            '<div id="bodyContent">' .
            '</div>' .
            '</div>';
}

$strScript = "<script>
            var map;
            var markers = [];
            function initialize() {
                var myLatlng = new google.maps.LatLng(" . $lat . "," . $lng . "); 
                var mapOptions = {
                  zoom: " . $zoom . ",
                  center: myLatlng,
                  mapTypeId: " . $maptype . "
                };
                map = new google.maps.Map(document.getElementById('map-canvas'),
                    mapOptions);
                if (" . $new . "==1){
                    var   contentString = '" . $content . "' ;
                     var infowindow = new google.maps.InfoWindow({
                        content: contentString
                    });

                    var marker = new google.maps.Marker({
                        position: myLatlng,
                        map: map,
                        title: '" . $title . "'
                    });
                    google.maps.event.addListener(marker, 'click', function() {
                      infowindow.open(map,marker);
                    });
                }
                google.maps.event.addListener(map, 'click', function(event) {
                  addMarker(event.latLng);
                });
                google.maps.event.addListener(map, 'zoom_changed', function(event) {
                  var zoomLevel = map.getZoom();
                  $('#ad_contact_zoom').val(zoomLevel);
                });
              }
           
            function addMarker(location) {
                deleteMarkers();
                var marker = new google.maps.Marker({
                  position: location,
                  map: map
                });
                markers.push(marker);
                var lat=location.lat();
                var lng=location.lng();
                
                $('#ad_contact_lat').val(lat);
                $('#ad_contact_lng').val(lng);
              
              }
           function setAllMap(map) {
                for (var i = 0; i < markers.length; i++) {
                  markers[i].setMap(map);
                }
              }

              // Removes the markers from the map, but keeps them in the array.
              function clearMarkers() {
                setAllMap(null);
              }

              // Shows any markers currently in the array.
              function showMarkers() {
                setAllMap(map);
              }
              
           function deleteMarkers() {
            clearMarkers();
            markers = [];
          }

          google.maps.event.addDomListener(window, 'load', initialize);
        </script>";

echo $strScript;
?>
<table cellpading="5" width="100%">
    <tr>
        <td valign="top">
            <fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
                <?php foreach ($fields as $name => $field): ?>
                    <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
                    <?php
                    include_partial('adManageContact/form_field', array(
                        'name' => $name,
                        'attributes' => $field->getConfig('attributes', array()),
                        'label' => $field->getConfig('label'),
                        'help' => $field->getConfig('help'),
                        'form' => $form,
                        'field' => $field,
                        'class' => 'sf_admin_form_row sf_admin_' . strtolower($field->getType()) . ' sf_admin_form_field_' . $name,
                        'ad_contact' => $ad_contact))
                    ?>
                <?php endforeach; ?>
            </fieldset>
        </td>
        <td>
            <div id="map-canvas" style="float: left; height: 750px; width: 650px; position: relative; background-color: rgb(229, 227, 223); overflow: hidden;"></div>
        </td>
    </tr>
</table>