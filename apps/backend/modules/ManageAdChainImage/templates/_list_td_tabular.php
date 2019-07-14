  
  <td class="sf_admin_text sf_admin_list_td_file_path" field="file_path"><img src="<?php echo  VtHelper::getUrlImagePathThumb(sfConfig::get('app_ManageAdChainImage_prefix', 'chain'), $ad_chain_image->getFilePath());  ?>"></td>
  <td class="sf_admin_text sf_admin_list_td_product" field="product"><?php echo  VtHelper::truncate($ad_chain_image->getProduct(), 50, '...', true)  ?></td>      
  <td class="sf_admin_boolean sf_admin_list_td_is_active" field="is_active"><?php echo get_partial('ManageAdChainImage/list_field_boolean', array('value' =>  VtHelper::truncate($ad_chain_image->getIsActive(), 50, '...', true) )) ?></td>      
  <td class="sf_admin_text sf_admin_list_td_priority" field="priority"><?php echo  VtHelper::truncate($ad_chain_image->getPriority(), 50, '...', true)  ?></td>    