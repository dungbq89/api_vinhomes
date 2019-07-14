<?php
/**
 * Created by PhpStorm.
 * User: conghuyvn8x
 * Date: 6/27/2018
 * Time: 9:33 PM
 */
?>
<footer class="site-footer offcanvas-wrapper" style="min-height: 0px">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <!-- Contact Info-->
                <section class="widget widget-light-skin">
                    <h3 class="widget-title">Tổng hợp địa điểm massage uy tín nhất Hà Nội, Sài Gòn, Đà Nẵng</h3>

                    <p class="text-white">Phone: 0972241089</p>

                    <p><a class="navi-link-light" href="#">massageviet@gmail.com</a></p><a
                        class="social-button shape-circle sb-facebook sb-light-skin" href="#"><i
                            class="facebook f large icon"></i></a><a
                        class="social-button shape-circle sb-twitter sb-light-skin" href="#"><i
                            class="twitter large icon"></i></a><a
                        class="social-button shape-circle sb-instagram sb-light-skin" href="#"><i
                            class="instagram large icon"></i></a><a
                        class="social-button shape-circle sb-google-plus sb-light-skin" href="#"><i
                            class="google plus icon"></i></a>
                </section>
            </div>

        </div>
    </div>
    <!-- Copyright-->
<!--    <p class="footer-copyright">Công Ty Cổ Phần Đầu Tư Công Nghệ BTL Việt Nam</p>-->

</footer>


<a class="scroll-to-top-btn" href="#"><i class="arrow up large icon" style="
      font-size:  20px;
      margin-left: 4px;
  "></i></a>

<div class="site-backdrop"></div>
<script type="text/javascript">
    window.navigator.geolocation.getCurrentPosition(function (position) {
        var pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
        };

        var x = {ll: pos, zoom: 16}
        document.cookie = 'location=' + JSON.stringify(x) + "endLocation"
    });
</script>
