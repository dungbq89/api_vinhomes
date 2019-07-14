<?php
if (isset($articles) && $articles):
    $i=1;
?>

<div class="sct topic box-doc-nhieu" rel="hn228">
    <div class="hed">
        <h1><a href="#">Tin đọc nhiều</a></h1>
    </div>
    <?php foreach ($articles as $article):
    $path = '/uploads/' . sfConfig::get('app_article_images') . $article['image_path'];
    ?>
    <div class="atc">
        <span class="order"><?php echo $i; ?></span>
        <header>
            <h1>
                <a href="<?php echo url_for2('article_detail',array('slug'=>$article['slug'])) ?>">
                    <?php
                    if($article['alttitle']){
                        echo htmlspecialchars($article['alttitle']);
                    }else{
                        echo htmlspecialchars($article['title']);
                    }

                    ?>
                </a>
            </h1>
            <time datetime=""><?php echo VtHelper::getFormatDate($article['published_time']); ?> </time>
        </header>
    </div>
    <?php $i ++; endforeach; ?>
</div>
<?php endif; ?>