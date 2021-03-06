<td class="sf_admin_text sf_admin_list_td_order_no" style="text-align: center">
  <?php echo $orderNo; ?>
</td>

<td class="sf_admin_text sf_admin_list_td_email_address"
    field="email_address" title="<?php echo $sf_guard_user->getLastName() ?>"><?php echo  VtHelper::truncate($sf_guard_user->getLastName(), 50, '...', true)  ?></td>
<td class="sf_admin_text sf_admin_list_td_username"
    field="username" title="<?php echo $sf_guard_user->getFirstName() ?>"><?php echo link_to(VtHelper::truncate($sf_guard_user->getFirstName(), 50, '...', true), 'sf_guard_user_edit', $sf_guard_user) ?></td>
<td class="sf_admin_text sf_admin_list_td_username"
    field="username" title="<?php echo $sf_guard_user->getUsername() ?>"><?php echo link_to(VtHelper::truncate($sf_guard_user->getUsername(), 50, '...', true), 'sf_guard_user_edit', $sf_guard_user) ?></td>
<td class="sf_admin_text sf_admin_list_td_email_address"
    field="email_address" title="<?php echo $sf_guard_user->getEmailAddress() ?>"><?php echo  VtHelper::truncate($sf_guard_user->getEmailAddress(), 50, '...', true)  ?></td>
<td class="sf_admin_text sf_admin_list_td_email_address"
    field="email_address" title="<?php echo $sf_guard_user->getPhone() ?>"><?php echo  VtHelper::truncate($sf_guard_user->getPhone(), 50, '...', true)  ?></td>
<td class="sf_admin_boolean sf_admin_list_td_is_active" style="text-align: center"
    field="is_active"><?php echo get_partial('sfGuardUser/list_field_boolean', array('value' => VtHelper::truncate($sf_guard_user->getIsActive(), 50, '...', true))) ?></td>
<td class="sf_admin_date sf_admin_list_td_last_login" style="text-align: center"
    field="last_login"><?php echo get_partial('sfGuardUser/last_login', array('type' => 'list', 'sf_guard_user' => $sf_guard_user)) ?></td>
<td class="sf_admin_date sf_admin_list_td_created_at" style="text-align: center"
    field="created_at"><?php echo get_partial('sfGuardUser/created_at', array('type' => 'list', 'sf_guard_user' => $sf_guard_user)) ?></td>