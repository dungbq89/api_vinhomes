<?php
/**
 * Created by PhpStorm.
 * User: Ta Van Ngoc
 * Date: 7/28/15
 * Time: 11:34 PM
 */

?>
<div class="main">
    <div class="col-main">
        <div class="box">
            <h3 class="title-main"><span class="label">Đăng ký hội viên &raquo</span></h3>
           <div class="box-form-contact">

                <form class="frm-contact" action="" method="POST">
                    <?php echo $form->renderHiddenFields() ?>
                    <div class="frm-item">
                        <span class="label">Họ tên (*)</span>
                        <span class="btn-in">
                             <?php echo $form['hodem']->render(array('class'=>'in-txt'));
                             if ($form['hodem']->hasError()) {
                                 echo '<span class="help-inline">' . $form['hodem']->renderError() . '</span>';
                             }?>
                        </span>
                    </div>
                    <div class="frm-item">
                        <span class="label">ngày sinh (*)</span>
                        <span class="btn-in">
                             <?php echo $form['ngaysinh']->render(array('class'=>'in-txt'));
                             if ($form['ngaysinh']->hasError()) {
                                 echo '<span class="help-inline">' . $form['ngaysinh']->renderError() . '</span>';
                             }?>
                        </span>
                    </div>
                    <div class="frm-item">
                        <span class="label">Giới tính (*)</span>
                        <span class="btn-in">
                             <?php echo $form['gioitinh']->render(array('class'=>'in-txt'));
                             if ($form['gioitinh']->hasError()) {
                                 echo '<span class="help-inline">' . $form['gioitinh']->renderError() . '</span>';
                             }?>
                        </span>
                    </div>
<!--                    <div class="frm-item">-->
<!--                        <span class="label">Hình ảnh</span>-->
<!--                        <span class="btn-in">-->
<!--                             --><?php //echo $form['images']->render(array('class'=>'in-txt'));
//                             if ($form['images']->hasError()) {
//                                 echo '<span class="help-inline">' . $form['images']->renderError() . '</span>';
//                             }?>
<!--                        </span>-->
<!--                    </div>-->
                    <div class="frm-item">
                        <span class="label">Tỉnh/thành phố (*)</span>
                        <span class="btn-in">
                             <?php echo $form['matinh']->render(array('class'=>'in-txt'));
                             if ($form['matinh']->hasError()) {
                                 echo '<span class="help-inline">' . $form['matinh']->renderError() . '</span>';
                             }?>
                        </span>
                    </div>
                    <div class="frm-item">
                        <span class="label">Quận/huyện (*)</span>
                        <span class="btn-in">
                             <?php echo $form['maquan']->render(array('class'=>'in-txt'));
                             if ($form['maquan']->hasError()) {
                                 echo '<span class="help-inline">' . $form['maquan']->renderError() . '</span>';
                             }?>
                        </span>
                    </div>

                    <div class="frm-item">
                        <span class="label">Địa chỉ (*)</span>
                        <span class="btn-in">
                             <?php echo $form['diachi']->render(array('class'=>'in-txt'));
                             if ($form['diachi']->hasError()) {
                                 echo '<span class="help-inline">' . $form['diachi']->renderError() . '</span>';
                             }?>
                        </span>
                    </div>

                    <div class="frm-item">
                        <span class="label">Đơn vị (*)</span>
                        <span class="btn-in">
                             <?php echo $form['donvi_id']->render(array('class'=>'in-txt'));
                             if ($form['donvi_id']->hasError()) {
                                 echo '<span class="help-inline">' . $form['donvi_id']->renderError() . '</span>';
                             }?>
                        </span>
                    </div>
                    <div class="frm-item">
                        <span class="label">Nghề nghiệp (*)</span>
                        <span class="btn-in">
                             <?php echo $form['nghenghiep_id']->render(array('class'=>'in-txt'));
                             if ($form['nghenghiep_id']->hasError()) {
                                 echo '<span class="help-inline">' . $form['nghenghiep_id']->renderError() . '</span>';
                             }?>
                        </span>
                    </div>
                    <div class="frm-item">
                        <span class="label"></span>
                        <span class="btn-in">
                            <?php if ($sf_user->hasFlash('success')): ?>
                                <span><?php echo __($sf_user->getFlash('success'), null, 'tmcTwitterBootstrapPlugin') ?></span>
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="box-btn">
                        <button name="" type="submit" class="btn">Gửi đăng ký</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
    <div class="col-right">

        <?php include_component('moduleVideo','listVideoHome',array('limit'=>5)) ?>
        <?php include_component('moduleAdvertise','advertise',array('location'=>'right_middle')); ?>
        <?php include_component('moduleArticle','readNews',array('limit'=>5)) ?>
        <?php include_component('moduleDocument','hotDocument',array('limit'=>3)) ?>
        <?php include_component('moduleArticle','categoryHot',array('limit'=>3)) ?>
        <?php include_component('moduleMenu','linkRight') ?>
        <?php include_component('moduleAdvertise','advertise',array('location'=>'right')); ?>

    </div>
    <div class="clear"></div>
</div>

<?php include_component('moduleAdvertise','advertise',array('location'=>'bottom')); ?>

<script type="text/javascript">
    $( document ).ready(function() {
        $("#csdl_lylichhoivien_matinh").change(function() {
            var proviceCode = $("#csdl_lylichhoivien_matinh").val();
            var url = "<?php echo url_for('@get_province'); ?>";
            $.ajax({
                type: "GET",
                url: url,
                cache: true,
                data: {
                    id: proviceCode
                },
                success: function(data) {
                    obj = $.parseJSON(data);
                    $("#csdl_lylichhoivien_maquan").html(obj);
                },
                error: function() {
                }
            });
        });
    });
</script>
