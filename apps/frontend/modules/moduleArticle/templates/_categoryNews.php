<?php if (isset($categories) && $categories): ?>
    <?php
    $check = 1;
    foreach ($categories as $category): ?>
        <?php
        $listNews = $category->getNewsByCategory();
        $count=count($listNews);
        if ($count):
            $path = '/uploads/' . sfConfig::get('app_article_images') . $listNews[0]['image_path'];
            ?>
            <div class="box-news-home">
                <h3 class="h3-tinh-nang">
                    <?php echo htmlspecialchars($category->getName()); ?>
                </h3>

                <div class="item news-item">
                    <a href="<?php echo url_for2('article_detail', array('slug' => $listNews[0]['slug'])) ?>"
                       title="" class="news-title"><?php echo VtHelper::truncate($listNews[0]['title'],60, ' ...'); ?></a>

                    <a href="<?php echo url_for2('article_detail', array('slug' => $listNews[0]['slug'])) ?>" title=""
                       class="news-img"><img style="margin-top: 5px;" src="<?php echo VtHelper::getThumbUrl($path, 125, 80, 'image_125_80') ?>" alt=""></a>

                    <div class="news-info-cat">
                        <p class="news-txt">
<!--                            <span class="news-date">-->
<!--                                --><?php
//                                if ($listNews[0]['published_time']) echo VtHelper::getFormatDate($listNews[0]['published_time']);
//                                ?>
<!--                            </span>-->
                            <?php echo VtHelper::truncate($listNews[0]['header'], 80, '...'); ?><a href="<?php echo url_for2('article_detail', array('slug' => $listNews[0]['slug'])) ?>" class="readmore" title="Xem tiếp">...Chi tiết
                                >></a></p>

                    </div>
                    <div class="more-news">
                        <?php if($count>1){
                            echo "<ul class='ul-more-news'>";
                            for($j=1; $j<$count; $j++){
                                ?>
                                <li>
                                    <a href="<?php echo url_for2('article_detail', array('slug' => $listNews[$j]['slug'])) ?>"
                                       title="" class="news-title"><?php echo VtHelper::truncate($listNews[$j]['title'],60, ' ...'); ?></a>
                                </li>
                            <?php
                            }
                            echo "</ul>";
                        } ?>
                    </div>
                </div>

                <div class="clear"></div>
            </div>
            <?php
                if($check%2==0){
                    ?>
                    <div class="clear"></div>
                    <div class="banner-home">
                        <a href="#" class=""><img src="../img/home_tuvan.jpg" width="315"/></a>
                        <a href="#" class=""><img src="../img/home_tracuu.jpg" width="315"/></a>
                        <a href="#" class=""><img src="../img/home_hocbong.jpg" width="315"/></a>
                        <a href="#" class=""><img src="../img/home_tructuyen.jpg" width="315"/></a>
                    </div>
                    <?php
                }
            ?>
        <?php endif; ?>
    <?php
    $check++;
    endforeach; ?>
<?php endif; ?>
