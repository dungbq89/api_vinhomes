<?php use_helper('I18N', 'Date') ?>
<?php include_partial('adManageContact/assets') ?>
<?php include_partial('adManageContact/header') ?>



<div class="container-fluid">
    <div class="row-fluid">
        <?php if ($sidebar_status): ?>
            <?php include_partial('adManageContact/list_sidebar', array('configuration' => $configuration)) ?>
        <?php endif; ?>

        <div class="span<?php echo $sidebar_status ? '10' : '12'; ?>">

            <div class="span12">
                <h1 style="display: inline"><?php echo __('Quản lý trang liên hệ', array(), 'messages') ?></h1>
            </div>
            <?php 
            if($sf_user->hasFlash('error')){
                ?>
            <div class="alert alert-danger" style="clear: both;">
                <p><?php echo $sf_user->getFlash('error'); ?></p>
            </div>
                <?php
            }
        ?>
            
            <div class="row-fluid">
                <!--                <div class="span9">
                <?php include_partial('adManageContact/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
                                </div>-->
            </div>


            <?php
//            include_partial('adManageContact/flashes') 
            ?>

            <div id="sf_admin_header">
                <?php include_partial('adManageContact/list_header', array('pager' => $pager)) ?>
            </div>

            <div id="sf_admin_content">
                <form class="form-inline" id="list-form" action="<?php echo url_for('ad_contact_collection', array('action' => 'batch')) ?>" method="post">

                    <?php include_partial('adManageContact/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>

                    <!--                    <div>-->
<!--                        --><?php //include_partial('adManageContact/list_batch_actions', array('helper' => $helper)) ?>
                    <!--                    </div>-->
                    <?php if (count($pager->getResults()->getRawValue()->toArray()) == 0) { ?>
                        <div class="well pull-left margin-right">
                            <?php include_partial('adManageContact/list_actions', array('helper' => $helper)) ?>
                        </div>
                    <?php } ?>
                </form>

                <form class="form-inline" method="get" action="<?php echo url_for('ad_contact') ?>">
                    <div class="well pull-right">
                        <?php echo __('Số bản ghi/trang: ') ?>
                        <?php
                        $select = new sfWidgetFormChoice(array(
                            'multiple' => false,
                            'expanded' => false,
                            'choices' => array('10' => __('10', null, 'tmcTwitterBootstrapPlugin'), 20 => 20, 30 => 30, 50 => 50, 100 => 100)
                                ), array('class' => 'input-medium'));
                        echo $select->render('max_per_page', $sf_user->getAttribute('adManageContact.max_per_page', null, 'admin_module'))
                        ?>
                        <input type="submit" class="btn btn-inverse btn-small" value="<?php echo __('Go', array(), 'tmcTwitterBootstrapPlugin') ?>" />
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>

            <?php include_partial('adManageContact/list_footer', array('pager' => $pager)) ?>
        </div>
    </div>
</div>

<?php include_partial('adManageContact/footer') ?>