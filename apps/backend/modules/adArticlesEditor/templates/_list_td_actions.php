<td nowrap="nowrap">
    <div class="btn-group">
        <?php echo $helper->linkToEdit($ad_article, array(  'label' => __('Chi tiết'),  'params' =>   array(  ),  'class_suffix' => 'edit',)) ?>
        <?php $user = sfContext::getInstance()->getUser(); if(sfContext::getInstance()->getUser()->hasCredential('admin') || $ad_article->created_by==$user->getGuardUser()->getId()): ?>
            <?php echo $helper->linkToDelete($ad_article, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
        <?php endif; ?>
    </div>
</td>