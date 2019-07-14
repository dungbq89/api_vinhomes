<?php use_helper('I18N', 'Date') ?>
<?php include_partial('adAlbum/assets') ?>
<?php include_partial('adAlbum/header') ?>

<div class="container-fluid">
    <div class="row-fluid">
        <?php if ($sidebar_status): ?>
            <?php include_partial('adAlbum/edit_sidebar', array('configuration' => $configuration, 'ad_album' => $ad_album)) ?>
        <?php endif; ?>

        <div class="span<?php echo $sidebar_status ? '10' : '12'; ?>">
            <h1><?php echo __('Chỉnh sửa Album', array(), 'messages') ?></h1>

            <?php include_partial('adAlbum/flashes') ?>

            <div id="sf_admin_header">
                <?php include_partial('adAlbum/form_header', array('ad_album' => $ad_album, 'form' => $form, 'configuration' => $configuration)) ?>
            </div>

            <div id="sf_admin_content">
                <?php include_partial('adAlbum/form', array('ad_album' => $ad_album, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>

                <?php if (in_array('version', $fields->getRawValue())): ?>
                    <?php include_partial('versions', array('ad_album' => $ad_album->getRawValue(), 'fields' => $fields)); ?>
                <?php endif; ?>
            </div>

            <!-- Danh sach photo cua album -->
            <div class="sf_admin_header_help_center ">
                <h1><?php echo __('Danh sách photo') ?></h1>
            </div>
            <?php include_partial('adPhoto/flashes') ?>
            
            <div id="sf_admin_content">
                <form class="form-inline" id="list-form" action="<?php echo url_for('ad_photo', array('action' => 'batch')) ?>" method="post">
                
                <?php 
                if(isset($pager)&& isset($sort)){
                    include_partial('adAlbum/list_detail', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper,'ad_album' => $ad_album));
                }
                 ?>

                <div>
                    <?php include_partial('adPhoto/list_batch_actions', array('helper' => $helper,'edit'=>'0')) ?>
                    <div class="well pull-left margin-right">
                        <div class="btn-group">
                            <a class="btn btn-success" href="<?php echo url_for('ad_photo_new',array('default_album_id' => $ad_album->getPrimaryKey())) ?>">
                            <i class="icon-plus icon-white"></i>
                               <?php echo __('Tạo mới') ?>
                            </a>
                        </div>
                    </div>

                </div>
                </form>
                
                <form class="form-inline" method="get" action="<?php echo url_for('ad_album_edit',$ad_album) ?>">
                    <div class="well pull-right">
                      <?php echo __('Số bản ghi/trang: ')?>
                        <?php $select = new sfWidgetFormChoice(array(
                                        'multiple' => false,
                                        'expanded' => false,
                                        'choices' => array('10' => __('10', null, 'tmcTwitterBootstrapPlugin'), 20 => 20, 30 => 30, 50 => 50, 100 => 100)
                                    ),
                                    array('class' => 'input-medium')); echo $select->render('max_per_page', $sf_user->getAttribute('adPhoto.max_per_page', null, 'admin_module')) ?>
                        <input type="submit" class="btn btn-inverse btn-small" value="<?php echo __('Go', array(), 'tmcTwitterBootstrapPlugin') ?>" />
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
            <!-- Ket thuc photo cua album -->
            
            <div id="sf_admin_footer">
                <?php include_partial('adAlbum/form_footer', array('ad_album' => $ad_album, 'form' => $form, 'configuration' => $configuration)) ?>
            </div>
        </div>
    </div>
</div>

<?php include_partial('adAlbum/footer') ?>