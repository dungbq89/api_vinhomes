  
  <td class="sf_admin_text sf_admin_list_td_name" field="name" title="<?php echo $ad_html->getName(); ?>">
      <?php echo link_to(VtHelper::truncate($ad_html->getName(), 50, '...', true),'ad_html_edit',$ad_html)  ?></td>
  <td class="sf_admin_text sf_admin_list_td_slug" field="slug" title="<?php echo $ad_html->getSlug(); ?>">
      <?php echo link_to(VtHelper::truncate($ad_html->getSlug(), 50, '...', true),'ad_html_edit',$ad_html)  ?></td>
  <td class="sf_admin_boolean sf_admin_list_td_is_active" field="is_active" style="text-align: center"><?php echo get_partial('adManageHtml/list_field_boolean', array('value' =>  VtHelper::truncate($ad_html->getIsActive(), 50, '...', true) )) ?></td>
  <td class="sf_admin_date sf_admin_list_td_created_at" field="created_at" style="text-align: center"><?php echo  VtHelper::truncate(VtHelper::reFormatDate($ad_html->getCreatedAt(), 'd/m/Y h:i:s'), 50, '...', true)  ?></td>
  <td class="sf_admin_foreignkey sf_admin_list_td_created_by" field="created_by">
      <?php echo  VtHelper::truncate($ad_html->getCreatedBy(), 50, '...', true)  ?></td>    