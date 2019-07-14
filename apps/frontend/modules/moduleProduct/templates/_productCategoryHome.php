<style>
    .owl-carousel1 .owl-wrapper {
        display: inline-block !important;
        text-align: center;
        width: auto !important;
    }
</style>

<section class="dq-stt-3">
    <section class="p20">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <header class="section-title">
                        <h2>Danh mục sản phẩm</h2>
                    </header>

                </div>
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-carousel owl-carousel1">
                            <?php
                                foreach ($productCategory as $category){
                                    $image = '/uploads/' . sfConfig::get('app_category_images') . $category->getImagePath();
                                    ?>
                                    <div class="item">
                                        <a href="<?php echo url_for('products', array('slug' => $category->getSlug())); ?>">
                                            <img src="<?php echo VtHelper::getThumbUrl($image, 164, 140, 'default'); ?>"
                                                 alt="<?php echo htmlspecialchars($category->getName()); ?>" title="<?php echo htmlspecialchars($category->getName()); ?>"/>
                                        </a>
                                        <h3 class="margin-bottom-15"><a
                                                    href="#"><?php echo htmlspecialchars($category->getName()); ?></a></h3>
<!--                                        <div class="margin-bottom-20"> (20 sản phẩm)</div>-->
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
