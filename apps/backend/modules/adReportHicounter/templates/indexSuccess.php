<?php use_helper('I18N', 'Date') ?>
<?php include_partial('adReportHicounter/assets') ?>
<?php include_partial('adReportHicounter/header') ?>



<div class="container-fluid">
    <div class="row-fluid">
        <?php if ($sidebar_status): ?>
            <?php include_partial('adReportHicounter/list_sidebar', array('configuration' => $configuration)) ?>
        <?php endif; ?>

        <div class="span<?php echo $sidebar_status ? '10' : '12'; ?>">
            
            <div class="span12">
            <h1 style="display: inline"><?php echo __('Thống kê lượt xem bài trong chuyên mục', array(), 'messages') ?></h1>
            </div>
            <div class="row-fluid">
                <div class="span9">
                                  <?php include_partial('adReportHicounter/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
                                </div>
                <div class="span3">
                    <div class="pull-right"></div>
                </div>
            </div>
            

            <?php include_partial('adReportHicounter/flashes') ?>
            
            <div id="sf_admin_header">
                <?php include_partial('adReportHicounter/list_header', array('pager' => $pager)) ?>
            </div>

            <div id="sf_admin_content">
                <table border="0">
                    <tr>
                        <td>
                            <div>
                                <?php  $user = sfContext::getInstance()->getUser();
                                $sFileName = '/hitcounter/'  . $user->getGuardUser()->getId(). '_bar_hitcounter.png';
                                if (is_file(sfConfig::get('app_upload_media_file') . $sFileName)) {
                                    echo ' <img src="' . sfConfig::get('app_url_media_file') . '/hitcounter/' . $user->getGuardUser()->getId(). '_bar_hitcounter.png " />';
                                }
                                ?>
                            </div>
                        </td>
                        <td>
                            <div>
                                <?php  $user = sfContext::getInstance()->getUser();
                                $sFileName = '/hitcounter/'  . $user->getGuardUser()->getId(). '_pie_hitcounter.png';
                                if (is_file(sfConfig::get('app_upload_media_file') . $sFileName)) {
                                    echo ' <img src="' . sfConfig::get('app_url_media_file') . '/hitcounter/' . $user->getGuardUser()->getId(). '_pie_hitcounter.png " />';
                                }
                                ?>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="clearfix"></div>
            </div>

        </div>
    </div>
</div>

<?php include_partial('adReportHicounter/footer') ?>