  
  <td class="sf_admin_text sf_admin_list_td_name" field="name" title="<?php echo $ad_advertise->getName(); ?>">
      <?php echo link_to(VtHelper::truncate($ad_advertise->getName(), 50, '...', true),'ad_advertise_edit',$ad_advertise)  ?></td>
  <td class="sf_admin_text sf_admin_list_td_view_type" field="view_type">
      <?php
      if($ad_advertise->getViewType()==0){
          echo __('Ảnh tĩnh');
      }
      if($ad_advertise->getViewType()==1){
          echo __('Slide show');
      }

      if($ad_advertise->getViewType()==2){
          echo __('Flash');
      }

    ?></td>
  <td class="sf_admin_text sf_admin_list_td_amount" field="amount" style="text-align: right"><?php echo  VtHelper::truncate($ad_advertise->getAmount(), 50, '...', true)  ?></td>
  <td class="sf_admin_text sf_admin_list_td_width" field="width"><?php echo  VtHelper::truncate($ad_advertise->getWidth(), 50, '...', true) . 'px'  ?></td>
  <td class="sf_admin_text sf_admin_list_td_height" field="height"><?php echo  VtHelper::truncate($ad_advertise->getHeight(), 50, '...', true) .'px'  ?></td>
  <td class="sf_admin_boolean sf_admin_list_td_is_active" field="is_active" style="text-align: center"><?php echo get_partial('adManageAdvertise/list_field_boolean', array('value' =>  VtHelper::truncate($ad_advertise->getIsActive(), 50, '...', true) )) ?></td>