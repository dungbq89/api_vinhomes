  
  <td class="sf_admin_text sf_admin_list_td_name" field="name">
      <?php echo  link_to(VtHelper::truncate($ad_album->getName(), 50, '...', true),'ad_album_edit',$ad_album)  ?>
  </td>      
  <td class="sf_admin_text sf_admin_list_td_priority" field="priority" style="text-align: center;"><?php echo  VtHelper::truncate($ad_album->getPriority(), 50, '...', true)  ?></td>
  <td class="sf_admin_boolean sf_admin_list_td_is_active" field="is_active" style="text-align: center;"><?php echo get_partial('adAlbum/list_field_boolean', array('value' =>  VtHelper::truncate($ad_album->getIsActive(), 50, '...', true) )) ?></td>    