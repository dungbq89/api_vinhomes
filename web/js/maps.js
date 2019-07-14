// google map
var map;
function CreateMap(locations) {
    var markers = [];
    // create empty LatLngBounds object
    var bounds = new google.maps.LatLngBounds();
    var myLatlng=new google.maps.LatLng(locations[0].Lat, locations[0].Lng);
    var mapOptions = {
        zoom: parseInt(locations[0].Zoom),
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    var infowindow = new google.maps.InfoWindow();
    for (var i = 1; i < locations.length; i++) {
        if (locations[i].Lng != '' && locations[i].Lat != '') {
            //makeMarker(locations[i]);
            var marker = new google.maps.Marker({
                map: map,
                position: new google.maps.LatLng(locations[i].Lat, locations[i].Lng),
                title: locations[i].Name,
                zIndex: i
            });

            markers.push(marker);
            // extend the bounds to include each marker's position
            bounds.extend(marker.position);
            
            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    map.setZoom(parseInt(locations[i].Zoom));
                    map.setCenter(marker.getPosition());
                    var htmlContent = '';
                        htmlContent += '<div style=\'text-align:left; width:300px;\'>';
                        htmlContent += '<div><span style=\'font-weight:bold;\'>' + locations[i].Name + '</span></div>';
                        htmlContent += '<div><strong>Điện thoại: </strong>' + locations[i].Phone + '</div>';
                        htmlContent += '<div><strong>Địa chỉ: </strong>' + locations[i].Address + '</div>';
                        htmlContent += '<div><strong>Giờ mở cửa: </strong>' + locations[i].Timeopen + '</div>';
                        htmlContent += '</div>';
                    infowindow.setContent(htmlContent);
                    infowindow.open(map,marker);
                }
            })(marker, i));
        }
    }

    // build stores
    BuildHtmlStores(locations);

    // set center
    if (markers.length > 1)
        // now fit the map to the newly inclusive bounds
        map.fitBounds(bounds);
    else if (markers.length == 1)
        map.setCenter(markers[0].getPosition());
}

BuildHtmlStores = function (locations) {
    var place = $("#vt-locations");
    $("#stores-count").text(locations.length-1);
    place.empty();
    for (var i = 0; i < locations.length; i++) {
        place.append(BuildHtmlStore(locations[i]));
    }
}
BuildHtmlStore = function (location) {
    var content = '';
    if(location.Name!=''){
        content += '<li>';
        content += '<p><strong><a href=\'javascript:{}\' class=\'location-detail\' zoom=\'' + location.Zoom + '\' longitude=\'' + location.Lng + '\' latitude=\'' + location.Lat + '\'>' + location.Name + '</a></strong></p>';
        content += '<p>Địa chỉ: ' + location.Address + '</p>';
        content += '<p>Điện thoại: ' + location.Phone + '</p>';
        content += '<p>Giờ mở cửa: ' + location.Timeopen + '</p>';
        content += '</li>';
    }
    return content;
}

$(".location-detail").live("click", function () {
    var longitude = $(this).attr("longitude");
    var latitude = $(this).attr("latitude");
    var zoom = $(this).attr("zoom");
    if (longitude != '' && latitude != '') {
        map.setZoom(parseInt(zoom));
        map.setCenter(new google.maps.LatLng(latitude, longitude));
    }
    else {
        alert("Vị trí này chưa cập nhật tọa độ");
    }
});

$("#vt-locations").niceScroll();
//$(".nicescroll-rails").appendTo($("form:first"));
//$(".nicescroll-rails").css("z-index", "3");