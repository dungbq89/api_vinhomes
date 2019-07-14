  
  <td class="sf_admin_text sf_admin_list_td_file_path" field="file_path">
      <?php echo get_partial('vtpManageProductImage/image_path', array('type' => 'list', 'vtp_product_image' => $vtp_product_image)) ?>
  </td>      
  <td class="sf_admin_foreignkey sf_admin_list_td_product_id" field="product_id">
      <?php echo  VtHelper::truncate(VtpProductsTable::getProductById($vtp_product_image->getProductId())->getProductName(), 50, '...', true)  ?>
  </td>      
  <td class="sf_admin_text sf_admin_list_td_priority" field="priority"><?php echo  VtHelper::truncate($vtp_product_image->getPriority(), 50, '...', true)  ?></td>