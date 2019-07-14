<?php use_helper('I18N', 'Date') ?>
<?php include_partial('adManagePersonal/assets') ?>
<?php include_partial('adManagePersonal/header') ?>



<div class="container-fluid">
    <div class="row-fluid">
        <?php if ($sidebar_status): ?>
            <?php include_partial('adManagePersonal/list_sidebar', array('configuration' => $configuration)) ?>
        <?php endif; ?>

        <div class="span<?php echo $sidebar_status ? '10' : '12'; ?>">
            
            <div class="span12">
            <h1 style="display: inline"><?php echo __('Danh sách hội viên', array(), 'messages') ?></h1>
            </div>
            <div class="row-fluid">
                <div class="span9">
                                  <?php include_partial('adManagePersonal/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
                                </div>
                <div class="span3">
                    <div class="pull-right"></div>
                </div>
            </div>
            

            <?php include_partial('adManagePersonal/flashes') ?>
            
            <div id="sf_admin_header">
                <?php include_partial('adManagePersonal/list_header', array('pager' => $pager)) ?>
            </div>

            <div id="sf_admin_content">
                                    <form class="form-inline" id="list-form" action="<?php echo url_for('ad_personal_collection', array('action' => 'batch')) ?>" method="post">
                
                <?php include_partial('adManagePersonal/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>

                <div>
                    <?php include_partial('adManagePersonal/list_batch_actions', array('helper' => $helper)) ?>
                    <div class="well pull-left margin-right"><?php include_partial('adManagePersonal/list_actions', array('helper' => $helper)) ?></div>
                    <div class="well pull-left margin-right">
                        <div class="btn-group">
                            <a class="btn btn-success" href="adManagePersonal/import">
                                <i class="icon-plus icon-white"></i>
                                <?php echo __('Import data') ?>
                            </a>
                        </div>
                    </div>

                    <div class="well pull-left margin-right">
                        <div class="btn-group">
                            <div class="btn-group">
                                <input class="btn btn-success" type="submit" name="_export" value="<?php echo __('Export data') ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                                    </form>
                
                <form class="form-inline" method="get" action="<?php echo url_for('ad_personal') ?>">
                    <div class="well pull-right">
                      <?php echo __('Số bản ghi/trang: ')?>
                        <?php $select = new sfWidgetFormChoice(array(
                                        'multiple' => false,
                                        'expanded' => false,
                                        'choices' => array('10' => __('10', null, 'tmcTwitterBootstrapPlugin'), 20 => 20, 30 => 30, 50 => 50, 100 => 100)
                                    ),
                                    array('class' => 'input-medium')); echo $select->render('max_per_page', $sf_user->getAttribute('adManagePersonal.max_per_page', null, 'admin_module')) ?>
                        <input type="submit" class="btn btn-inverse btn-small" value="<?php echo __('Go', array(), 'tmcTwitterBootstrapPlugin') ?>" />
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>

            <?php include_partial('adManagePersonal/list_footer', array('pager' => $pager)) ?>
        </div>
    </div>
</div>

<?php include_partial('adManagePersonal/footer') ?>