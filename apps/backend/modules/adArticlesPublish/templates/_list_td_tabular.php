  <td class="sf_admin_text sf_admin_list_td_orderno" field="image_path" style="text-align: center">
      <?php echo $orderNo ?>
  </td>   
  <td class="sf_admin_text sf_admin_list_td_image_path" field="image_path">
      <image src="<?php echo VtHelper::getUrlImagePathThumb(sfConfig::get('app_article_images'), $ad_article->getImagePath()) ?>" />
      </td>      
  <td class="sf_admin_text sf_admin_list_td_title" field="title" title="<?php echo  $ad_article->getTitle()  ?>">
      <?php echo link_to(VtHelper::truncate($ad_article->getTitle(), 50, '...', true), 'ad_article_edit', $ad_article) ?>
  </td>      
  <td class="sf_admin_boolean sf_admin_list_td_is_hot" field="is_hot" style="text-align: center"><?php echo get_partial('adArticlesPublish/list_field_boolean', array('value' =>  VtHelper::truncate($ad_article->getIsHot(), 50, '...', true) )) ?></td>
  <td class="sf_admin_text sf_admin_list_td_priority" field="priority" style="text-align: center"><?php echo  VtHelper::truncate($ad_article->getPriority(), 50, '...', true)  ?></td>      
  
  <td class="sf_admin_text sf_admin_list_td_is_active" field="is_active" style="text-align: center">
      <?php  
            if($ad_article->getIsActive()=='0'){
                echo __('Đợi duyệt');
            }
            if($ad_article->getIsActive()=='1'){
                echo __('Đã duyệt');
            }
            if($ad_article->getIsActive()=='2'){
                echo __('Đã đăng');
            }
      ?>
  </td>    
  <td class="sf_admin_foreignkey sf_admin_list_td_created_by" field="created_by"><?php echo  VtHelper::truncate($ad_article->getUpdatedBy(), 50, '...', true)  ?></td>
  <td class="sf_admin_foreignkey sf_admin_list_td_update_at" field="published_time" style="text-align: center; white-space: nowrap"><?php echo  date('d-m-Y H:i:s',  strtotime($ad_article->published_time))  ?></td>