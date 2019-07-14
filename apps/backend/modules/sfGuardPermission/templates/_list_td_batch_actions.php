<td>
    <?php if($sf_guard_permission->types): ?>
    <input type="checkbox" name="ids[]" value="<?php echo $sf_guard_permission->getPrimaryKey() ?>" class="sf_admin_batch_checkbox" />
  <?php endif; ?>
  
</td>
