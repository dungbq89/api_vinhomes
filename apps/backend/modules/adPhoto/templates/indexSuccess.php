<?php use_helper('I18N', 'Date') ?>
<?php include_partial('adPhoto/assets') ?>
<?php include_partial('adPhoto/header') ?>



<div class="container-fluid">
    <div class="row-fluid">
        <?php if ($sidebar_status): ?>
            <?php include_partial('adPhoto/list_sidebar', array('configuration' => $configuration)) ?>
        <?php endif; ?>

        <div class="span<?php echo $sidebar_status ? '10' : '12'; ?>">
            
            <div class="span12">
            <h1 style="display: inline"><?php echo __('Danh sách ảnh', array(), 'messages') ?></h1>
            </div>
            <div class="row-fluid">
                <div class="span9" style="width: 100%;">
                    <?php  
                        $request=  sfContext::getInstance()->getRequest();
                        if($request->hasParameter('default_album_id'))
                        {
                            include_partial('adPhoto/viewALbum', array('ad_album' => $ad_album)); 
                        }
                    ?>
                </div>
                <div class="span3">
                    
                </div>
            </div>
            

            <?php include_partial('adPhoto/flashes') ?>
            
            <div id="sf_admin_header">
                <?php include_partial('adPhoto/list_header', array('pager' => $pager)) ?>
            </div>

            <div id="sf_admin_content">
                                    <form class="form-inline" id="list-form" action="<?php echo url_for('ad_photo_collection', array('action' => 'batch')) ?>" method="post">
                
                <?php include_partial('adPhoto/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>

                <div>
                        <?php 
                            if($request->hasParameter('default_album_id')){
                                ?>
                                <div class="well pull-left margin-right">
                                    <div class="btn-group">
                                        <a class="btn btn-success" href="<?php echo url_for('ad_photo_new',array('default_album_id' => $ad_album->getId())) ?>">
                                        <i class="icon-plus icon-white"></i>
                                           <?php echo __('Tạo mới') ?>
                                        </a>
                                    </div>
                                </div>
                                <?php
                            }
                            else{
                                ?>
                                <div class="well pull-left margin-right"><?php include_partial('adPhoto/list_actions', array('helper' => $helper)) ?></div>
                        <?php
                            }
                        ?>
                    <?php include_partial('adPhoto/list_batch_actions', array('helper' => $helper)) ?>
                </div>
                                    </form>
                
                <form class="form-inline" method="get" action="<?php echo url_for('ad_photo');?>">
                    <div class="well pull-right">
                      <?php echo __('Số bản ghi/trang: ')?>
                        <?php $select = new sfWidgetFormChoice(array(
                                        'multiple' => false,
                                        'expanded' => false,
                                        'choices' => array('10' => __('10', null, 'tmcTwitterBootstrapPlugin'), 20 => 20, 30 => 30, 50 => 50, 100 => 100)
                                    ),
                                    array('class' => 'input-medium')); 
                        if($request->hasParameter('default_album_id'))
                        {
                            echo $select->render('max_per_page', $sf_user->getAttribute('adPhoto.max_per_page', null, 'admin_module',array('default_album_id'=>$request->getParameter('default_album_id'))));
                        }
                        else{
                            echo $select->render('max_per_page', $sf_user->getAttribute('adPhoto.max_per_page', null, 'admin_module'));
                        }
                         ?>
                        <input type="submit" class="btn btn-inverse btn-small" value="<?php echo __('Go', array(), 'tmcTwitterBootstrapPlugin') ?>" />
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>

            <?php
                    include_partial('adPhoto/list_footer', array('pager' => $pager));
            ?>
        </div>
    </div>
</div>

<?php include_partial('adPhoto/footer') ?>