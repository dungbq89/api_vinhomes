<td class="sf_admin_text sf_admin_list_td_name"
    field="name"><?php echo VtHelper::truncate($ad_link->getName(), 50, '...', true) ?></td>
<td class="sf_admin_text sf_admin_list_td_type" field="type">
    <?php
    if ($ad_link->getType() == "1") {
        echo __("Liên kết cột phải");
    } else {
        echo __("Liên kết chân trang");
    }
    ?>
</td>
<td class="sf_admin_text sf_admin_list_td_link"
    field="link"><?php echo VtHelper::truncate($ad_link->getLink(), 50, '...', true) ?></td>
<td class="sf_admin_text sf_admin_list_td_priority"
    field="priority"><?php echo VtHelper::truncate($ad_link->getPriority(), 50, '...', true) ?></td>
<td class="sf_admin_boolean sf_admin_list_td_is_active"
    field="is_active"><?php echo get_partial('adLink/list_field_boolean', array('value' => VtHelper::truncate($ad_link->getIsActive(), 50, '...', true))) ?></td>