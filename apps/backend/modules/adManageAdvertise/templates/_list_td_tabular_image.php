<td class="sf_admin_text sf_admin_list_td_order_no" field="order_no"  style="text-align: center"><?php echo  $orderNo  ?></td>
  <td class="sf_admin_text sf_admin_list_td_file_path" field="file_path">
        <image src="<?php echo VtHelper::getUrlImagePathThumb(sfConfig::get('app_advertise_images'), $ad_advertise_image->getFilePath()) ?>" />
  </td>
  <td class="sf_admin_foreignkey sf_admin_list_td_crea_priority" field="priority" field="priority" style="text-align: center"><?php echo  $ad_advertise_image->getPriority();  ?></td>
  <td class="sf_admin_boolean sf_admin_list_td_is_active" field="is_active"  style="text-align: center"><?php echo get_partial('adManageAdvertiseImage/list_field_boolean', array('value' =>  VtHelper::truncate($ad_advertise_image->getIsActive(), 50, '...', true) )) ?></td>
  <td class="sf_admin_foreignkey sf_admin_list_td_crea_created_at" field="created_ated_by" field="created_by"><?php echo  VtHelper::truncate((strtotime($ad_advertise_image->getCreatedBy())), 50, '...', true)  ?></td>
  <td class="sf_admin_date sf_admin_list_tdt" style="text-align: center"><?php echo  VtHelper::truncate(VtHelper::reFormatDate($ad_advertise_image->getCreatedAt(), 'd/m/Y h:i:s'), 50, '...', true)  ?></td>
  
  <td class="sf_admin_text sf_admin_list_td_name" field="name" title="<?php echo __('Chỉnh sửa'); ?>">
      <?php echo link_to(__('Chỉnh sửa'),'ad_advertise_image_edit',$ad_advertise_image)  ?>
  </td>