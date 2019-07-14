  
  <td class="sf_admin_text sf_admin_list_td_image_path" field="image_path">
      <?php echo get_partial('vtpCategory/image_path', array('type' => 'list', 'vtp_category' => $vtp_category)) ?>
  </td>
  
  <td class="sf_admin_text sf_admin_list_td_name" field="name">
      <?php echo link_to(VtHelper::truncate($vtp_category->getName(), 50, '...', true),'vtp_category_edit',$vtp_category)  ?></td>      
  <td class="sf_admin_text sf_admin_list_td_description" field="description"><?php echo  VtHelper::truncate($vtp_category->getDescription(), 50, '...', true)  ?></td>      
  <td class="sf_admin_boolean sf_admin_list_td_is_active" field="is_active" style="text-align: center"><?php echo get_partial('vtpCategory/list_field_boolean', array('value' =>  VtHelper::truncate($vtp_category->getIsActive(), 50, '...', true) )) ?></td>      
  <td class="sf_admin_text sf_admin_list_td_priority" field="priority" style="text-align: center"><?php echo  VtHelper::truncate($vtp_category->getPriority(), 50, '...', true)  ?></td>    