<header id="masthead" class="site-header header-logo-style2" role="banner" itemscope="itemscope"
        itemtype="http://schema.org/WPHeader">

    <!-- Start Top Header -->
    <!-- End Top Header -->

    <div class="header-main">
        <div class="container">
            <div class="site-branding">
                <h1 class="site-title"><a href="<?php echo url_for('homepage'); ?>" rel="home">Bất Động Sản Vingroup</a></h1>
                <p class="site-description">Dự án bất động sản cao cấp tại Việt Nam</p>
            </div><!-- .site-branding -->

            <div class="header-content">
                <a id="showmenu" class="d-lg-none">
				<span class="hamburger hamburger--collapse">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</span>
                </a>
                <div class="row align-items-center">
                    <div class="col-lg-3">
                        <div class="logo">
                            <a href="<?php echo url_for('homepage'); ?>"><img src="/wp-content/uploads/2018/11/photo.png"></a>
                            <div class="phone_mobile">0978.346.223</div>
                            <div class="email_mobile">vincity@gmail.com</div>
                        </div>
                    </div>
                    <div class="col-lg-6  d-none d-lg-block">
                        <div class="header-content__infor">
                            <div class="header-content__infor__el header-content__infor__email">
                                <div class="float-left mr-3">
                                    <img src="/wp-content/themes/vinhomevn/lib/images/icon-top-email.png">
                                </div>
                                <p>EMAIL LIÊN HỆ</p>
                                <p>
                                    <a href="mailto:bdsvinpearlvinhomes.com@gmail.com">vincity@gmail.com</a>
                                </p>
                            </div>
                            <div class="header-content__infor__el header-content__infor__phone">
                                <div class="float-left mr-3">
                                    <img src="/wp-content/themes/vinhomevn/lib/images/icon-top-phone.png">
                                </div>
                                <p>HOTLINE TƯ VẤN</p>
                                <p>
                                    <strong>
                                        <a href="tel:0945.030.068">0978.346.223</a> </strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3  d-none d-lg-block">
                        <form role="search" method="get" class="search-form"
                              action="https://bdsvinhomesvinpearl.com/">
                            <label>
                                <span class="screen-reader-text">Tìm kiếm cho:</span>
                                <input type="search" class="search-field" placeholder="Tìm kiếm &hellip;" value=""
                                       name="s"/>
                            </label>
                            <input type="submit" class="search-submit" value="Tìm kiếm"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav id="site-navigation" class="main-navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-10">
                    <div class="menu-top-menu-tren-container">
                        <ul id="primary-menu" class="menu clearfix">
                            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-25">
                                <a href="<?php echo url_for('homepage'); ?>">Trang chủ</a></li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-project menu-item-548"><a
                                        href="<?php echo url_for('detail_project',array('slug'=>'vincity-sportia')); ?>">VINCITY SPORTIA</a></li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-project menu-item-652"><a
                                        href="<?php echo url_for('detail_project',array('slug'=>'vincity-ocean-park')); ?>">VINCITY OCEAN PARK</a></li>
                            <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-29"><a
                                        href="#">Tin tức</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 social text-md-right">

                </div>
            </div>
        </div>
    </nav>


</header><!-- #masthead -->