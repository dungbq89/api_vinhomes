<?php
/**
 * Created by PhpStorm.
 * User: conghuyvn8x
 * Date: 6/27/2018
 * Time: 9:32 PM
 */
?>
<div id="header">
    <div>
        <div role="listbox" aria-expanded="false" class="ui simple dropdown" tabindex="0">
            <div class="text" role="alert" aria-live="polite"></div>
            <a class="offcanvas-toggle cats-toggle"></a>


        </div>
        <header class="navbar navbar-sticky header-static">
            <div id="search-header" class="site-search">
                <div class="dropdown-location">
                    <div role="combobox" aria-expanded="false" class="ui search selection dropdown"><input
                            aria-autocomplete="list" autocomplete="off" class="search" tabindex="0" type="text"
                            value="">

                        <div class="default text" role="alert" aria-live="polite">Quận</div>
                        <i aria-hidden="true" class="dropdown icon"></i>

                        <div role="listbox" class="menu transition">
                            <div role="option" aria-checked="false" aria-selected="true" class="selected item"
                                 style="pointer-events: all;"><span class="text">Ba Đình</span></div>
                            <div role="option" aria-checked="false" aria-selected="false" class="item"
                                 style="pointer-events: all;"><span class="text">Bắc Từ Liêm</span></div>
                            <div role="option" aria-checked="false" aria-selected="false" class="item"
                                 style="pointer-events: all;"><span class="text">Cầu Giấy</span></div>
                            <div role="option" aria-checked="false" aria-selected="false" class="item"
                                 style="pointer-events: all;"><span class="text">Hai Bà Trưng</span></div>
                            <div role="option" aria-checked="false" aria-selected="false" class="item"
                                 style="pointer-events: all;"><span class="text">Hà Đông</span></div>
                            <div role="option" aria-checked="false" aria-selected="false" class="item"
                                 style="pointer-events: all;"><span class="text">Hoàn Kiếm</span></div>
                            <div role="option" aria-checked="false" aria-selected="false" class="item"
                                 style="pointer-events: all;"><span class="text">Hoàng Mai</span></div>
                            <div role="option" aria-checked="false" aria-selected="false" class="item"
                                 style="pointer-events: all;"><span class="text">Long Biên</span></div>
                            <div role="option" aria-checked="false" aria-selected="false" class="item"
                                 style="pointer-events: all;"><span class="text">Nam Từ Liêm</span></div>
                            <div role="option" aria-checked="false" aria-selected="false" class="item"
                                 style="pointer-events: all;"><span class="text">Tây Hồ</span></div>
                            <div role="option" aria-checked="false" aria-selected="false" class="item"
                                 style="pointer-events: all;"><span class="text">Đống Đa</span></div>
                        </div>
                    </div>
                </div>
                <div><span class="pick-location"><i aria-hidden="true" class="location arrow large icon"></i></span>
                </div>
                <input type="text" name="keyword" placeholder="Tìm theo tên cửa hàng, sản phẩm, địa chỉ,...">

                <div class="search-tools"><span class="clear-search">Xoá</span><span class="close-search"><i
                            aria-hidden="true" class="remove icon"></i></span></div>
            </div>
            <div class="site-branding" style="display: inline-table;"><a class="site-logo" href="<?php echo url_for('@homepage') ?>"
                                                                         style="padding-left: 30px; padding-top: 10px;"><img
                        src="/images/logo.png" style="width: 60px; height: 40px;" alt="Trang chủ"></a></div>
            <nav class="site-menu">
                <ul>
                    <li id="home-h" class=""><a href="<?php echo url_for('@homepage') ?>"><span>Trang Chủ</span></a></li>
                </ul>
            </nav>
            <div class="toolbar">
                <div class="inner">

                </div>
            </div>
            <div></div>
        </header>
    </div>
</div>
