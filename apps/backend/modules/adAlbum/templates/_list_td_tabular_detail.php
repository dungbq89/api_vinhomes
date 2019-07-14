<?php 
    $request=  sfContext::getInstance()->getRequest();
?>
  <td class="sf_admin_text sf_admin_list_td_name" field="name">
      <?php 
            echo  link_to(VtHelper::truncate($ad_photo->getName(), 50, '...', true),'ad_photo_edit',array('id'=>$ad_photo->getId(),'default_album_id'=>$ad_album->getId()));
      ?>
  </td>      
  <td class="sf_admin_text sf_admin_list_td_file_path" field="file_path" style="text-align: center;">
      <?php  echo '<img align="middle" src="' . VtHelper::getUrlImagePathThumb(sfConfig::get('app_album_images'), $ad_photo->getFilePath()) . '"/>';?>
  </td>      
  <td class="sf_admin_foreignkey sf_admin_list_td_album_id" field="album_id"><?php echo  VtHelper::truncate(adAlbumTable::getALbumById($ad_photo->getAlbumId())->getName(), 50, '...', true)  ?></td>      
  <td class="sf_admin_text sf_admin_list_td_priority" field="priority" style="text-align: center;"><?php echo  VtHelper::truncate($ad_photo->getPriority(), 50, '...', true)  ?></td>      
  <td class="sf_admin_boolean sf_admin_list_td_is_active" field="is_active" style="text-align: center;"><?php echo get_partial('adPhoto/list_field_boolean', array('value' =>  VtHelper::truncate($ad_photo->getIsActive(), 50, '...', true) )) ?></td>