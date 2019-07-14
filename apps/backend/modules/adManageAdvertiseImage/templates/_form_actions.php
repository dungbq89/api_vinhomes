<div class="btn-toolbar">
                        <?php if ($form->isNew()): ?>
        
        
                    <div class="btn-group">
                        <a class="btn" href="<?php echo url_for('ad_advertise_edit', $advertise) ?>"><i class="icon-arrow-left icon-black"></i>

                            <?php echo __('Quay lại') ?>
                        </a>
                    </div>
                    
                    <div class="btn-group">
                                    <?php echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',)) ?>                                                                                        <?php echo $helper->linkToSaveAndAdd($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save_and_add',  'label' => 'Save and add',)) ?>                                                </div>
        
                    <div class="btn-group">
                                                <?php echo $helper->linkToDelete($form->getObject(), array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>                                        </div>
        
                        <?php else: ?>
        
        
                    <div class="btn-group">
                        <a class="btn" href="<?php echo url_for('ad_advertise_edit', $advertise) ?>"><i class="icon-arrow-left icon-black"></i>

                            <?php echo __('Quay lại') ?>
                        </a>
                    </div>
                    
                    <div class="btn-group">
                                    <?php echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',)) ?>                                                                                        <?php echo $helper->linkToSaveAndAdd($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save_and_add',  'label' => 'Save and add',)) ?>                                                </div>
        
                    <div class="btn-group">
                                                <?php echo $helper->linkToDelete($form->getObject(), array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>                                        </div>
        
                <?php endif; ?>
</div>