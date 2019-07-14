  
  <td class="sf_admin_text sf_admin_list_td_full_name" field="full_name"><?php echo  VtHelper::truncate($booking->getFullName(), 50, '...', true)  ?></td>      
  <td class="sf_admin_text sf_admin_list_td_phone" field="phone"><?php echo  VtHelper::truncate($booking->getPhone(), 50, '...', true)  ?></td>      
  <td class="sf_admin_text sf_admin_list_td_category_id" field="category_id">
      <?php
      $category = VtpProductsCategoryTable::getCategoryById($booking->getCategoryId());
      if($category){
          echo $category->getName();
      }
      ?>
  </td>
  <td class="sf_admin_text sf_admin_list_td_product_id" field="product_id">
      <?php
      $product = VtpProductsTable::getProductById($booking->getProductId());
      if($product){
        echo $product->getProductName();
      }
      ?>
  </td>
  <td class="sf_admin_text sf_admin_list_td_is_check" field="is_check">
      <?php
      if($booking->getIsCheck() == 1){
          echo 'Đang xử lý';
      }elseif($booking->getIsCheck() == 2){
          echo 'Đã xử lý';
      }else{
          echo 'Chưa xử lý';
      }
      ?>
  </td>