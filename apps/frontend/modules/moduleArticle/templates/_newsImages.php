<div class="sct pictures" rel="38" id="ta38">
    <div class="hed">
        <h1><a href="#">Tin ảnh</a></h1>
    </div>
    <?php
    if (isset($articles) && count($articles) > 1): ?>
    <div class="slidebox" id="dslide">
        <ul class="bx-news">
        <?php for($i=0;$i<count($articles);$i++):
            $path = '/uploads/' . sfConfig::get('app_article_images') . $articles[$i]['image_path'];
            ?>
            <li><a href="<?php echo url_for2('article_detail',array('slug'=>$articles[$i]['slug'])) ?>">
                    <img src="<?php echo VtHelper::getThumbUrl($path, 305, 200, '') ?>" title="<?php echo htmlspecialchars($articles[$i]['title']); ?>" />
                </a>
            </li>
        <?php endfor; ?>
            </ul>
    </div>
    <script type="text/javascript">
        $(function () {
            $('.bx-news').bxSlider({
                mode: 'fade',
                captions: true,
                auto: true
            });
        });

    </script>
    <?php endif; ?>
</div>