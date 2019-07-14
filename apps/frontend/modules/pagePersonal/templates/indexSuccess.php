<?php
/**
 * Created by PhpStorm.
 * User: Ta Van Ngoc
 * Date: 6/11/15
 * Time: 11:29 PM
 */
?>
<div class="main">
    <div class="col-main">
        <div class="box">
            <h3 class="title-main"><span class="label">Tra cứu hội viên &raquo</span></h3>
            <div class="box-form">
                <form class="frm-log" action="" method="POST">
                    <?php echo $form->renderHiddenFields() ?>

                    <div class="frm-item">
                        <span class="label">Tên hội viên</span>
                        <span class="btn-in">
                             <?php echo $form['full_name']->render(array('class'=>'in-txt'));
                             if ($form['full_name']->hasError()) {
                                 echo '<span class="help-inline">' . $form['full_name']->renderError() . '</span>';
                             }?>
                        </span>
                    </div>
                    <div class="frm-item">
                        <span class="label">Điện thoại</span>
                        <span class="btn-in">
                             <?php echo $form['phone_number']->render(array('class'=>'in-txt'));
                             if ($form['phone_number']->hasError()) {
                                 echo '<span class="help-inline">' . $form['phone_number']->renderError() . '</span>';
                             }?>
                        </span>
                    </div>

                    <div class="frm-item">
                        <span class="label">Email</span>
                        <span class="btn-in">
                             <?php echo $form['email']->render(array('class'=>'in-txt'));
                             if ($form['email']->hasError()) {
                                 echo '<span class="help-inline">' . $form['email']->renderError() . '</span>';
                             }?>
                        </span>
                    </div>
                    <div class="box-btn">
                        <button name="" type="submit" class="btn">Tra cứu</button>
                        <button name="" type="reset" class="btn">Hủy bỏ</button>
                    </div>

                </form>
            </div>
            <?php if(isset($listPersonal)):
                $i=1;
                ?>
                <table class="table bordered">
                    <tr>
                        <th class="col-stt">STT</th>
                        <th>Họ tên</th>
                        <th>Địa chỉ</th>
                        <th>Điện thoại</th>
                        <th>Email</th>
                    </tr>
                    <?php foreach ($listPersonal as $key => $personal) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $personal->hodem.' '.$personal->ten; ?></td>
                        <td><?php echo $personal->diachi; ?></td>
                        <td><?php echo $personal->phone; ?></td>
                        <td><?php echo $personal->email_address; ?></td>
                    </tr>

                    <?php $i++; } ?>
                </table>

                <!--  paging-->
                <div class="box-pagging">
                    <?php
                    if ($pager->haveToPaginate()) {
                        include_component("common", "pagging", array('redirectUrl' => 'personnal', 'pager' => $pager));
                    }
                    ?>
                </div>
            <?php endif; ?>
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