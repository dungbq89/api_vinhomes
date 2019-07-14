<?php
/**
 * Created by PhpStorm.
 * User: conghuyvn8x
 * Date: 1/13/2018
 * Time: 9:50 PM
 */
$listVideo = $pager->getResults();
$n = count($listVideo);
if ($n > 0) {
    $dem = 1;
    foreach ($listVideo as $video) {
        $path = '/uploads/' . sfConfig::get('app_article_images') . $video->image_path;
        if ($dem % 3 == 1) echo '<div class="block-line">';
        ?>
        <div>
            <div class="item blog-item">
                <article class="post">
                    <h2 class="entry-title"><a
                            href="<?php echo url_for1('@news_detail?slug=' . $video->slug) ?>"
                            rel="bookmark"><?php echo htmlspecialchars($video->title) ?></a></h2>

                    <div class="entry-meta">
                            <span class="date"><i class="fa fa-calendar"></i><time datetime="2018-01-11T01:29:26+00:00">
                                    <?php echo VtHelper::getDateNew($video->created_at) ?>
                                </time></span><br/>
                        <!--                                <span class="author"><i class="fa fa-user"></i>By Hleb Poltanovich</span><br/>-->
                        <!--                                <span class="comments"><i class="fa fa-comment"></i><a href="#comments"> 1-->
                        <!--                                        Comment</a></span>-->
                        <!--                                <span class="entry-categories"><i class="fa fa-tag"></i>Posted in <a-->
                        <!--                                        href="http://www.coffeecreamthemes.com/themes/magicreche/wordpress/category/activities/"-->
                        <!--                                        rel="category tag">Activities</a></span>-->
                        <!--                                <span class="entry-tags"><i-->
                        <!--                                        class="fa fa-tags"></i>Tags: <a-->
                        <!--                                        href="http://www.coffeecreamthemes.com/themes/magicreche/wordpress/tag/summer/"-->
                        <!--                                        rel="tag">summer</a></span>-->
                    </div>
                    <div class="post-thumb" data-img="<?php echo $path ?>">
                        <a href="<?php echo url_for1('@news_detail?slug=' . $video->slug) ?>">
                            <img width="750" height="422"
                                 src="<?php echo VtHelper::getThumbUrl($path, 321, 184, 'video_default'); ?>"
                                 class="attachment-blog size-blog wp-post-image" alt=""/>
                        </a>
                    </div>
                    <div class="entry-content">
                        <div>
                            <p>
                                <?php echo VtHelper::truncate(htmlspecialchars($video->header), 300, ''); ?>
                            </p></div>
                        <div class="post-more"><a
                                href="<?php echo url_for1('@news_detail?slug=' . $video->slug) ?>"
                                class="btn btn-primary">Read more</a></div>
                    </div>
                </article>
            </div>
        </div>
        <?php
        if ($dem % 3 == 0) echo '</div>';
        if ($n <= 3 && $dem == $n) echo '</div>';
        $dem++;
    }
}
?>
<?php
if ($pager->getLastPage() > 1) {
    ?>
    <div style="clear: both">

        <?php if ($pager && $pager->haveToPaginate()): ?>
            <div class="paging-bottom-style1">
                <ul class="pagination">
                    <?php if ($pager->getPage() >= 2): ?>
                        <li>
                            <a href="<?php echo url_for1('@article_search?page=1&type=' . $type . '&s=' . htmlentities($query)) ?>">
                                <i class="fa fa-angle-left"></i></a></li>
                    <?php endif; ?>
                    <?php foreach ($pager->getLinks() as $page): ?>
                        <li>
                            <a href="<?php echo url_for1('@article_search?type=' . $type . '&page=' . $page . '&s=' . htmlentities($query)) ?>"
                               class="<?php echo $page == $pager->getPage() ? 'active' : '' ?>">
                                <?php echo $page ?></a></li>
                    <?php endforeach; ?>
                    <?php if ($pager->getPage() < $pager->getLastPage()): ?>
                        <li>
                            <a href="<?php echo url_for1('@article_search?type=' . $type . '&page=' . $pager->getLastPage() . '&s=' . htmlentities($query)) ?>"><i
                                    class="fa fa-angle-right"></i></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif; ?>

    </div>
<?php } ?>