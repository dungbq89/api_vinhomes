<?php
if (isset($articles) && $articles):
    $path = '/uploads/' . sfConfig::get('app_article_images') . $articles[0]['image_path'];
    ?>
    <div class="sct featured">
        <div class="atc featured picture">
            <div
                style="background-image: url(<?php echo VtHelper::getThumbUrl($path, 460, 268, '') ?>); background-size: cover;height: 268px;"
                class="cover dthumb">
                <a href="<?php echo url_for2('article_detail', array('slug' => $articles[0]['slug'])) ?>"></a>
            </div>
            <div class="hed">
                <h1><a href="<?php echo url_for2('article_detail', array('slug' => $articles[0]['slug'])) ?>">
                        <?php
                        if ($articles[0]['alttitle']) {
                            echo htmlspecialchars($articles[0]['alttitle']);
                        } else {
                            echo htmlspecialchars($articles[0]['title']);
                        }

                        ?>
                    </a></h1>
                <time style="display:none"><?php
                    if ($listNews[0]['published_time']) echo VtHelper::getFormatDate($articles[0]['published_time']);
                    ?></time>
                <p class="summary"><?php echo VtHelper::truncate($articles[0]['header'], 200, '...'); ?></p>
            </div>
        </div>
        <?php if (count($articles) > 1): ?>
            <?php for ($i = 1; $i < 4; $i++):
                $pathi = '/uploads/' . sfConfig::get('app_article_images') . $articles[$i]['image_path'];
                ?>
                <div class="atc dor" style="<?php if ($i == 3) echo 'margin-right: 0px'; ?>">
                    <a href="<?php echo url_for2('article_detail', array('slug' => $articles[$i]['slug'])) ?>">
                        <img style="height:100px;" src="<?php echo VtHelper::getThumbUrl($pathi, 150, 100, 'image_150_100') ?>">
                    </a>

                    <div class="hed"><h1><a
                                href="<?php echo url_for2('article_detail', array('slug' => $articles[$i]['slug'])) ?>">
                                <?php
                                if($articles[$i]['alttitle']){
                                    echo htmlspecialchars($articles[$i]['alttitle']);
                                }
                                else{
                                    echo htmlspecialchars($articles[$i]['title']);
                                }

                                ?>
                            </a></h1></div>
                </div>

            <?php endfor; ?>
        <?php endif; ?>

    </div>
    <div class="item item-lastest-news">
        <h3 class="title"><?php echo __('Tin nổi bật'); ?></h3>
        <?php if (count($articles) > 4): ?>
            <ul class="box-scroll mCustomScrollbar">
                <?php for ($i = 1; $i < count($articles); $i++): ?>
                    <li>
                        <a href="<?php echo url_for2('article_detail', array('slug' => $articles[$i]['slug'])) ?>"
                           title="<?php echo htmlspecialchars($articles[$i]['title']); ?>">
                            <?php
                                if($articles[$i]['alttitle']){
                                    echo htmlspecialchars($articles[$i]['alttitle']);
                                }else{
                                    echo htmlspecialchars($articles[$i]['title']);
                                }

                            ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        <?php endif; ?>
    </div>
<?php endif; ?>