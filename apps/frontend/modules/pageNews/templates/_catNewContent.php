<?php
/**
 * Created by PhpStorm.
 * User: conghuyvn8x
 * Date: 1/13/2018
 * Time: 9:50 PM
 */
$n = count($listArticle);
?>

<div class="col-sm-8" id="catNewContent">

    <div class="clearfix"></div>
    <?php
    for ($i = 0; $i < $n; $i++) {
        $new = $listArticle[$i];
        $path = '/uploads/' . sfConfig::get('app_article_images') . $new->image_path;
        ?>
        <article class="posts-archives-item" id="post-<?php echo $new->id ?>"
                 class="post-<?php echo $new->id ?> post type-post status-publish format-image has-post-thumbnail hentry category-activities tag-summer post_format-post-format-image">


            <div class="post-content-item-left">
<!--            <div class="--><?php //echo ($i % 2 == 0) ? 'post-content-item-right' : 'post-content-item-left' ?><!--">-->
                <div class="post-thumb">
                    <a
                        href="<?php echo url_for1('@news_detail?slug=' . $new->slug) ?>" rel="bookmark">
                        <img
                            src="<?php echo VtHelper::getThumbUrl($path, 370, 200, 'image_370_200') ?>"
                            class="attachment-blog size-blog wp-post-image" alt=""/></a>
                </div>
                <div class="entry-content">
                    <div class="entry-content-p">

                        <p>
                            <a
                                href="<?php echo url_for1('@news_detail?slug=' . $new->slug) ?>" rel="bookmark">
                                <?php echo htmlspecialchars($new->title) ?>
                            </a>
                        </p>
                    </div>
                    <div class="entry-meta">
                    <span class="date"><i class="fa fa-calendar"></i><time datetime="2018-01-13T04:13:03+00:00">
                            <?php echo VtHelper::getDateNew($new->created_at) ?>
                        </time></span>

                        <span class="author"><i
                                class="fa fa-eye"></i><?php echo isset($new->hit_count) ? $new->hit_count : '0' ?></span>

                        <div class="fb-like"
                             data-href="<?php echo sfConfig::get('app_site_host') . url_for1('@news_detail?slug=' . $new->slug) ?>"
                             data-layout="button_count" data-action="like" data-size="small" data-show-faces="false"
                             data-share="true"></div>

                        <!--                    <span class="comments"><i class="fa fa-comment"></i><a href="#comments"> 1 Comment</a></span>-->
                        <!--                    <span-->
                        <!--                        class="entry-categories"><i class="fa fa-tag"></i>Posted in <a-->
                        <!--                            href="http://www.coffeecreamthemes.com/themes/magicreche/wordpress/category/activities/"-->
                        <!--                            rel="category tag">Activities</a></span>-->
                        <!--                    <span class="entry-tags"><i class="fa fa-tags"></i>Tags: <a-->
                        <!--                            href="http://www.coffeecreamthemes.com/themes/magicreche/wordpress/tag/summer/"-->
                        <!--                            rel="tag">summer</a></span>-->
                    </div>

                    <div class="excerpt-content">
                        <article>
                            <p style="text-align: justify; padding: 5px 0px;">
                                <?php echo htmlspecialchars($new->header) ?>
                            </p>

                            <div class="more-link-wrapper" style="float: right;">
                                <a class="more-link"
                                   href="<?php echo url_for1('@news_detail?slug=' . $new->slug) ?>">
                                    Xem thêm
                                </a></div>
                        </article>
                    </div>

                    <!--                        <div class="post-more"><a-->
                    <!--                                href="-->
                    <?php //echo url_for1('@news_detail?slug=' . $new->slug) ?><!--"-->
                    <!--                                class="btn btn-primary">Read more</a></div>-->
                </div>
                <div class="clearfix"></div>
            </div>


        </article>
        <?php
    }
    ?>

    <div style="clear: both; margin-top: 15px;">

        <?php if ($pager && $pager->haveToPaginate()): ?>
            <div class="paging-bottom-style1">
                <ul class="pagination">
                    <?php if ($pager->getPage() >= 2): ?>
                        <li><a href="<?php echo url_for1('@category_new?slug=' . $cat->slug) ?>">
                                <i class="fa fa-angle-left"></i></a></li>
                    <?php endif; ?>
                    <?php foreach ($pager->getLinks() as $page): ?>
                        <li>
                            <a href="<?php echo url_for1('@category_new?slug=' . $cat->slug . '&page=' . $page) ?>"
                               class="<?php echo $page == $pager->getPage() ? 'active' : '' ?>">
                                <?php echo $page ?></a></li>
                    <?php endforeach; ?>
                    <?php if ($pager->getPage() < $pager->getLastPage()): ?>
                        <li>
                            <a href="<?php echo url_for1('@category_new?slug=' . $cat->slug . '&page=' . $pager->getLastPage()) ?>"><i
                                    class="fa fa-angle-right"></i></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif; ?>

    </div>
</div>
