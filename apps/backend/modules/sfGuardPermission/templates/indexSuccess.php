<?php use_helper('I18N', 'Date') ?>
<?php include_partial('sfGuardPermission/assets') ?>
<?php include_partial('sfGuardPermission/header') ?>



<div class="container-fluid">
    <div class="row-fluid">
        <?php if ($sidebar_status): ?>
            <?php include_partial('sfGuardPermission/list_sidebar', array('configuration' => $configuration)) ?>
        <?php endif; ?>

        <div class="span<?php echo $sidebar_status ? '10' : '12'; ?>">
            
            <div class="span12">
            <h1 style="display: inline"><?php echo __('Danh sách quyền hạn', array(), 'messages') ?></h1>
            </div>
            <div class="row-fluid">
              
                <div class="span3" style="width:100%">
                    
                </div>
            </div>
            

            <?php include_partial('sfGuardPermission/flashes') ?>
            
            <div id="sf_admin_header">
                <?php include_partial('sfGuardPermission/list_header', array('pager' => $pager)) ?>
            </div>

            <div id="sf_admin_content">
                                    <form class="form-inline" id="list-form" action="<?php echo url_for('sf_guard_permission_collection', array('action' => 'batch')) ?>" method="post">
                
                <?php include_partial('sfGuardPermission/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>

                <div>
                    <?php include_partial('sfGuardPermission/list_batch_actions', array('helper' => $helper)) ?>
                    <div class="well pull-left margin-right"><?php include_partial('sfGuardPermission/list_actions', array('helper' => $helper)) ?></div>
                </div>
                                    </form>
                
                <form class="form-inline" method="get" action="<?php echo url_for('sf_guard_permission') ?>">
                    <div class="well pull-right">
                      <?php echo __('Số bản ghi/trang: ')?>
                        <?php $select = new sfWidgetFormChoice(array(
                                        'multiple' => false,
                                        'expanded' => false,
                                        'choices' => array('10' => __('10', null, 'tmcTwitterBootstrapPlugin'), 20 => 20, 30 => 30, 50 => 50, 100 => 100)
                                    ),
                                    array('class' => 'input-medium')); echo $select->render('max_per_page', $sf_user->getAttribute('sfGuardPermission.max_per_page', null, 'admin_module')) ?>
                        <input type="submit" class="btn btn-inverse btn-small" value="<?php echo __('Go', array(), 'tmcTwitterBootstrapPlugin') ?>" />
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>

            <?php include_partial('sfGuardPermission/list_footer', array('pager' => $pager)) ?>
        </div>
    </div>
</div>

<?php include_partial('sfGuardPermission/footer') ?>