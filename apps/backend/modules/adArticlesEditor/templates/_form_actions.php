<div class="btn-toolbar">
  <?php if ($form->isNew()): ?>
     <div class="btn-group">
         <?php echo $helper->linkToList(array(  'params' =>   array(  ),  'class_suffix' => 'list',  'label' => 'Back to list',)) ?>            
     </div>
                    
     <div class="btn-group">
         <?php echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',)) ?>                                                                                        
         <?php echo $helper->linkToSaveAndAdd($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save_and_add',  'label' => 'Save and add',)) ?>                                                
     </div>
        
     <div class="btn-group">                               
         <?php echo $helper->linkToDelete($form->getObject(), array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>                                        
     </div>
        
  <?php else: ?>
    
    <?php 
        $i18n = sfContext::getInstance()->getI18N();
        $user = sfContext::getInstance()->getUser();
        $id = $user->getGuardUser()->getId();
        $articleStatus = $user->getAttribute('article_status');
            
        //Check trang thai trang chinh sua dich vu vao tu man hinh danh sach dich vu doi duyet
        ?>
        <div class="btn-group">
            <?php 
                if($articleStatus==1){
                    echo '<a class="btn" href="'.  url_for("@ad_article_adArticlesAproved").'"><i class="icon-arrow-left icon-black"></i> '.$i18n->__("Quay lại danh sách").'</a>';
                }
                else if($articleStatus==2){
                    echo '<a class="btn" href="'.  url_for("@ad_article_adArticlesPublish").'"><i class="icon-arrow-left icon-black"></i> '.$i18n->__("Quay lại danh sách").'</a>';
                }
                else{
                    echo '<a class="btn" href="'.  url_for("@ad_article").'"><i class="icon-arrow-left icon-black"></i> '.$i18n->__("Quay lại danh sách").'</a>';
                }
                
            ?>
        </div>
        <?php
        if($ad_article->getIsActive()== -1 || $ad_article->getIsActive()== 0){
            //Neu la Admin va Editor thi quay lai trang danh sach dich vu cho duyet
            if($user->isSuperAdmin() || $user->hasCredential('admin') || $user->hasCredential('news_editor')){
                ?>
                <div class="btn-group">
                    <?php echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',)) ?>                                                                                        
                </div>

                <div class="btn-group">
                    <?php echo $helper->linkToDelete($form->getObject(), array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>                                        
                </div>
                <?php
            }
            //Neu la Approved thi hien thi trang danh sach dich vu da duyet
            else if($user->hasCredential('news_approved')){
                ?>
                
                <div class="btn-group">
                    <?php echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',)) ?>                                                                                        
                </div>
                <?php
            }
            //Neu la Public thi hien thi trang danh sach dich vu da dang
            else if($user->hasCredential('news_public')){
                ?>
                <div class="btn-group">
                    <?php echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',)) ?>                                                                                        
                </div>
                <?php
            }
        }
        //Check trang thai trang chinh sua dich vu vao tu man hinh danh sach dich vu da duyet
        else if($ad_article->getIsActive()==1){
            //Neu la Admin hoac super admin thi quay lai trang danh sach dich vu cho duyet
            if($user->isSuperAdmin() || $user->hasCredential('admin')){
                ?>

                <div class="btn-group">
                    <?php echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',)) ?>                                                                                        
                </div>

                <div class="btn-group">
                    <?php echo $helper->linkToDelete($form->getObject(), array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>                                        
                </div>
                <?php
            }
            //Neu la Approved thi hien thi trang danh sach dich vu da duyet
            else if($user->hasCredential('news_approved')){
                ?>
                <div class="btn-group">
                    <?php echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',)) ?>                                                                                        
                </div>
                <?php
            }
            //Neu la Public thi hien thi trang danh sach dich vu da dang
            else if($user->hasCredential('news_public')){
                ?>
                <div class="btn-group">
                    <?php echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',)) ?>                                                                                        
                </div>
                <?php
            }
        }
        //Check trang thai trang chinh sua dich vu vao tu man hinh danh sach dich vu da dang
        else if($ad_article->getIsActive()==2){
            //Neu la Admin hoac super admin thi quay lai trang danh sach dich vu cho duyet
            if($user->isSuperAdmin() || $user->hasCredential('admin')){
                ?>
                <div class="btn-group">
                    <?php echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',)) ?>                                                                                        
                </div>

                <div class="btn-group">
                    <?php echo $helper->linkToDelete($form->getObject(), array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>                                        
                </div>
                <?php
            }

            //Neu la Public thi hien thi trang danh sach dich vu da dang
            else if($user->hasCredential('news_public')){
                ?>
                <div class="btn-group">
                    <?php echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',)) ?>                                                                                        
                </div>
                <?php
            }
        }
    ?>
    
    
        
   <?php endif; ?>
</div>