<div class="col-main">
    <div class="box">
        <h3 class="title-main"><span class="label">Tin tức 1 »</span></h3>

        <div class="news-detail">
            <h3 class="title-article"><?php echo htmlspecialchars($article['title']); ?></h3>
                         <span class="txt-date">
                            <?php if ($article['published_time']) echo VtHelper::getFormatDate($article['published_time']); ?>
                        </span>

                        <span class="txt-artice-intro">
                            <?php echo htmlspecialchars($article['header']); ?>
                        </span>
            <?php echo $article['body']; ?>
            <?php
                if(isset($articleRelated) && count($articleRelated)):
            ?>
            <div class="box-article-more">
                <h3 class="h3-more">Bài viết cùng chuyên mục</h3>
                <?php
                    foreach($articleRelated as $value):
                ?>
                <a href="<?php echo url_for2('article_detail',array('slug'=>$value['slug'])) ?>" title="<?php echo htmlspecialchars($value['title']); ?>">
                    <?php echo htmlspecialchars($value['title']); ?>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <div class="clear"></div>
            <div class="commentTitle">
                <h3>BÌNH LUẬN</h3>
            </div>
        </div>

        <div class="comment-form">

            <form class="frm-log" action="" method="POST">
                <?php echo $form->renderHiddenFields() ?>

                <div class="frm-item">
                    <span class="label">Họ tên (*)</span>
                        <span class="btn-in">
                             <?php echo $form['fullname']->render(array('class'=>'in-txt'));
                             if ($form['fullname']->hasError()) {
                                 echo '<span class="help-inline">' . $form['fullname']->renderError() . '</span>';
                             }?>
                        </span>
                </div>


                <div class="frm-item">
                    <span class="label">Email (*)</span>
                        <span class="btn-in">
                             <?php echo $form['email']->render(array('class'=>'in-txt'));
                             if ($form['email']->hasError()) {
                                 echo '<span class="help-inline">' . $form['email']->renderError() . '</span>';
                             }?>
                        </span>
                </div>

                <div class="frm-item">
                    <span class="label">Nội dung (*)</span>
                        <span class="btn-in">
                             <?php echo $form['content']->render(array('class'=>'in-txt'));
                             if ($form['content']->hasError()) {
                                 echo '<span class="help-inline">' . $form['content']->renderError() . '</span>';
                             }?>
                        </span>
                </div>
                <div class="frm-item">
                    <span class="label"></span>
                        <span class="btn-in">
                            <?php if ($sf_user->hasFlash('success')): ?>
                                <span><?php echo __($sf_user->getFlash('success'), null, 'tmcTwitterBootstrapPlugin') ?></span>
                            <?php endif; ?>
                        </span>
                </div>
                <div class="box-btn">
                    <button name="" type="submit" class="btn">Gửi bình luận</button>
                </div>

            </form>
        </div>
        <?php
         if(isset($articleOther) && count($articleOther)):
        ?>
            <div class="news-detail">
                <div class="commentTitle">
                    <h3>CÁC TIN ĐÃ ĐƯA</h3>
                </div>
                <?php
                    foreach($articleOther as $value):
                        $path = '/uploads/' . sfConfig::get('app_article_images') . $value['image_path'];
                        $path = VtHelper::getThumbUrl($path, 460, 268, '');
                ?>
                    <div class="atc">
                        <div style="background-image: url('<?php echo $path; ?>'); background-size: cover;" class="cover">
                            <a href="<?php echo url_for2('article_detail',array('slug'=>$value['slug'])) ?>" title="<?php echo htmlspecialchars($value['title']); ?>"></a>
                        </div>
                        <div class="hed">
                            <h1><a href="<?php echo url_for2('article_detail',array('slug'=>$value['slug'])) ?>">
                                <?php echo VtHelper::truncate($value['title'],50,'...'); ?>
                             </a></h1>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
         <?php endif; ?>
    </div>
</div>
<div class="col-right">
    <?php include_component('moduleDocument', 'hotDocument', array('limit' => 3)) ?>
    <?php include_component('moduleArticle', 'categoryHot', array('limit' => 3)) ?>
    <?php include_component('moduleAdvertise','advertise',array('location'=>'right')); ?>

</div>