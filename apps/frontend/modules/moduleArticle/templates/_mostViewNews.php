<?php
if (isset($articles) && $articles):
    ?>
    <div class="mostview-head">
        <h1 class="h1-mostview">Xem nhiều</h1>
        <?php foreach ($articles as $article):
            $path = '/uploads/' . sfConfig::get('app_article_images') . $article['image_path'];
        ?>
            <div class="atc">
                <div class="cover">
                    <a href="<?php echo url_for2('article_detail',array('slug'=>$article['slug'])) ?>">
                        <img style="display: block; width: 75px; height: 70px;"
                            src="<?php echo VtHelper::getThumbUrl($path, 75, 70, 'image_75_70') ?>">
                    </a>
                </div>
                <div class="hed"><h1>
                        <a href="<?php echo url_for2('article_detail',array('slug'=>$article['slug'])) ?>">
                            <?php echo VtHelper::translateQuery($article['title'],50,'...'); ?>
                        </a></h1>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>