<div class="">
    <link href="css/flexslider.css" rel="stylesheet" type="text/css">
    <div class="box-slide" style="min-height:500px">
        <div style="position:relative;">
        <?php include_component('pageHome', 'slide') ?>
        <?php include_component('pageHome', 'booking') ?>

        </div>
        <script defer src="js/jquery.flexslider.js"></script>
        <script type="text/javascript">
            $(window).load(function () {
                $('.flexslider').flexslider({
                    animation: "slide",
                    start: function (slider) {

                    }
                });
            });

        </script>
    </div>
</div>
<script>
    $(function () {
        $('#houses').change(function () {
            $('#roomtype').load("/index4.php?page=ajaxroom&id=" + $(this).val());
        });


    });

</script>


<script type="text/javascript">
    $(function () {
        $('.notNull').change(function () {
            check_booking();
        });
    });
    function check_booking() {
        ok = true;
        $('#bookingform .error').remove();
        $('#bookingform .notNull').each(function () {
            if ($(this).val() == '') {
                /*if($(this).attr('id')=='sercurity'){
                 $("<div class='error'>&nbsp; " + $(this).attr('data-alert') + "</div>").insertAfter($('#imgCaptcha'));
                 }else{*/
                $("<div class='error'>&nbsp; " + $(this).attr('data-alert') + "</div>").insertAfter($(this));
                ok = false;
                // }
            }
        });


        if ($("#bookingform #email").val() != '') {
            checkEmail = $('#bookingform #email').val();
            if ((checkEmail.indexOf('@') < 0) || ((checkEmail.charAt(checkEmail.length - 4) != '.') && (checkEmail.charAt(checkEmail.length - 3) != '.'))) {
                $("<span class='error'> *  </span>").insertAfter($("#bookingform #email"));
                ok = false;
            } else {
                $("#bookingform #email").text("");
            }
            ;
        }


        if (ok == true) {
            $('#bookingform').ajaxForm({
                beforeSubmit: function (a, f, o) {
                    $('#contactform').fadeTo('fast', 0.3);
                    $('.waiting').show();
                    o.dataType = 'html';
                },

                success: function (data) {
                    $('#bookingform').fadeTo('fast', 1);
                    $('.waiting').hide();
                    var str1 = data;
                    var str2 = "CAPTCHA";
                    if (str1.indexOf(str2) == -1) {
                        $('#bookingform')[0].reset();
                    }
                    alert(data);
                    clearForm: true;
                }
            });
        }
        return ok;
    }

</script>
<div class="grid">
    <div class="c20"></div>
    <div class="col-1-4 mobile-col-1-1 tab-col-1-1">
        <h1 class="title-first-home">
            <span>Newland House</span>
        </h1>

        <div class="c20"></div>
        <div align="justify">
            <strong><span style="color: rgb(0, 128, 0);">NEWLAND &nbsp;</span></strong><span
                style="color: rgb(0, 128, 0);">Hotel studio apartment</span><strong>&nbsp;</strong>is a perfect
            choice as you can enjoy the following benefits<strong>:</strong>
            <ul>
                <li>Close to: Grand plaza, Trung Hoa Nhan Chinh, Keangnam Tower&hellip;</li>
                <li>Free High speed Wifi in all area of hotel</li>
                <li>Kitchen with cooking equipments&nbsp;</li>
                <li><strong>Convenience:</strong>&nbsp;TV Led 32&rdquo;, 2 ways air conditioner, Big
                    refrigerator, High speed Internet cable, KBS channel&hellip;</li>
                <li>Best service: Housekeeping and Laundry, Receptionist, Security 24/7</li>
                <li>Enthusiastic and friendly staffs</li>
                <li>Reasonable price and&nbsp; best price for long term.&nbsp;</li>
            </ul>

        </div>
    </div>
    <div class="c30 mobile-break"></div>
    <div class="c30 tab-break"></div>
    <div class="col-3-4 mobile-col-1-1 tab-col-1-1 chain-home-list" style="">
        <h1 class="title-first-home"><span><a href="chain/"> Chain</a></span></h1>

        <div class="c20"></div>
        <div style="position:relative">

            <div class="swiper-container chain-slide">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div><a href="chain/newland-1.html"><img
                                    src="temp/-uploaded-NL-N1_P1.-N1_cr_420x315.jpg" alt="Newland 1" width="100%"></a>
                        </div>
                        <div class="pro-home-name"><a href="chain/newland-1.html">Newland 1</a></div>
                        <div class="chain-info">
                            <div><a href="chain/newland-1.html"><i class="fa fa-map-marker"></i> No.52 Lane 171
                                    Nguyen Ngoc Vu street, Trung Hoa, Cau Giay, Hanoi</a></div>
                            <div><a href="chain/newland-1.html"><i class="fa fa-picture-o"></i> Photos</a>
                            </div>
                            <div><a href="chain/newland-1.html"><i class="fa fa-map"></i> Map</a></div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div><a href="chain/hotel-name-2.html"><img
                                    src="temp/-uploaded_20141015_153637 copy 1_cr_420x315.jpg" alt="Newland 6"
                                    width="100%"></a></div>
                        <div class="pro-home-name"><a href="chain/hotel-name-2.html">Newland 6</a></div>
                        <div class="chain-info">
                            <div><a href="chain/hotel-name-2.html"><i class="fa fa-map-marker"></i> No.64 Lane
                                    186 Tran Duy Hung street, Trung Hoa, Cau Giay, Hanoi</a></div>
                            <div><a href="chain/hotel-name-2.html"><i class="fa fa-picture-o"></i> Photos</a>
                            </div>
                            <div><a href="chain/hotel-name-2.html"><i class="fa fa-map"></i> Map</a></div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div><a href="chain/hotel-name-4.html"><img
                                    src="temp/-uploaded_n8-letan_cr_420x315.jpg" alt="Newland 8" width="100%"></a>
                        </div>
                        <div class="pro-home-name"><a href="chain/hotel-name-4.html">Newland 8</a></div>
                        <div class="chain-info">
                            <div><a href="chain/hotel-name-4.html"><i class="fa fa-map-marker"></i> No 47 Lane
                                    148 Tran Duy Hung street, Trung Hoa, Cau Giay, Hanoi</a></div>
                            <div><a href="chain/hotel-name-4.html"><i class="fa fa-picture-o"></i> Photos</a>
                            </div>
                            <div><a href="chain/hotel-name-4.html"><i class="fa fa-map"></i> Map</a></div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div><a href="chain/hotel-name-5.html"><img
                                    src="temp/-uploaded_Outlook 3_cr_420x315.JPG" alt="Newland 9" width="100%"></a>
                        </div>
                        <div class="pro-home-name"><a href="chain/hotel-name-5.html">Newland 9</a></div>
                        <div class="chain-info">
                            <div><a href="chain/hotel-name-5.html"><i class="fa fa-map-marker"></i> No.16 Lane
                                    61 Dong Me street, Me Tri Road, Trung Hoa, Cau Giay, Hanoi</a></div>
                            <div><a href="chain/hotel-name-5.html"><i class="fa fa-picture-o"></i> Photos</a>
                            </div>
                            <div><a href="chain/hotel-name-5.html"><i class="fa fa-map"></i> Map</a></div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="swiper-chain-next hide-on-tab hide-on-mobile hide-on-pad"><i class="fa fa-angle-right"
                                                                                     aria-hidden="true"></i>
            </div>
            <div class="swiper-chain-prev  hide-on-tab hide-on-mobile hide-on-pad"><i class="fa fa-angle-left"
                                                                                      aria-hidden="true"></i>
            </div>
        </div>
        <script>
            var xview = 3;
            if ($(document).width() <= 980) {
                xview = 2;

            }
            if ($(document).width() <= 768) {
                xview = 2;

            }

            if ($(document).width() <= 480) {
                xview = 1;

            }
            if ($(document).width() <= 320) {
                xview = 1;


            }
            var swiper = new Swiper('.chain-slide', {
                pagination: '',
                slidesPerView: xview,
                paginationClickable: true,
                spaceBetween: 30,
                autoplay: 3000,
                speed: 1000,
                simulateTouch: false,
                nextButton: '.swiper-chain-next',
                prevButton: '.swiper-chain-prev',
            });
        </script>
    </div>
    <div class="c30"></div>
</div>
<div class="bg-gray">
    <div class="grid grid-pad">
        <div class="c20"></div>

        <h2 class="title-cat-home" style="text-transform:uppercase">Newland hightlight</h2>

        <div class="c20 hide-on-mobile"></div>

        <div class="col-1-4 pad-col-1-3 tab-col-1-2 ">
            <div class="">
                <div class="image-apart">
                    <div class=""></div>
                    <a href="/all-rooms/superior-studio-apartment-116.html"><img
                            src="temp/-uploaded-NL-N9_IMG_3602_cr_420x315.jpg" alt="Superior Studio apartment"
                            width="100%"></a>
                </div>
                <h2 class="pro-name"><a href="/all-rooms/superior-studio-apartment-116.html">Superior Studio
                        apartment</a></h2>

                <div class="info-apart">Newland 9 - No.16 Lane 1 Dong Me street, Me Tri Road, Nam Tu Liem
                    <div class="c10"></div>
                </div>
                <div class="c10"></div>
                <div class="price-book">
            	<span class="col-2-3">
                	<div class="price"><span>500 $</span>/Month</div>
                    <div class="price"><span>27 USD $</span>/Day</div>
                </span>

                    <div class="c10 mobile-break"></div>
                    <span class="col-1-3" style="padding:0px;">
                	<a href="/booking/?idroom=116" class="quick-book">Book <i class="fa fa-chevron-right"
                                                                              aria-hidden="true"></i></a>
                </span>

                    <div class="c"></div>
                </div>
            </div>
            <div class="c20 mobile-break"></div>
        </div>
        <div class="col-1-4 pad-col-1-3 tab-col-1-2 ">
            <div class="">
                <div class="image-apart">
                    <div class=""></div>
                    <a href="/all-rooms/studio-apartment-1-113.html"><img
                            src="temp/-uploaded_8-011_cr_420x315.jpg" alt="Studio apartment 1"
                            width="100%"></a>
                </div>
                <h2 class="pro-name"><a href="/all-rooms/studio-apartment-1-113.html">Studio apartment 1</a>
                </h2>

                <div class="info-apart">Newland 8- No.47 Lane 148 Tran Duy Hung street, Hanoi
                    <div class="c10"></div>
                </div>
                <div class="c10"></div>
                <div class="price-book">
            	<span class="col-2-3">
                	<div class="price"><span>300 USD $</span>/Month</div>
                    <div class="price"><span>17 USD $</span>/Day</div>
                </span>

                    <div class="c10 mobile-break"></div>
                    <span class="col-1-3" style="padding:0px;">
                	<a href="/booking/?idroom=113" class="quick-book">Book <i class="fa fa-chevron-right"
                                                                              aria-hidden="true"></i></a>
                </span>

                    <div class="c"></div>
                </div>
            </div>
            <div class="c20 mobile-break"></div>
            <div class="c20 tab-break"></div>
        </div>
        <div class="col-1-4 pad-col-1-3 tab-col-1-2 ">
            <div class="">
                <div class="image-apart">
                    <div class=""></div>
                    <a href="/all-rooms/studio-apartment-3-110.html"><img
                            src="temp/-uploaded_20141015_153637_cr_420x315.jpg" alt="Studio apartment 3"
                            width="100%"></a>
                </div>
                <h2 class="pro-name"><a href="/all-rooms/studio-apartment-3-110.html">Studio apartment 3</a>
                </h2>

                <div class="info-apart">Newland 6 - No.64 Lane 186 Trần Duy Hưng street.&nbsp;
                    <div class="c10"></div>
                </div>
                <div class="c10"></div>
                <div class="price-book">
            	<span class="col-2-3">
                	<div class="price"><span>380 USD $</span>/Month</div>
                    <div class="price"><span>21 USD $</span>/Day</div>
                </span>

                    <div class="c10 mobile-break"></div>
                    <span class="col-1-3" style="padding:0px;">
                	<a href="/booking/?idroom=110" class="quick-book">Book <i class="fa fa-chevron-right"
                                                                              aria-hidden="true"></i></a>
                </span>

                    <div class="c"></div>
                </div>
            </div>
            <div class="c20 mobile-break"></div>
            <div class="c20 pad-break"></div>
        </div>
        <div class="c30"></div>
    </div>
    <div class="c5"></div>
    <div style="background:#FFF">
        <div class="grid">
            <div class="c30"></div>
            <div class="col-1-1">
                <h2 class="title-cat-home" style="text-transform:uppercase"><a href="/feedback/">Feedback</a>
                </h2>

                <div class="c20 hide-on-mobile"></div>
            </div>
            <div class="c30"></div>

            <div style="position:relative">
                <a href="#" class="swiper-chain-prev hide-on-mobile hide-on-tab"><i class="fa fa-angle-left"
                                                                                    aria-hidden="true"></i></a>
                <a href="#" class="swiper-chain-next hide-on-mobile hide-on-tab"><i class="fa fa-angle-right"
                                                                                    aria-hidden="true"></i></a>

                <div style="padding:0px 10px">
                    <div class="swiper-container article-slide">

                        <div class="swiper-wrapper">

                            <div class="swiper-slide">
                                <div class=""><a href="/feedback/test-2.html"><img
                                            src="temp/-uploaded_Mr.Paul Harding_cr_160x160.jpg" alt="Test 2"
                                            class="image-article"/></a></div>
                                <h3 class="item-name" style="padding-bottom:5px"><a
                                        href="/feedback/test-2.html">Mr.Paul Harding</a></h3>

                                <div style="font-weight:bold ;padding-bottom:5px">United State</div>
                                <div><span style="font-size:12px;"><em><span
                                                style="color: rgb(78, 78, 78); font-family: mallory, 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 21px;">I booked my room for three days but was so pleased with the friendly and accommodating staff, especially the manager, that I booked an additional three weeks. The hotel is situated in a narrow alley with an incredible mix of shops, restaurants, and residences. It&#39;s not at all touristy so one feels they are experiencing the real Hanoi with all of it&#39;s energy and humanity. This is where I&#39;ll stay next time and it&#39;s the place I&#39;ll recommend to friends. I feel very safe here.&nbsp;</span></em></span>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class=""><a href="/feedback/test.html"><img
                                            src="temp/-uploaded_view_cr_160x160.jpg" alt="Feedback1"
                                            class="image-article"/></a></div>
                                <h3 class="item-name" style="padding-bottom:5px"><a href="/feedback/test.html">Kim
                                        J.</a></h3>

                                <div style="font-weight:bold ;padding-bottom:5px">South Korea</div>
                                <div><span style="font-size:12px;"><em><span
                                                style="color: rgb(78, 78, 78); font-family: mallory, 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 21px;">There was everything(including kitchen wares) for living inside the room. You can cook inside the room. And very cheap and clean.</span></em></span>
                                </div>
                            </div>
                        </div>
                        <script>

                            var pview = 2;
                            if ($(document).width() <= 980) {
                                pview = 2;

                            }
                            if ($(document).width() <= 768) {
                                pview = 1;

                            }

                            if ($(document).width() <= 480) {
                                pview = 1;

                            }
                            if ($(document).width() <= 320) {
                                pview = 1;


                            }

                            var swiper = new Swiper('.article-slide', {
                                pagination: '',
                                slidesPerView: pview,
                                paginationClickable: true,
                                spaceBetween: 30,
                                autoplay: 3000,
                                speed: 1000,
                                simulateTouch: false,
                                nextButton: '.swiper-chain-next',
                                prevButton: '.swiper-chain-prev',
                            });
                        </script>
                        <div class="c30"></div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>