<td class="sf_admin_text sf_admin_list_td_file_path"
    field="file_path"><img src="<?php echo VtHelper::getUrlImagePathThumb(sfConfig::get('app_article_images'), $ad_massage_image->getFilePath()) ?>" width="50px; height=50px"/></td>
<td class="sf_admin_text sf_admin_list_td_massage_id"
    field="massage_id"><?php echo VtHelper::truncate($ad_massage_image->getMassageId(), 50, '...', true) ?></td>
<td class="sf_admin_text sf_admin_list_td_priority"
    field="priority"><?php echo VtHelper::truncate($ad_massage_image->getPriority(), 50, '...', true) ?></td>
<td class="sf_admin_boolean sf_admin_list_td_is_active"
    field="is_active"><?php echo get_partial('adMassageImage/list_field_boolean', array('value' => VtHelper::truncate($ad_massage_image->getIsActive(), 50, '...', true))) ?></td>