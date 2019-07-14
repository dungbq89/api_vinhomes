<?php use_helper('I18N', 'Date') ?>
<?php include_partial('adReportTotalRecord/assets') ?>
<?php include_partial('adReportTotalRecord/header') ?>

<div class="container-fluid">
    <div class="row-fluid">
        <?php if ($sidebar_status): ?>
            <?php include_partial('adReportTotalRecord/list_sidebar', array('configuration' => $configuration)) ?>
        <?php endif; ?>

        <div class="span<?php echo $sidebar_status ? '10' : '12'; ?>">
            
            <div class="span12">
            <h1 style="display: inline"><?php echo __('Thống kê bài viết trong chuyên mục', array(), 'messages') ?></h1>
            </div>
            <div class="row-fluid">
                <div class="span9">
                                  <?php include_partial('adReportTotalRecord/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
                                </div>
                <div class="span3">
                    <div class="pull-right"></div>
                </div>
            </div>
            

            <?php include_partial('adReportTotalRecord/flashes') ?>
            
            <div id="sf_admin_header">
                <?php include_partial('adReportTotalRecord/list_header', array('pager' => $pager)) ?>
            </div>

            <div id="sf_admin_content">
                <div>
                    <?php  $user = sfContext::getInstance()->getUser();
                    $sFileName = '/total_record/'  . $user->getGuardUser()->getId(). '_total_record.png';
                    if (is_file(sfConfig::get('app_upload_media_file') . $sFileName)) {
                        echo ' <img src="' . sfConfig::get('app_url_media_file') . '/total_record/' . $user->getGuardUser()->getId(). '_total_record.png " />';
                    }
                    ?>
                </div>
                <div class="clearfix"></div>
            </div>

        </div>
    </div>
</div>

<?php include_partial('adReportTotalRecord/footer') ?>