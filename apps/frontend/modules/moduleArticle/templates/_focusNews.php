<?php if (isset($articles) && $articles): ?>
    <div id="multimedia" class="sct">
        <div class="hed"><h1>Tin tiêu điểm</h1></div>
        <ul class="bx-news-focus">
            <?php foreach ($articles as $article):
                $path = '/uploads/' . sfConfig::get('app_article_images') . $article['image_path'];
                ?>

                <li><a href="<?php echo url_for2('article_detail',array('slug'=>$article['slug'])) ?>">
                        <img src="<?php echo VtHelper::getThumbUrl($path, 187, 125, 'image_default') ?>" title="<?php echo htmlspecialchars($article['title']); ?>" />
                    </a>
                    <h3 class="focus-news">
                        <a href="<?php echo url_for2('article_detail', array('slug' => $article['slug'])) ?>"
                           title="<?php echo htmlspecialchars($article['title']); ?>">
                            <?php
                            if ($article['alttitle']) {
                                echo VtHelper::truncate($article['alttitle'], 40, '...');
                            } else {
                                echo VtHelper::truncate($article['title'], 40, '...');
                            }

                            ?>
                        </a></h3>
                </li>

            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<script type="text/javascript">
    $(function () {
        $('.bx-news-focus').bxSlider({
            minSlides: 1,
            maxSlides: 5,
            slideWidth: 170,
            slideMargin: 10,
            pager: false,
            moveSlides: 1
        });
    });

</script>