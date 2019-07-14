  
  <td class="sf_admin_text sf_admin_list_td_name" field="name">
      <?php echo link_to(VtHelper::truncate($ad_video->getName(), 50, '...', true),'ad_video_edit',$ad_video) ?>
  </td>
  <td class="sf_admin_date sf_admin_list_td_event_date" field="event_date" style="text-align: center"><?php echo  VtHelper::truncate($ad_video->getEventDate(), 50, '...', true)  ?></td>
  <td class="sf_admin_text sf_admin_list_td_extension" field="extension"><?php echo  VtHelper::truncate($ad_video->getExtension(), 50, '...', true)  ?></td>
  <td class="sf_admin_text sf_admin_list_td_priority" field="priority" style="text-align: right"><?php echo  VtHelper::truncate($ad_video->getPriority(), 50, '...', true)  ?></td>
  <td class="sf_admin_boolean sf_admin_list_td_is_active" field="is_active" style="text-align: center"><?php echo get_partial('adVideo/list_field_boolean', array('value' =>  VtHelper::truncate($ad_video->getIsActive(), 50, '...', true) )) ?></td>