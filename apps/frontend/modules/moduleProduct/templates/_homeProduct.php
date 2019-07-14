<?php
/**
 * Created by PhpStorm.
 * User: dung
 * Date: 12/1/2015
 * Time: 11:16 PM
 */ ?>
<?php if (isset($products)): ?>
    <div class="video-kmgivang">


        <div class="khuyenmai_giovang fr">
            <div class="box_tde_sp">
                <h2><a href="/san-pham-ban-chay.html">Sản phẩm Hot Nhất hiện nay</a></h2>

                <ul class="list-item2" id="goldtime">
                    <?php
                    for ($i = 0; $i < count($products); $i++) {
                        $percent = 0;
                        if ($products[$i]['price_promotion'] && $products[$i]['price_promotion'] != 0) {
                            if ($products[$i]['price'] && $products[$i]['price'] != 0) {
                                $subPer = intval($products[$i]['price'])- intval($products[$i]['price_promotion']);
                                $percent = round(($subPer/ $products[$i]['price']) * 100);
                            }
                        }
                        $link = url_for('@product_detail?slug=' . $products[$i]['slug']);
                        $path = '/uploads/' . sfConfig::get('app_product_images') . $products[$i]['image_path'];
                        ?>
                        <li>
                            <div class="bos_sp">
                                <a href="<?php echo htmlspecialchars($link); ?>"
                                   title="<?php echo htmlspecialchars($products[$i]['product_name']); ?>">
                                    <img src="<?php echo VtHelper::getThumbUrl($path, 180, 140, 'product_180_140') ?>"
                                         alt="<?php echo htmlspecialchars($products[$i]['product_name']); ?>"/>
                                </a>
                            </div>
                            <?php if ($percent > 0): ?>
                                <p class="type-discount">-<?php echo $percent; ?>%</p>
                            <?php endif; ?>

                            <span class="product-name"><a href="<?php echo htmlspecialchars($link); ?>"
                                                          title="<?php echo htmlspecialchars($products[$i]['product_name']); ?>"><?php echo htmlspecialchars($products[$i]['product_name']); ?></a></span>
                            <?php
                            if ($products[$i]['price_promotion'] && $products[$i]['price_promotion'] != 0) {
                                if ($products[$i]['price'] && $products[$i]['price'] != 0) {
                                    ?>
                                    <span class="product-pricesave"><?php
                                        if ($products[$i]['price']) {
                                            echo number_format($products[$i]['price'], 0, ",", ".") . ' vnđ';
                                        }?></span>

                                    <span class="product-name2"><?php
                                        echo number_format($products[$i]['price_promotion'], 0, ",", ".") . ' vnđ';
                                        ?>
                                    </span>
                                <?php
                                } else {
                                    ?>
                                    <span class="product-name2"><?php
                                        if ($products[$i]['price_promotion']) {
                                            echo number_format($products[$i]['price_promotion'], 0, ",", ".") . ' vnđ';
                                        } else {
                                            echo 'Liên hệ';
                                        }
                                        ?>
                                    </span>
                                <?php
                                }
                            } else {
                                ?>
                                <span class="product-name2"><?php
                                    if ($products[$i]['price']) {
                                        echo number_format($products[$i]['price'], 0, ",", ".") . ' vnđ';
                                    } else {
                                        echo 'Liên hệ';
                                    }
                                    ?>
                                    </span>
                                <?php
                            }
                            ?>
                        </li>
                    <?php
                    }
                    ?>
                </ul>

                <p class="pre" id="goldtime_prev"><a href="javascript:void(0)" rel="nofollow"><img
                            src="../Content/skins/images/pre2.png"/></a></p>

                <p class="next" id="goldtime_next"><a href="javascript:void(0)" rel="nofollow"><img
                            src="../Content/skins/images/nexxt2.png"/></a></p>
            </div>
        </div>

    </div>

    <div class="clearfix"></div>
<?php endif; ?>