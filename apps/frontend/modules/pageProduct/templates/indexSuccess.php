<section class="breadc">

    <div class="container breadpos">

        <div class="pull-left">
            <ol class="breadcrumb breadcrumbs" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                <li class="home">
                    <a itemprop="url" href="/"><span itemprop="title">Trang chủ</span></a>
                    <span><i class="fa fa-angle-right"></i></span>
                </li>

                <li><strong itemprop="title"><?php echo isset($catName) ? $catName : "" ?></strong></li>

            </ol>
        </div>
    </div>

</section>

<section class="grid-collection p20">
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <header class="section-title fix-margin-col-xs">

                <h1><?php echo isset($catName) ? $catName : "" ?></h1>

                <p></p>
            </header>

        </div>
        <div class="row">

            <div class="toolbar clearfix">
                <div class="pull-left col-lg-6 col-md-4 col-xs-6 col-sm-6">
                    <div class="view-mode">
                        <a class="filter-icon" title="filter"><i class="fa fa-flask"></i></a>

                    </div>
                    <span class="fix-xs-filter">Bộ lọc sản phẩm</span>
                </div>
            </div>
            <div class="filter-container">
                <div class="filter-container__selected-filter" style="display: none;">
                    <div class="filter-container__selected-filter-header clearfix">
                        <span class="filter-container__selected-filter-header-title"><i
                                    class="fa fa-arrow-left hidden-sm-up"></i> Bạn chọn</span>
                        <a href="javascript:void(0)" onclick="clearAllFiltered()" class="filter-container__clear-all">Bỏ
                            hết <i class="fa fa-angle-right"></i></a>
                    </div>
                    <div class="filter-container__selected-filter-list">
                        <ul></ul>
                    </div>
                </div>
                <div class="fix-border-filter">
                    <div class="row2 clearfix">

                        <div class="col-md-3">
                            <div class="filter-group">
                                <div class="filter-group-title filter-group-title--green">
                                    Giá

                                </div>
                                <ul>
                                    <li class="filter-item filter-item--check-box filter-item--green">
                                        <a href="javascript:void(0)">
                                            <label for="filter-duoi-500-000d">
                                                <input type="checkbox" id="filter-duoi-500-000d"
                                                       onchange="toggleFilter(this)" data-group="Khoảng giá"
                                                       data-field="price_min" data-text="Dưới 500.000đ"
                                                       value="(<500000)" data-operator="OR">
                                                <i class="fa"></i>
                                                Dưới 500.000vnđ
                                            </label>
                                        </a>
                                    </li>

                                    <li class="filter-item filter-item--check-box filter-item--green">
                                        <a href="javascript:void(0)">
                                            <label for="filter-500-000d-1-000-000d">
                                                <input type="checkbox" id="filter-500-000d-1-000-000d"
                                                       onchange="toggleFilter(this)" data-group="Khoảng giá"
                                                       data-field="price_min" data-text="500.000đ - 1.000.000đ"
                                                       value="(>500000 AND <1000000)" data-operator="OR">
                                                <i class="fa"></i>
                                                Từ 500.000 - 1.000.000vnđ
                                            </label>
                                        </a>
                                    </li>
                                    <li class="filter-item filter-item--check-box filter-item--green">
                                        <a href="javascript:void(0)">
                                            <label for="filter-1-000-000d-5-000-000d">
                                                <input type="checkbox" id="filter-1-000-000d-5-000-000d"
                                                       onchange="toggleFilter(this)" data-group="Khoảng giá"
                                                       data-field="price_min" data-text="1.000.000đ - 5.000.000đ"
                                                       value="(>1000000 AND <5000000)" data-operator="OR">
                                                <i class="fa"></i>
                                                Từ 1.000.000 - 5.000.000vnđ
                                            </label>
                                        </a>
                                    </li>

                                    <li class="filter-item filter-item--check-box filter-item--green">
                                        <a href="javascript:void(0)">
                                            <label for="filter-5-000-000d-10-000-000d">
                                                <input type="checkbox" id="filter-5-000-000d-10-000-000d"
                                                       onchange="toggleFilter(this)" data-group="Khoảng giá"
                                                       data-field="price_min" data-text="5.000.000đ - 10.000.000đ"
                                                       value="(>5000000 AND <10000000)" data-operator="OR">
                                                <i class="fa"></i>
                                                Từ 5.000.000 - 10.000.000vnđ
                                            </label>
                                        </a>
                                    </li>
                                    <li class="filter-item filter-item--check-box filter-item--green">
                                        <a href="javascript:void(0)">
                                            <label for="filter-tren-10-000-000d">
                                                <input type="checkbox" id="filter-tren-10-000-000d"
                                                       onchange="toggleFilter(this)" data-group="Khoảng giá"
                                                       data-field="price_min" data-text="Trên 10.000.000đ"
                                                       value="(>10000000)" data-operator="OR">
                                                <i class="fa"></i>
                                                Trên 10.000.000vnđ
                                            </label>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>


                        <div class="col-md-3">

                            <div class="filter-group">
                                <div class="filter-group-title filter-group-title--green">
                                    Thương hiệu

                                </div>


                                <ul>


                                    <li class="filter-item filter-item--check-box filter-item--green ">
                                        <a href="javascript:void(0)">
                                            <label for="filter-awesome">
                                                <input type="checkbox" id="filter-awesome" onchange="toggleFilter(this)"
                                                       data-group="Hãng" data-field="vendor" data-text="Awesome"
                                                       value="(Awesome)" data-operator="OR">
                                                <i class="fa"></i>
                                                Awesome
                                            </label>
                                        </a>
                                    </li>


                                    <li class="filter-item filter-item--check-box filter-item--green ">
                                        <a href="javascript:void(0)">
                                            <label for="filter-bizweb">
                                                <input type="checkbox" id="filter-bizweb" onchange="toggleFilter(this)"
                                                       data-group="Hãng" data-field="vendor" data-text="Bizweb"
                                                       value="(Bizweb)" data-operator="OR">
                                                <i class="fa"></i>
                                                Bizweb
                                            </label>
                                        </a>
                                    </li>


                                    <li class="filter-item filter-item--check-box filter-item--green ">
                                        <a href="javascript:void(0)">
                                            <label for="filter-dqdt">
                                                <input type="checkbox" id="filter-dqdt" onchange="toggleFilter(this)"
                                                       data-group="Hãng" data-field="vendor" data-text="DQDT"
                                                       value="(DQDT)" data-operator="OR">
                                                <i class="fa"></i>
                                                DQDT
                                            </label>
                                        </a>
                                    </li>


                                    <li class="filter-item filter-item--check-box filter-item--green ">
                                        <a href="javascript:void(0)">
                                            <label for="filter-hoa-phat">
                                                <input type="checkbox" id="filter-hoa-phat"
                                                       onchange="toggleFilter(this)" data-group="Hãng"
                                                       data-field="vendor" data-text="Hòa Phát" value="(Hòa Phát)"
                                                       data-operator="OR">
                                                <i class="fa"></i>
                                                Hòa Phát
                                            </label>
                                        </a>
                                    </li>


                                </ul>


                            </div>

                        </div>


                        <div class="col-md-3">

                            <div class="filter-group">
                                <div class="filter-group-title filter-group-title--green">
                                    Loại

                                </div>
                                <ul>


                                    <li class="filter-item filter-item--check-box filter-item--green">
                                        <a href="javascript:void(0)">
                                            <label for="filter-sofa">
                                                <input type="checkbox" id="filter-sofa" onchange="toggleFilter(this)"
                                                       data-group="Loại" data-field="product_type" data-text="Sofa"
                                                       value="(Sofa)" data-operator="OR">
                                                <i class="fa"></i>
                                                Sofa
                                            </label>
                                        </a>
                                    </li>


                                    <li class="filter-item filter-item--check-box filter-item--green">
                                        <a href="javascript:void(0)">
                                            <label for="filter-ban-ghe">
                                                <input type="checkbox" id="filter-ban-ghe" onchange="toggleFilter(this)"
                                                       data-group="Loại" data-field="product_type" data-text="Bàn ghế"
                                                       value="(Bàn ghế)" data-operator="OR">
                                                <i class="fa"></i>
                                                Bàn ghế
                                            </label>
                                        </a>
                                    </li>


                                    <li class="filter-item filter-item--check-box filter-item--green">
                                        <a href="javascript:void(0)">
                                            <label for="filter-giuong">
                                                <input type="checkbox" id="filter-giuong" onchange="toggleFilter(this)"
                                                       data-group="Loại" data-field="product_type" data-text="Giường"
                                                       value="(Giường)" data-operator="OR">
                                                <i class="fa"></i>
                                                Giường
                                            </label>
                                        </a>
                                    </li>


                                </ul>
                            </div>

                        </div>


                        <div class="col-md-3">

                            <div class="filter-group">
                                <div class="filter-group-title filter-group-title--green">
                                    Kích thước

                                </div>
                                <ul>


                                    <li class="filter-item filter-item--check-box filter-item--green">
                                        <a href="javascript:void(0)">
                                            <label for="filter-lon">
                                                <input type="checkbox" id="filter-lon" onchange="toggleFilter(this)"
                                                       data-group="tag2" data-field="tags" data-text="Lớn" value="(Lớn)"
                                                       data-operator="OR">
                                                <i class="fa"></i>
                                                Lớn
                                            </label>
                                        </a>
                                    </li>


                                    <li class="filter-item filter-item--check-box filter-item--green">
                                        <a href="javascript:void(0)">
                                            <label for="filter-nho">
                                                <input type="checkbox" id="filter-nho" onchange="toggleFilter(this)"
                                                       data-group="tag2" data-field="tags" data-text="Nhỏ" value="(Nhỏ)"
                                                       data-operator="OR">
                                                <i class="fa"></i>
                                                Nhỏ
                                            </label>
                                        </a>
                                    </li>


                                    <li class="filter-item filter-item--check-box filter-item--green">
                                        <a href="javascript:void(0)">
                                            <label for="filter-vua">
                                                <input type="checkbox" id="filter-vua" onchange="toggleFilter(this)"
                                                       data-group="tag2" data-field="tags" data-text="Vừa" value="(Vừa)"
                                                       data-operator="OR">
                                                <i class="fa"></i>
                                                Vừa
                                            </label>
                                        </a>
                                    </li>


                                </ul>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <div class="category-products">

                <div class="col-md-12">

                    <?php
                    if ($listProduct && count($listProduct)) {
                        foreach ($listProduct as $product) {
                            $image = '/uploads/' . sfConfig::get('app_product_images') . $product->getImagePath();
                            $percent = 0;
                            if ($product->price_promotion && $product->price_promotion != 0) {
                                if ($product->price && $product->price != 0) {
                                    $subPer = intval($product->price) - intval($product->price_promotion);
                                    $percent = round(($subPer / $product->price) * 100);
                                }
                            }
                            ?>
                            <div class="col-md-3 col-sm-6 col-xs-12 grid-item-col">
                                <?php include_component('moduleProduct', 'productItem', array('product' => $product)); ?>
                            </div>
                            <?php
                        }
                        echo '<div class="row">';
                    }
                    ?>
                </div>
                <?php

                ?>


                <nav class="clearfix">
                    <?php
                    if ($pager->haveToPaginate()) {
                        include_component("common", "pagging", array('redirectUrl' => $url_paging, 'pager' => $pager, 'vtParams' => array('slug' => sfContext::getInstance()->getRequest()->getParameter('slug'))));
                    }
                    ?>

                </nav>

            </div>

        </div>
    </div>
    </div>
</section>
<script>


    $('#sort-by .ul_col li span').click(function (e) {

        var $this = $('.content_ul');

        $this.css('display', 'block');
        e.preventDefault();

    });
    $('#sort-by .ul_col .content_ul li').click(function (e) {


        $(".content_ul").css('display', 'none');
        e.preventDefault();

    });


</script>