<?php
/**
 * Created by PhpStorm.
 * User: conghuyvn8x
 * Date: 6/27/2018
 * Time: 9:53 PM
 */
?>
<div class="col-xl-3 col-lg-4 order-lg-1" style="padding: 0px 25px;">
    <aside class="sidebar sidebar-offcanvas">
        <section class="widget widget-categories"><h3 class="widget-title">Danh mục cửa
                hàng</h3>
            <ul class="menu" id="tree-category">
                <ul>
                    <?php
                    if ($arrLocation) {
                        foreach ($arrLocation as $location) {
                            $arrChildMenu = isset($arrMenu[$location]) ? $arrMenu[$location] : [];
                            ?>
                            <li class="has-children click-pointer active expanded">
                                <a id="cat-2-tree"
                                   href="<?php echo url_for('@homepage?location=' . $location . '&isAll=1') ?>">
                                    <?php echo $arrLocationName[$location]; ?>
                                </a>
                                <?php
                                if ($arrChildMenu && isset($arrChildMenu['listItem']) && $arrChildMenu['listItem']) {
                                    ?>
                                    <ul>
                                        <?php
                                        foreach ($arrChildMenu['listItem'] as $item2) {
                                            if (isset($countMessage['mm_' . $item2['id']]) && $countMessage['mm_' . $item2['id']] > 0) {
                                                ?>
                                                <li class="has-children click-pointer active expanded">
                                                    <a id="cat-2-tree"
                                                       href="<?php echo url_for('@homepage?location=' . $item2['id']) ?>">
                                                        <?php echo $item2['name'] ?>
                                                        (<?php echo (isset($countMessage['mm_' . $item2['id']])) ? $countMessage['mm_' . $item2['id']] : 0 ?>
                                                        )
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>

                                    </ul>
                                    <?php
                                }
                                ?>
                            </li>
                            <?php
                        }
                    }
                    ?>

                </ul>
            </ul>
        </section>
    </aside>
</div>
