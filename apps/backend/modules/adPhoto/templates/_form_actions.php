<div class="btn-toolbar">
                        <?php if ($form->isNew()): ?>
        
                        <?php 
                            $sf_request=  sfContext::getInstance()->getRequest();
                        ?>  
                    <div class="btn-group">
                    <?php // echo $helper->linkToList(array(  'params' =>   array(  ),  'class_suffix' => 'list',  'label' => 'Back to list',)) ?>            
                    <?php if ($sf_request->hasParameter('default_album_id')) : ?>
                        <?php echo '<div class="btn-group">' . link_to('<i class="icon-arrow-left icon-black"></i>' . __('Quay lại danh sách'), 'ad_photo', array('default_album_id'=>$sf_request->getParameter('default_album_id')), array('class' => 'btn')) .'</div>' ?>
                    <?php else : ?>
                        <?php echo $helper->linkToList(array(  'params' =>   array(  ),  'class_suffix' => 'list',  'label' => 'Back to list',)) ?>
                    <?php endif; ?>
                    </div>
                    
                    <div class="btn-group">
                        <?php 
                        if ($sf_request->hasParameter('default_album_id')){
                            echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',));
                        }
                        else echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',));
                                ?>                                                                                        
                    </div>
        
                    <div class="btn-group">
                                                
                        <?php echo $helper->linkToDelete($form->getObject(), array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>                                        
                    </div>
        
                        <?php else: ?>
        
        
                    <div class="btn-group">
                    <?php if ($sf_request->hasParameter('default_album_id')) : ?>
                        <?php echo '<div class="btn-group">' . link_to('<i class="icon-arrow-left icon-black"></i>' . __('Quay lại danh sách'), 'ad_album_edit', array('id'=>$sf_request->getParameter('default_album_id')), array('class' => 'btn')) .'</div>' ?>
                    <?php else : ?>
                        <?php echo $helper->linkToList(array(  'params' =>   array(  ),  'class_suffix' => 'list',  'label' => 'Back to list',)) ?>
                    <?php endif; ?>
                    </div>
                    
                    <div class="btn-group">
                                    <?php 
                                    if ($sf_request->hasParameter('default_album_id')){
                                        echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save','default_album_id'=>$sf_request->getParameter('default_album_id')));
                                        echo $helper->linkToSaveAndAdd($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save_and_add',  'label' => 'Save and add','default_album_id'=>$sf_request->getParameter('default_album_id')));
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