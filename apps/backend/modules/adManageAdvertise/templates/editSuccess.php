<?php use_helper('I18N', 'Date') ?>
<?php include_partial('adManageAdvertise/assets') ?>
<?php include_partial('adManageAdvertise/header') ?>

<div class="container-fluid">
    <div class="row-fluid">
        <?php if ($sidebar_status): ?>
            <?php include_partial('adManageAdvertise/edit_sidebar', array('configuration' => $configuration, 'ad_advertise' => $ad_advertise)) ?>
        <?php endif; ?>

        <div class="span<?php echo $sidebar_status ? '10' : '12'; ?>">
            <h1><?php echo __('Chỉnh sửa Banner quảng cáo', array(), 'messages') ?></h1>

            <?php include_partial('adManageAdvertise/flashes') ?>

            <div id="sf_admin_header">
                <?php include_partial('adManageAdvertise/form_header', array('ad_advertise' => $ad_advertise, 'form' => $form, 'configuration' => $configuration)) ?>
            </div>

            <div id="sf_admin_content">
                <?php include_partial('adManageAdvertise/form', array('ad_advertise' => $ad_advertise, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>

                <?php if (in_array('version', $fields->getRawValue())): ?>
                    <?php include_partial('versions', array('ad_advertise' => $ad_advertise->getRawValue(), 'fields' => $fields)); ?>
                <?php endif; ?>
            </div>

            <!-- Edit hinh anh -->
            <div class="sf_admin_header_help_center ">
                <h1><?php echo __('Danh sách hình ảnh quảng cáo') ?></h1>
            </div>

            <?php include_partial('adManageAdvertise/flashes_image') ?>

            <div id="sf_admin_content">
                <form class="form-inline" id="list-form" action="<?php echo url_for('ad_advertise_collection', array('action' => 'batchImage')) ?>" method="post">
                    <?php if(isset($pager) && isset($sort)):?>
                    <?php include_partial('adManageAdvertise/list_image', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'ad_advertise' => $ad_advertise)) ?>
                    <?php endif; ?>
                    <div>
                        <?php include_partial('adManageAdvertise/list_batch_actions_image', array('helper' => $helper)) ?>
                        <?php if($ad_advertise->amount > AdAdvertiseImageTable::getCountImage($ad_advertise->id)) :?>

                        <div class="well pull-left margin-right">
                            <div class="btn-group">
                                <a class="btn btn-success" href="<?php echo url_for('@ad_advertise_image_new')?>">
                                    <i class="icon-plus icon-white"></i>
                                    <?php echo __('Tạo mới') ?>
                                </a>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </form>

                <form class="form-inline" method="get" action="<?php echo url_for('ad_advertise_edit',$ad_advertise) ?>">
                    <div class="well pull-right">
                        <?php echo __('Số bản ghi/trang: ')?>
                        <?php $select = new sfWidgetFormChoice(array(
                            'multiple' => false,
                            'expanded' => false,
                            'choices' => array('10' => __('10', null, 'tmcTwitterBootstrapPlugin'), 20 => 20, 30 => 30, 50 => 50, 100 => 100)
                        ),
                        array('class' => 'input-medium')); echo $select->render('max_per_page', $sf_user->getAttribute('vtManageAdvertiseImages.max_per_page', null, 'admin_module')) ?>
                        <input type="submit" class="btn btn-inverse btn-small" value="<?php echo __('Go', array(), 'tmcTwitterBootstrapPlugin') ?>" />
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
            <!-- End Edit hinh anh -->

            <div id="sf_admin_footer">
                <?php include_partial('adManageAdvertise/form_footer', array('ad_advertise' => $ad_advertise, 'form' => $form, 'configuration' => $configuration)) ?>
            </div>
        </div>
    </div>
</div>

<?php include_partial('adManageAdvertise/footer') ?>