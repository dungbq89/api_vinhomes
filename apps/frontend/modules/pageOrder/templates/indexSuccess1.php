<style>
    .content_danhmuc {
        display: none;
    }
    .btn-submit{
        font-weight: bold;
        text-transform: uppercase;
        font-size: 12px;
        padding: 4px 6px;
        background: #ef4d87;
        color: #fff;
        border-radius: 2px;
        border: 1px solid #ef4d87;
    }
    .btn-submit:hover{
        background: #fff;
        color: #ef4d87;
    }
    #img_captcha{
        width: 120px;
        height: 30px;
    }
    .error_list{
        color: #ff0000;
    }
</style>
<script type="text/javascript">
    jQuery('.danhmuc_sp').hover(function () {
        jQuery('.content_danhmuc').css('display', 'block');
    }, function () {
        jQuery('.content_danhmuc').css('display', 'none');
    });
</script>
<div id="wpo-main-content" class="container  clearfix page-template-page-template-thanhtoan">

    <?php include_component('common', 'breadcumb', array('list' => array('Trang chủ' => '/', 'Thông tin đơn hàng' => '#'))) ?>
    <div class="row">
        <div class="col-xs-12 main-content" id="main-content">
            <section class="title-section">
                <h1 class="title-header">
                    Thông tin đơn hàng</h1>
            </section>
            <!-- .title-section -->
            <div class="row clearfix">
                <div class="col-xs-12">
                    <form method="post" name="cart_form" id="fpro" style="margin-top:10px">
                        <table class="rows table table-striped table-bordered">
                            <thead>
                            <tr style="font-weight:bold;">
                                <td class="stt" align="center">STT</td>
                                <td class="image" align="center">Ảnh</td>
                                <td class="prd">Sản phẩm</td>
                                <td class="price" align="right">Giá (đ)</td>
                                <td class="amount" align="center">SL</td>
                                <td class="unit">Đơn vị</td>
                                <td class="thanhtien" align="center">Thành tiền</td>
                            </tr>
                            </thead>
                            <?php if (isset($product)) {
                                $path = '/uploads/' . sfConfig::get('app_product_images') . $product->image_path;
                                ?>
                                <tbody>
                                <tr id="220" class="item">
                                    <td align="center">1</td>
                                    <td align="center">
                                        <a href="<?php echo url_for2('product_detail', array('slug' => $product->getSlug())) ?>"
                                           data-images="<?php echo VtHelper::getThumbUrl($path, 300, 300, 'default') ?>"
                                           product-id="<?php echo $product->id ?>">
                                            <img
                                                src="<?php echo VtHelper::getThumbUrl($path, 70, 70, 'default') ?>"
                                                class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image"
                                                alt="" width="70" height="70"> </a>

                                    </td>
                                    <td class="prd">
                                        <a title="<?php echo htmlspecialchars($product->getProductName()); ?>"
                                           href="<?php echo url_for2('product_detail', array('slug' => $product->getSlug())) ?>"><?php echo htmlspecialchars($product->getProductName()); ?></a>
                                    </td>
                                    <td class="money" align="right">
                                        <strong>
                                            <?php
                                            if ($product->getPricePromotion()) {
                                                echo number_format($product->getPricePromotion(), 0, ",", ".") . ' đ';
                                            } else {
                                                echo number_format($product->getPrice(), 0, ",", ".") . ' đ';
                                            }
                                            ?>
                                        </strong>
                                    </td>
                                    <td class="amount" align="center">
                                        <div class="wrap-input" style="float: none; margin: 0px;">
                                            <span>1</span>
                                        </div>
                                    </td>
                                    <td class="unit">Chiếc</td>
                                    <td class="thanhtien" align="center">
                                        <?php
                                        if ($product->getPricePromotion()) {
                                            echo number_format($product->getPricePromotion(), 0, ",", ".") . ' đ';
                                        } else {
                                            echo number_format($product->getPrice(), 0, ",", ".") . ' đ';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                </tbody>
                            <?php } ?>

                        </table>

                        <div style="margin-top: 10px; padding-top: 5px; ">
                            <div class="clearfix" style="margin-top:5px;">
                                <div class="fl">
                                    <input class="bton-detail" style="" type="button" title="Quay lại trang chủ"
                                           value="Quay lại trang chủ" onclick="window.location.href='/'">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>


                <div class="col-xs-12 col-sm-7">
                    <div class="title_dh">Xin điền đầy đủ thông tin vào các mục đánh dấu (*).</div>
                    <form action="" method="post" name="fpost" id="fpost">
                        <?php echo $form->renderHiddenFields() ?>
                        <table class="rows table" style="margin-bottom: 2px">
                            <tbody>
                            <tr>
                                <td>Họ tên người mua (*)</td>
                                <td style="width: 70%">
                                    <?php echo $form['customer_name']->render(array('id' => 'order_name', 'style'=>'width: 40%', 'class'=>'field__input form-control'));
                                    if ($form['customer_name']->hasError()) {
                                        echo '<span class="help-inline">' . $form['customer_name']->renderError() . '</span>';
                                    } ?>
                            </tr>
                            <tr>
                                <td>Điện thoại (*)</td>
                                <td style="width: 70%">
                                    <?php echo $form['customer_phone']->render(array('id' => 'order_phone', 'style'=>'width: 40%'));
                                    if ($form['customer_phone']->hasError()) {
                                        echo '<span class="help-inline">' . $form['customer_phone']->renderError() . '</span>';
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">Địa chỉ nhận hàng (*)</td>
                                <td valign="top" style="width: 70%">
                                    <?php echo $form['customer_address']->render(array('id' => 'order_address'));
                                    if ($form['customer_address']->hasError()) {
                                        echo '<span class="help-inline">' . $form['customer_address']->renderError() . '</span>';
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">Nội dung</td>
                                <td valign="top" style="width: 70%">
                                    <?php echo $form['body']->render(array('id' => 'order_note', 'style'=>'width: 98%; height: 50px;'));
                                    if ($form['body']->hasError()) {
                                        echo '<span class="help-inline">' . $form['body']->renderError() . '</span>';
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">Mã bảo mật (*)</td>
                                <td valign="top">
                                    <?php echo $form['captcha']->render(array('style' => 'width:120px !important;'));
                                    if ($form['captcha']->hasError()) {
                                        echo '<span class="help-inline">' . $form['captcha']->renderError() . '</span>';
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td style="color: #008000;">
                                    <button name="" type="submit" class="bton-detail btn-submit" style="">Đặt hàng</button>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td style="color: #008000;">
                                    <?php if ($sf_user->hasFlash('success')): ?>
                                        <span><?php echo __($sf_user->getFlash('success'), null, 'tmcTwitterBootstrapPlugin') ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>


                <div class="col-xs-12 col-sm-5">
                    <div class="title_dh">Hướng dẫn đặt hàng</div>
                    <div class="content_hd"><p><strong>Cách 1:</strong>&nbsp;Gọi điện thoại đến tổng đài:</p>

                        <p><strong><span style="color: #ef4d87;">&nbsp;+ &nbsp;HÀ NỘI:</span></strong></p>

                        <p>&nbsp; &nbsp; &nbsp; Điện thoại:0903.221.226</p>

                        <p><strong><span style="color: #ef4d87;">&nbsp;+ &nbsp;HẢI PHÒNG:</span></strong>&nbsp;</p>

                        <p>&nbsp; &nbsp; &nbsp; Điện thoại: 0934.686.078</p>

                        <p><strong><span style="color: #ef4d87;">&nbsp;+ &nbsp;ĐỒNG NAI 1:</span></strong>&nbsp;</p>

                        <p>&nbsp; &nbsp; &nbsp; Điện thoại:&nbsp; 0944.221.226</p>

                        <p><strong><span style="color: #ef4d87;">&nbsp;+ &nbsp;ĐỒNG NAI 2 :</span></strong>&nbsp;</p>

                        <p>&nbsp; &nbsp; &nbsp;Điện thoại:: 0914.08.03.08</p>

                        <p><strong><span style="color: #ef4d87;">&nbsp;+ &nbsp;TP HỒ CHÍ MINH 1:</span></strong>&nbsp;
                        </p>

                        <p>&nbsp; &nbsp; &nbsp; Điện thoại: 0906.221.226</p>

                        <p><strong><span style="color: #ef4d87;">&nbsp;+ &nbsp;TP HỒ CHÍ MINH 2:</span></strong>&nbsp;
                        </p>

                        <p>&nbsp; &nbsp; &nbsp;&nbsp;Điện thoại: 0981.221.226</p>

                        <p><strong>Cách 2:</strong>&nbsp;Đặt mua hàng trên website.</p>

                        <p>Bạn có thể tìm kiếm sản phẩm yêu thích và cho vào giỏ hàng.</p>

                        <p>Cám ơn Quý khách đã quan tâm và chọn mua sản phẩm tại Tunhua.vn</p></div>
                </div>


            </div>
        </div>

    </div>

</div>












