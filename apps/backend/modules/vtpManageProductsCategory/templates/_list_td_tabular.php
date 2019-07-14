<td class="sf_admin_text sf_admin_list_td_name"
    field="name"><?php echo VtHelper::truncate($vtp_products_category->getName(), 50, '...', true) ?></td>
<td class="sf_admin_text sf_admin_list_td_image_path"
    field="image_path">
    <?php  echo '<img align="middle"  style="height: 50px; width: 50px" src="' . VtHelper::getUrlImagePathThumb(sfConfig::get('app_category_images'), $vtp_products_category->getImagePath()) . '"/>';?>
</td>
<td class="sf_admin_text sf_admin_list_td_parent_id"
    field="parent_id"><?php echo VtHelper::truncate($vtp_products_category->getParentId(), 50, '...', true) ?></td>
<td class="sf_admin_text sf_admin_list_td_priotity"
    field="priotity"><?php echo VtHelper::truncate($vtp_products_category->getPriority(), 50, '...', true) ?></td>
<td class="sf_admin_boolean sf_admin_list_td_is_active"
    field="is_active"><?php echo get_partial('vtpManageProductsCategory/list_field_boolean', array('value' => VtHelper::truncate($vtp_products_category->getIsActive(), 50, '...', true))) ?></td>