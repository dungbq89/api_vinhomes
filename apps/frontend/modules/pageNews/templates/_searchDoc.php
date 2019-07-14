<?php
/**
 * Created by PhpStorm.
 * User: conghuyvn8x
 * Date: 1/13/2018
 * Time: 9:50 PM
 */
$listDocument = $pager->getResults();
$n = count($listArticle);

if ($n > 0) {
    $dem = 1;
    foreach ($listDocument as $doc) {
        $path = '/uploads/' . sfConfig::get('app_article_images') . $doc->getImage();
        $pathDoc = $doc->link;
        if ($dem % 3 == 1) echo '<div class="block-line">';
        ?>
        <div>
            <div class="item blog-item">
                <article class="post">

                    <div class="post-thumb">
                        <div class="post-thumb-img">
                            <a href="<?php echo $pathDoc ?>">
                                <img width="750" height="422"
                                     src="<?php echo VtHelper::getThumbUrl($path, 321, 184, 'video_default'); ?>"
                                     class="attachment-blog size-blog wp-post-image post-thumb-image"
                                     alt=""/>
                            </a>
                        </div>
                        <div class="post-thumb-overlay">
                            <div class="text">
                                <div class="post-more"><a
                                        href="<?php echo $pathDoc ?>"
                                        class="btn btn-primary">Download</a></div>

                            </div>
                        </div>
                    </div>
                    <div class="entry-content">
                        <div class="entry-content-p">
                            <p> <?php echo htmlspecialchars($doc->name) ?> </p>
                        </div>

                        <div class="excerpt-content">
                            <article>
                                <p>
                                    <?php echo $doc->description ?>
                                </p>

                            </article>
                        </div>
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