  <td class="sf_admin_text sf_admin_list_td_orderno" field="image_path" style="text-align: center">
      <?php echo $orderNo ?>
  </td> 
  <td class="sf_admin_text sf_admin_list_td_name" field="name" title="<?php echo $sf_guard_permission->getName()?>">
      <?php if($sf_guard_permission->types){
        echo link_to( VtHelper::truncate($sf_guard_permission->getName(), 50, '...', true) , 'sf_guard_permission_edit', $sf_guard_permission);
      }else{
          echo VtHelper::truncate($sf_guard_permission->getName(), 50, '...', true);
      }        
      ?>
  </td>      
  <td class="sf_admin_text sf_admin_list_td_description" field="description" title="<?php echo $sf_guard_permission->getDescription();?>"> <?php echo  VtHelper::truncate($sf_guard_permission->getDescription(), 50, '...', true)  ?></td>
  <td class="sf_admin_date sf_admin_list_td_created_at" field="created_at" style="text-align: center"><?php echo  VtHelper::truncate(VtHelper::reFormatDate($sf_guard_permission->getCreatedAt(), 'd/m/Y h:i:s'), 50, '...', true)  ?></td>
  <td class="sf_admin_date sf_admin_list_td_updated_at" field="updated_at" style="text-align: center"><?php echo  VtHelper::truncate(VtHelper::reFormatDate($sf_guard_permission->getUpdatedAt(), 'd/m/Y h:i:s'), 50, '...', true)  ?></td>