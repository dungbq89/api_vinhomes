<?php
/**
 * Created by PhpStorm.
 * User: conghuyvn8x
 * Date: 1/13/2018
 * Time: 9:50 PM
 */
?>

<div class="col-sm-4 sidebar" id="pageNewNav">
    <aside id="search-3" class="widget widget_search">
        <div class="searchbox">
            <form role="search" method="get" id="searchform"
                  action="<?php echo url_for1('@article_search') ?>">
                <input type="text" placeholder="To search type and hit enter&hellip;" class="form-control" value=""
                       name="s">
                <input type="hidden" name="type" value="<?php echo $type ?>">

            </form>
        </div>
    </aside>
    <hr>
    <aside id="recent-posts-3" class="widget widget_recent_entries"><h5>Quảng cáo</h5>
        <ul>
            <li>
                <?php if ($adVertises && count($adVertises > 1)) {
                    ?>
                    <div class="slide-advertise">
                        <?php
                        foreach ($adVertises as $adv) {
                            $path = '/uploads/' . sfConfig::get('app_advertise_images') . $adv['file_path'];
                            ?>
                            <div class="item">
                                <a href="<?php echo $adv['link'] ?>"
                                   data-img="<?php echo $path ?>">
                                    <img src="<?php echo VtHelper::getThumbUrl($path, 321, 184, 'image_default'); ?>">
                                </a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php } ?>
            </li>
        </ul>
    </aside>
    <hr>
    <aside id="recent-posts-3" class="widget widget_recent_entries"><h5>CÁC BÀI VIẾT MỚI</h5>
        <ul>
            <?php if (!empty($listNews)) {
                foreach ($listNews as $new) {
                    ?>
                    <li>
                        <p class="post-title">
                            <a href="<?php echo url_for1('@news_detail?slug=' . $new['slug']) ?>">
                                <?php echo htmlentities($new['title']) ?>
                            </a>
                        </p>
                    </li>
                    <?php
                }
            } ?>
        </ul>
    </aside>
    <hr>
    <aside id="recent-posts-3" class="widget widget_recent_entries"><h5>NHIỀU LƯỢT XEM NHẤT</h5>
        <ul>
            <?php if (!empty($listViews)) {
                foreach ($listViews as $new) {
                    ?>
                    <li>
                        <p class="post-title">
                            <a href="<?php echo url_for1('@news_detail?slug=' . $new['slug']) ?>">
                                <?php echo htmlentities($new['title']) ?>
                            </a>
                        </p>
                    </li>
                    <?php
                }
            } ?>
        </ul>
    </aside>
    <hr>
    <?php if (!empty($linls)) {

        ?>
        <aside id="recent-posts-3" class="widget widget_recent_entries"><h5>CÁC WEBSITE LIÊN KẾT</h5>
            <ul>
                <?php
                foreach ($linls as $link) {
                    ?>
                    <li>
                        <a href="<?php echo $link['link'] ?>"
                           target="_blank"><?php echo htmlspecialchars($link['name']) ?></a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </aside>
        <hr>
        <?php
    } ?>


</div>
