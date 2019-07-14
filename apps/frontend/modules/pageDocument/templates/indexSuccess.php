<?php
/**
 * Created by PhpStorm.
 * User: Ta Van Ngoc
 * Date: 6/14/15
 * Time: 2:02 PM
 */
?>

<div class="main">
    <div class="col-main">
        <div class="box">
            <h3 class="title-main"><span class="label">Văn bản pháp quy &raquo</span></h3>
            <div class="box-form">
                <form class="frm-log" action="" method="POST">
                    <?php echo $form->renderHiddenFields() ?>
                    <div class="frm-item">
                        <span class="label">Lĩnh vực</span>
                        <span class="btn-in">
                             <?php echo $form['category']->render(array('class'=>'select'));
                             if ($form['category']->hasError()) {
                                 echo '<span class="help-inline">' . $form['category']->renderError() . '</span>';
                             }?>
                        </span>
                    </div>
                    <div class="frm-item">
                        <span class="label">Từ khóa</span>
                        <span class="btn-in">
                            <?php echo $form['keyword']->render(array('class'=>'in-txt'));
                            if ($form['keyword']->hasError()) {
                                echo '<span class="help-inline">' . $form['keyword']->renderError() . '</span>';
                            }?>
                        </span>
                        <div class="notic-frm"></div>
                    </div>

                    <div class="box-btn">
                        <button name="" type="submit" class="btn">Tra cứu</button>
                    </div>

                </form>
            </div>

            <?php if(isset($listDocument)):
                $i=1;
                ?>
            <table class="table bordered">
                <tr>
                    <th class="col-stt">STT</th>
                    <th>Tên văn bản</th>
                    <th>Số hiệu văn bản</th>
                    <th>Trích yếu văn bản</th>
                </tr>
                <?php foreach ($listDocument as $key => $document) {
                    $newLink = '';
                    if ($document->file_path) {
                        $newLink = '/uploads/' . sfConfig::get('app_document') . '/' . $document->file_path;
                    }
                    ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><a href="<?php echo $newLink; ?>" target="_blank"><?php echo htmlspecialchars($document->name) ; ?></a></td>
                    <td><?php echo htmlspecialchars($document->document_number) ; ?></td>
                    <td><?php echo htmlspecialchars($document->description); ?></td>
                </tr>
                <?php $i++; } ?>
            </table>
                <!--  paging-->
                <div class="box-pagging">
                    <?php
                    if ($pager->haveToPaginate()) {
                        include_component("common", "pagging", array('redirectUrl' => 'document', 'pager' => $pager));
                    }
                    ?>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <div class="col-right">
        <?php include_component('moduleVideo','listVideoHome',array('limit'=>5,'width'=>'305')) ?>
        <?php include_component('moduleArticle','readNews',array('limit'=>5)) ?>
        <?php include_component('moduleDocument','hotDocument',array('limit'=>3)) ?>
        <?php include_component('moduleArticle','categoryHot',array('limit'=>3)) ?>

        <?php include_component('moduleAdvertise','advertise',array('location'=>'right')); ?>

    </div>
    <div class="clear"></div>
</div>
<?php include_component('moduleAdvertise','advertise',array('location'=>'bottom')); ?>