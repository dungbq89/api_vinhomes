<?php if (isset($categories) && $categories): ?>
    <?php foreach ($categories as $category): ?>
        <?php
        $listNews = $category->getNewsByCategory();
        if (count($listNews)):
            ?>
            <div class="box-mod">
                <h3 class="title"><span class="label"><?php echo htmlspecialchars($category->getName()); ?>
                        &raquo</span></h3>
                <?php
                foreach ($listNews as $news):
                    $path = '/uploads/' . sfConfig::get('app_article_images') . $news['image_path'];
                    ?>
                    <div class="item news-item">
                        <a href="<?php echo url_for2('article_detail', array('slug' => $news['slug'])) ?>" title=""
                           class="news-img"><img src="<?php echo VtHelper::getThumbUrl($path, 92, 55, 'image_92_55') ?>"
                                                 alt=""></a>
                        <a href="<?php echo url_for2('article_detail', array('slug' => $news['slug'])) ?>"
                           title="<?php echo htmlspecialchars($news['title']); ?>" class="news-title">
                            <?php
                            if ($news['alttitle']) {
                                echo htmlspecialchars($news['alttitle']);
                            }else{
                                echo htmlspecialchars($news['title']);
                            }
                            ?>
                        </a>

                        <p class="news-date">
                            <?php
                            if ($news['published_time']) echo VtHelper::getFormatDate($news['published_time']);
                            ?>
                        </p>

                        <div class="clear"></div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>
