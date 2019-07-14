  
  <td class="sf_admin_text sf_admin_list_td_image_path" field="image_path">
      <?php  echo '<img align="middle"  style="height: 50px; width: 50px" src="' . VtHelper::getUrlImagePathThumb(sfConfig::get('app_product_images'), $vtp_products->getImagePath()) . '"/>';?>
  </td>
  <td class="sf_admin_text sf_admin_list_td_product_name" field="product_name" title="<?php echo  $vtp_products->getProductName()  ?>">
      <?php echo  link_to(VtHelper::truncate($vtp_products->getProductName(), 50, '...', true),'vtp_products_edit',$vtp_products)  ?>
  </td>
  <td class="sf_admin_text sf_admin_list_td_price" field="price" style="text-align: right"><?php echo  VtHelper::truncate(number_format($vtp_products->getPrice(),0,",","."), 50, '...', true)." VNĐ"  ?></td>
  <td class="sf_admin_text sf_admin_list_td_priority" field="priority" style="text-align: center"><?php echo  VtHelper::truncate($vtp_products->getPriority(), 50, '...', true)  ?></td>
  <td class="sf_admin_text sf_admin_list_td_link" field="link" title="<?php echo $vtp_products->getLink(); ?>"><?php echo  $vtp_products->getLink()  ?></td>