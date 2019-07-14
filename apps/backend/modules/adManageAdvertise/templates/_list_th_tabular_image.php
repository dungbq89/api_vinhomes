    <?php slot('sf_admin.current_header') ?>
        <th  class="sf_admin_text sf_admin_list_th_order_no" style="text-align: center">
            <?php echo __('STT', array(), 'messages') ?>
        </th>
    <?php end_slot(); ?>
    <?php include_slot('sf_admin.current_header') ?> <?php slot('sf_admin.current_header') ?>
        <th  class="sf_admin_text sf_admin_list_th_file_path" style="text-align: center">
            <?php echo __('File đính kèm', array(), 'messages') ?>
        </th>
    <?php end_slot(); ?>
        
    <?php include_slot('sf_admin.current_header') ?> <?php slot('sf_admin.current_header') ?>
        <th  class="sf_admin_text sf_admin_list_th_priority" style="text-align: center">
            <?php echo __('Thứ tự hiển thị', array(), 'messages') ?>
        </th>
    <?php end_slot(); ?>
        
    <?php include_slot('sf_admin.current_header') ?>    <?php slot('sf_admin.current_header') ?>
        <th  class="sf_admin_boolean sf_admin_list_th_is_active" style="width: 65px" style="text-align: center">
            <?php echo __('Trạng thái', array(), 'messages') ?>
        </th>
    <?php end_slot(); ?>
    <?php include_slot('sf_admin.current_header') ?>    <?php slot('sf_admin.current_header') ?>
        <th  class="sf_admin_foreignkey sf_admin_list_th_created_by" style="text-align: center">
            <?php echo __('Người tạo', array(), 'messages') ?>
        </th>
    <?php end_slot(); ?>
    <?php include_slot('sf_admin.current_header') ?>    <?php slot('sf_admin.current_header') ?>
        <th  class="sf_admin_date sf_admin_list_th_created_at" style="text-align: center">
            <?php echo __('Ngày tạo', array(), 'messages') ?>
        </th>
    <?php end_slot(); ?>
    <?php include_slot('sf_admin.current_header') ?>
        <?php slot('sf_admin.current_header') ?>
        <th  class="sf_admin_date sf_admin_list_th_created_at" style="text-align: center">
            <?php echo __('Tác vụ', array(), 'messages') ?>
        </th>
    <?php end_slot(); ?>