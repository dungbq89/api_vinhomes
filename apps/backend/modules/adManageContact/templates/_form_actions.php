<div class="btn-toolbar">

    <?php if ($form->isNew()): ?>


        <div class="btn-group">
            <?php echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>            </div>

        <div class="btn-group">
            <input class="btn btn-primary" value="<?php echo __("Lưu")?>" name="_save_new" type="submit"> </div>
            <div class="btn-group">
                <?php echo $helper->linkToDelete($form->getObject(), array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>                                        </div>

        <?php else: ?>


            <div class="btn-group">
                <?php echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>            </div>

            <div class="btn-group">
                <?php echo $helper->linkToSave($form->getObject(), array('params' => array(), 'class_suffix' => 'save', 'label' => 'Save',)) ?>                                                                                        <?php echo $helper->linkToSaveAndAdd($form->getObject(), array('params' => array(), 'class_suffix' => 'save_and_add', 'label' => 'Save and add',)) ?>                                                </div>

            <div class="btn-group">
                <?php echo $helper->linkToDelete($form->getObject(), array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>                                        </div>

        <?php endif; ?>
    </div>