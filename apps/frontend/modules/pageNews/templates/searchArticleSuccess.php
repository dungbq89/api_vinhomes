<?php slot('title') ?>
<?php echo sprintf('%s', 'Tìm kiếm: ' . htmlentities($query)) ?>
<?php end_slot() ?>

<?php

if ($pager && $pager->getNbResults()>0) {
    $listVideo = $pager->getResults();
    $n = count($listVideo);
    ?>
    <header><h1><?php echo 'Tìm kiếm: ' . htmlentities($query) ?></h1>
    </header>

    <section id="latest-posts pageVideo" class="post-18 page type-page status-publish hentry">
        <div class="container">
            <?php
            switch ($type) {
                case'1': {  // video
                    include_partial('pageNews/searchVideo', array('pager' => $pager,
                        'type' => $type, 'page' => $page
                    ));
                }
                    break;
                case'2': {  // tai lieu
                    include_partial('pageNews/searchDoc', array('pager' => $pager,
                        'type' => $type, 'page' => $page));
                }
                    break;
                default: {   // tin tuc
                    include_partial('pageNews/searchNews', array('pager' => $pager,
                        'type' => $type, 'page' => $page));
                }
            }
            ?>
        </div>
    </section>
<?php } else {
    ?>
    <header><h1><?php echo 'Không có dữ liệu' ?></h1>
    </header>
    <?php
} ?>