<?php
/**
 * Created by PhpStorm.
 * User: conghuyvn8x
 * Date: 7/13/2017
 * Time: 8:01 PM
 */
?>
<div class="col-1-1">
    <ul class="tab-detail">
        <li class="active" data-content="location">Map</li>
        <li data-content="overview">Parameter</li>
        <div class="c" style="height:0px;"></div>
    </ul>

    <div id="loadcontentinfo">

        <div class="loadingfor"><i class="fa fa-refresh fa-spin fa-3x"></i></div>
        <div id="overview" class="tabcontentdetail">
            <div></div>
            <!----->
            <div>
                <?php if ($listParam) {
                    foreach ($listParam as $param) {
                        ?>
                        <div class="c10"></div>

                        <div class="col-1-1" style=" font-weight:bold; color:#756255"><?php echo $param->name ?></div>
                        <div class="c10"></div>
                        <?php
                        $listParamAttr = $param->getParamAttr();
                        if (!empty($listParamAttr)) {
                            foreach ($listParamAttr as $pAttr) {
                                ?>
                                <div class="col-1-4 m-width-30"
                                     style="padding-top:0px; margin-top:0px; margin-bottom:5px;">
                                    <i class="fa fa-check" style="margin-right:5px; color:#390"></i>
                                    <?php echo $pAttr['name'] ?>
                                </div>
                                <?php
                            }
                        }
                        ?>

                    <?php }
                } ?>


            </div>
            <div class="c10"></div>
        </div>
        <div id="location" class="tabcontentdetail" style="display:block">
            <div style="border:solid 1px #CCC; height:400px" id="map"></div>
            <script src="http://maps.googleapis.com/maps/api/js?sensor=false&key=&key=AIzaSyCuSwKlh2beWJwv4YLfAE0YQYwua0LMF3c"></script>
            <script>
                var infowindow = new google.maps.InfoWindow({size: new google.maps.Size(150, 50)});
                var map;
                var latidude;
                var longtidude;
                var title;
                title = '<div style="width:250px; min-height:50px;"><h2 style="font-size:12px; text-transform:uppercase; padding0px; margin:0px; padding-bottom:5px"><?php echo $chain['name'] ?></h2><div><?php echo $chain['address'] ?></div></div>';

                function initializeMaps() {

                    var latlng = new google.maps.LatLng(<?php echo $chain['lat'] ?>, <?php echo $chain['log'] ?>);
                    var myOptions = {
                        zoom: 12,
                        center: latlng,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };

                    map = new google.maps.Map(document.getElementById("map"), myOptions);
                    createMarkerMaps(latlng, title);

                }

                function createMarkerMaps(latlng, html) {

                    var contentString = html;
                    var marker = new google.maps.Marker({
                        position: latlng,
                        map: map,
                        zIndex: Math.round(latlng.lat() * -100000) << 5

                    });


                    infowindow.setContent(contentString);
                    infowindow.open(map, marker);

                    google.maps.event.addListener(marker, 'click', function () {
                        infowindow.setContent(contentString);
                        infowindow.open(map, marker);
                    });

                }
                google.maps.event.addDomListener(window, 'load', initializeMaps);
            </script>
        </div>


    </div>
</div>
