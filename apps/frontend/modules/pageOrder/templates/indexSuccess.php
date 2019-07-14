<style>
    .with-errors li {
        color: #bf0000;
    }

    .field__input {
        padding-top: 0px !important;
        padding-bottom: 0px !important;
    }

    .main .field__input {
        padding-top: 10px !important;
    }
</style>

<div class="banner" data-header="">
    <div class="wrap">
        <div class="shop logo logo--left ">

            <h1 class="shop__name">
                <a class="" href="<?php echo url_for('@homepage'); ?>">
                    <img alt="" style="margin: 10px 0px 20px 20px;"
                         src="/images/logo.png">
                </a>
            </h1>

        </div>
    </div>
</div>

</div>
<form method="post" action="" data-toggle="validator" class="content stateful-form formCheckout">
    <div class="wrap" context="checkout">
        <?php echo $form->renderHiddenFields() ?>
        <div class="main" role="main" style="width: 80%;">
            <div class="main_header">
                <div class="shop logo logo--left ">

                    <h1 class="shop__name">
                        <a class="" href="<?php echo url_for('@homepage'); ?>">
                            <img alt="" style="margin: 10px 0px 20px 20px;"
                                 src="/images/logo.png">
                        </a>
                    </h1>

                </div>
            </div>
            <div class="main_content">
                <div class="">
                    <div class="col-md-6 col-lg-6">
                        <div class="section">
                            <div class="section__header">
                                <div class="layout-flex layout-flex--wrap">
                                    <h2 class="section__title layout-flex__item layout-flex__item--stretch">
                                        <i class="fa fa-id-card-o fa-lg section__title--icon hidden-md hidden-lg"
                                           aria-hidden="true"></i>
                                        <label class="control-label">Thông tin mua hàng</label>
                                    </h2>

                                </div>
                            </div>
                            <div class="section__content">
                                <div class="billing">
                                    <div class="form-group">
                                        <div class="field__input-wrapper">
                                            <?php echo $form['customer_name']->render(array('id' => 'customer_name', 'class' => 'field__input form-control', 'placeholder' => 'Họ và tên')); ?>
                                        </div>
                                        <div class="help-block with-errors">
                                            <?php
                                            if ($form['customer_name']->hasError()) {
                                                echo '<span class="help-inline">' . $form['customer_name']->renderError() . '</span>';
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="field__input-wrapper">
                                            <?php echo $form['customer_phone']->render(array('id' => 'customer_phone', 'class' => 'field__input form-control', 'placeholder' => 'Số điện thoại')); ?>
                                        </div>
                                        <div class="help-block with-errors">
                                            <?php
                                            if ($form['customer_phone']->hasError()) {
                                                echo '<span class="help-inline">' . $form['customer_phone']->renderError() . '</span>';
                                            } ?>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="field__input-wrapper">
                                            <?php echo $form['customer_address']->render(array('id' => 'customer_address', 'class' => 'field__input form-control', 'placeholder' => 'Địa chỉ')); ?>
                                        </div>
                                        <div class="help-block with-errors">
                                            <?php
                                            if ($form['customer_address']->hasError()) {
                                                echo '<span class="help-inline">' . $form['customer_address']->renderError() . '</span>';
                                            } ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="field__input-wrapper">
                                            <?php echo $form['body']->render(array('id' => 'body', 'class' => 'field__input form-control', 'placeholder' => 'Nội dung')); ?>
                                        </div>
                                        <div class="help-block with-errors">
                                            <?php
                                            if ($form['body']->hasError()) {
                                                echo '<span class="help-inline">' . $form['body']->renderError() . '</span>';
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-6 col-lg-6">
                    <div class="section shipping-method">
                        <div class="section__header">
                            <h2 class="section__title">
                                <i class="fa fa-truck fa-lg section__title--icon hidden-md hidden-lg"
                                   aria-hidden="true"></i>
                                <label class="control-label">Thông tin đơn hàng</label>
                            </h2>
                        </div>
                        <div class="section__content">
                            <div class="content-box">
                                <div class="sidebar__content">
                                    <div class="order-summary order-summary--product-list order-summary--is-collapsed">
                                        <div class="summary-body summary-section summary-product">
                                            <div class="summary-product-list">
                                                <table class="product-table">
                                                    <tbody>
                                                    <tr class="product product-has-image clearfix">
                                                        <td>
                                                            <div class="product-thumbnail">
                                                                <div class="product-thumbnail__wrapper">
                                                                    <?php $image = '/uploads/' . sfConfig::get('app_product_images') . $product->getImagePath(); ?>
                                                                    <img src="<?php echo VtHelper::getThumbUrl($image, 50, 50, 'default'); ?>"
                                                                         class="product-thumbnail__image">

                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="product-info">
                                                            <span class="product-info-name"><?php echo htmlspecialchars($product->getProductName()); ?></span>
                                                        </td>
                                                        <td class="product-price text-right">
                                                            <?php
                                                            if ($product->getPricePromotion()) {
                                                                $price = $product->getPricePromotion();
                                                            } else {
                                                                $price = !empty($product->getPrice()) ? $product->getPrice() : 0;
                                                            }
                                                            ?>
                                                            <?php echo number_format($price, 0, ",", ".") . 'đ'; ?>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                        <hr class="m0">
                                    </div>


                                    <div class="form-group clearfix hidden-sm hidden-xs">
                                        <div class="field__input-btn-wrapper mt10">

                                            <input class="btn btn-primary btn-checkout"
                                                   data-loading-text="Đang xử lý"
                                                   value="ĐẶT HÀNG" type="submit">
                                        </div>
                                        <div class="frm-item" style="margin-top: 20px; font-weight: bold;">
                                            <span class="label"></span>
                                            <span class="btn-in" style="color: green;">
                                                <?php if ($sf_user->hasFlash('success')): ?>
                                                <span><?php echo __($sf_user->getFlash('success'), null, 'tmcTwitterBootstrapPlugin') ?></span>
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</form>