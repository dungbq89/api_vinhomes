<td class="sf_admin_text sf_admin_list_td_title"
    field="title"><?php echo VtHelper::truncate($ad_order->getTitle(), 50, '...', true) ?></td>
<td class="sf_admin_text sf_admin_list_td_price"
    field="price">
    <?php echo number_format($ad_order->getPrice(),0,',','.').'đ'; ?>
</td>
<td class="sf_admin_text sf_admin_list_td_customer_name"
    field="customer_name"><?php echo VtHelper::truncate($ad_order->getCustomerName(), 50, '...', true) ?></td>
<td class="sf_admin_text sf_admin_list_td_customer_phone"
    field="customer_phone"><?php echo VtHelper::truncate($ad_order->getCustomerPhone(), 50, '...', true) ?></td>
<td class="sf_admin_text sf_admin_list_td_customer_address"
    field="customer_address"><?php echo VtHelper::truncate($ad_order->getCustomerAddress(), 50, '...', true) ?></td>
<td class="sf_admin_text sf_admin_list_td_status"
    field="status">
    <?php
        if($ad_order->getStatus() == 0){
           echo 'Chưa xử lý';
        }elseif($ad_order->getStatus() == 1){
            echo 'Đang xử lý';
        }else{
            echo 'Đã xử lý';
        }
    ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at"
    field="created_at"><?php echo VtHelper::truncate($ad_order->getCreatedAt(), 50, '...', true) ?></td>