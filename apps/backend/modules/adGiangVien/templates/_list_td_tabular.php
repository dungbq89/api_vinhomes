<td class="sf_admin_text sf_admin_list_td_image" field="image">
    <img width="50px" src="<?php echo VtHelper::getUrlImagePathThumb(sfConfig::get('app_article_images'), $ad_giang_vien->getImage()) ?>" />
</td>
<td class="sf_admin_text sf_admin_list_td_name"
    field="name"><?php echo VtHelper::truncate($ad_giang_vien->getName(), 50, '...', true) ?></td>
<td class="sf_admin_text sf_admin_list_td_priority"
    field="priority"><?php echo VtHelper::truncate($ad_giang_vien->getPriority(), 50, '...', true) ?></td>
<td class="sf_admin_boolean sf_admin_list_td_is_active"
    field="is_active"><?php echo get_partial('adGiangVien/list_field_boolean', array('value' => VtHelper::truncate($ad_giang_vien->getIsActive(), 50, '...', true))) ?></td>