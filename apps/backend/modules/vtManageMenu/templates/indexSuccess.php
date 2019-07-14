<?php use_helper('I18N', 'Date') ?>
<?php include_partial('vtManageMenu/assets') ?>
<?php include_partial('vtManageMenu/header') ?>



<div class="container-fluid">
    <div class="row-fluid">
        <?php if ($sidebar_status): ?>
            <?php include_partial('vtManageMenu/list_sidebar', array('configuration' => $configuration)) ?>
        <?php endif; ?>

        <div class="span<?php echo $sidebar_status ? '10' : '12'; ?>">
            
            <div class="span12">
            <h1 style="display: inline"><?php echo __('Danh sách Menu', array(), 'messages') ?></h1>
            </div>
            <div class="clearfix"></div>

            <?php include_partial('vtManageMenu/flashes') ?>


            <div id="sf_admin_content">
                <form class="form-inline" id="list-form" action="<?php echo url_for('vtp_menu_collection', array('action' => 'batch')) ?>" method="post">

                    <?php $form = new BaseForm(); if ($form->isCSRFProtected()): ?>
                    <input type="hidden" name="<?php echo $form->getCSRFFieldName() ?>" value="<?php echo $form->getCSRFToken() ?>"/>
                    <?php endif; ?>

                    <table border="0">
                        <tr>
                            <td>
                                <select name="ids[]" id="ids" size="20" style="width: 300px">
                                    <?php
                                    foreach ($pager as $key=>$value){
                                        echo '<option value="' . $key . '">' . $value . '</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>

                                <div style="padding: 5px">
                                    <?php include_partial('vtManageMenu/list_actions', array('helper' => $helper)) ?>
                                </div>
                                <div style="padding: 5px">
                                    <button  type="submit" class="btn btn-primary" value="batchEdit" onclick="$(this).addClass('clicked')" name="batch_action" style="width: 100px"><?php echo __('Chỉnh sửa') ?></button>
                                </div>
                                <div style="padding: 5px">
                                    <button  type="submit" class="btn btn-danger" value="batchDelete" id="batchDelete" onclick="$(this).addClass('clicked')"  name="batch_action" style="width: 100px"><?php echo __('Xóa') ?></button>
                                </div>
                                <div  style="padding: 5px">
                                    <button  type="submit" class="btn" name="batch_action" onclick="$(this).addClass('clicked')" value="batchUp" style="width: 100px"><?php echo __('Lên trên') ?></button>
                                </div>
                                <div style="padding: 5px">
                                    <button  type="submit" class="btn" value="batchDown" onclick="$(this).addClass('clicked')" name="batch_action" style="width: 100px"><?php echo __('Xuống dưới') ?></button>
                                </div>
                                <div style="padding: 5px">
                                    <button  type="submit" class="btn" value="batchLeft" onclick="$(this).addClass('clicked')" name="batch_action" style="width: 100px"><?php echo __('Sang trái') ?></button>
                                </div>
                                <div style="padding: 5px">
                                    <button  type="submit" class="btn" value="batchRight" onclick="$(this).addClass('clicked')" name="batch_action" style="width: 100px"><?php echo __('Sang phải') ?></button>
                                </div>

                            </td>
                        </tr>
                    </table>
                </form>
                <div class="clearfix"></div>
            </div>

        </div>
    </div>
</div>

<?php include_partial('vtManageMenu/footer') ?>
<?php $message = __('Bạn có chắc muốn xóa không?') ?>
<script type="text/javascript">
    $(document).ready(function () {

        $('form#list-form').submit(function (e) {
            var input = $(".clicked[type=submit]", $(this));
            input.removeClass('clicked');
            var ids=$("#ids").val();
            if (input.size() && ids )
            {
                if (input.attr('id') == "batchDelete") {
                    var ok = confirm('<?php echo $message ?>');
                    if (ok) {
                        return true;
                    }
                    else {
                        e.preventDefault();
                        return false;
                    }
                }
            }
            else{
                alert('<?php echo __('You must at least select one item.');?>');
                e.preventDefault();
                return false;
            }

        });
        return;
    });
</script>