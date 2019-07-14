<div class="btn-toolbar">
                        <?php if ($form->isNew()): ?>
        
                        <?php 
                            $sf_request=  sfContext::getInstance()->getRequest();
                            
                        ?>  
                    <div class="btn-group">
                        <a class="btn" href="#" id="back-history"><i class="icon-arrow-left icon-black"></i>Quay lại danh sách</a>
                    </div>
                    <div class="btn-group">
                        <?php 
                        if ($sf_request->hasParameter('default_product_id')){
                            echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',));
                        }
                        else echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',));
                                ?>                                                                                        
                            <?php echo $helper->linkToSaveAndAdd($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save_and_add',  'label' => 'Save and add','default_product_id'=>$sf_request->getParameter('default_product_id'))) ?>                                                
                    </div>
        
                    <div class="btn-group">
                                                
                        <?php echo $helper->linkToDelete($form->getObject(), array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>                                        
                    </div>
        
                        <?php else: ?>
        
        
                    <div class="btn-group">
                    <?php if ($sf_request->hasParameter('default_product_id')) : ?>
                        <?php echo '<div class="btn-group">' . link_to('<i class="icon-arrow-left icon-black"></i>' . __('Quay lại danh sách'), 'vtp_products_edit', array('id'=>$sf_request->getParameter('default_product_id')), array('class' => 'btn')) .'</div>' ?>
                    <?php else : ?>
                        <?php echo $helper->linkToList(array(  'params' =>   array(  ),  'class_suffix' => 'list',  'label' => 'Back to list',)) ?>
                    <?php endif; ?>
                    </div>
                    
                    <div class="btn-group">
                                    <?php 
                                    if ($sf_request->hasParameter('default_product_id')){
                                        echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save','default_product_id'=>$sf_request->getParameter('default_product_id')));
                                        echo $helper->linkToSaveAndAdd($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save_and_add',  'label' => 'Save and add','default_product_id'=>$sf_request->getParameter('default_product_id')));
                                    }
                                    else{
                                        echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',)); 
                                        echo $helper->linkToSaveAndAdd($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save_and_add',  'label' => 'Save and add',));
                                    }
                                    
                                    ?>        
                    </div>
        
                    <div class="btn-group">
                                                <?php echo $helper->linkToDelete($form->getObject(), array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>                                        </div>
        
                <?php endif; ?>
</div>
<script>
    $('#back-history').click(function(e) {
        product_id = $('#vtp_product_image_product_id').val();
        location.href ='<?php echo url_for("@vtp_products" ) ?>' + '/' + product_id + '/edit';
    })
</script>
