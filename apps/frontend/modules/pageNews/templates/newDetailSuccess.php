<?php slot('title') ?>
<?php echo sprintf('%s', htmlentities($article['title'])) ?>
<?php end_slot() ?>

<!--<header><h1>--><?php //echo htmlentities($article['title']) ?><!--</h1>-->
<!--</header>-->

<div class="container posts-archives">

    <?php include_component('pageNews', 'bannerItem') ?>

    <div class="row">
        <div class="col-sm-8">
            <article id="post-211"
                     class="post-211 post type-post status-publish format-gallery hentry category-kids category-toys tag-spring post_format-post-format-gallery">
                <h2 class="entry-title" style="font-weight: bold; font-size: 18px;"><?php echo $article['title'] ?></h2>
<!--                <h3 class="entry-title" style="font-size: 20px">--><?php //echo $article['header'] ?><!--</h3>-->

                <div class="entry-meta">
                    <span class="date"><i class="fa fa-calendar"></i><time datetime="2018-01-13T17:08:58+00:00">
                            <?php echo VtHelper::getDateNew($article['created_at']) ?>
                        </time></span>

                        <span class="author"><i
                                class="fa fa-eye"></i><?php echo isset($article['hit_count']) ? $article['hit_count'] : '0' ?></span>

                    <div class="fb-like" data-href="<?php echo sfConfig::get('app_site_host') . url_for1('@news_detail?slug=' . $article['slug']) ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>


                </div>

                <div class="entry-content">
                    <div>
                        <?php echo $article['body'] ?>
                    </div>
                </div>

                <?php
                if(isset($listArticle) && count($listArticle)){
                    ?>
                    <div class="list-related">
                        <h3 style="color: #e75d5d; font-weight: bold;">Các bài viết liên quan</h3>
                        <ul style="margin: 0px; padding: 0px; font-size: 17px;">
                            <?php
                            foreach ($listArticle as $value){
                                ?>
                                <li><a href="<?php echo url_for1('@news_detail?slug=' . $value['slug']) ?>"><?php echo $value['title']; ?></a> </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <?php
                }
                ?>

                <div class="entry-content">
                    <div class="fb-comments"
                         data-href="<?php echo sfConfig::get('app_seo_url') . url_for1('@news_detail?slug=' . $article['slug']) ?>"
                         data-colorscheme="light"
                         data-numposts="5" data-width="500"></div>
                </div>

            </article>
        </div>

        <?php include_component('pageNews', 'catNewNav', array('type' => 3)) ?>
    </div>
</div>