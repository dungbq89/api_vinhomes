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
            <h3 class="title-main"><span class="label"><?php if(isset($catName)) echo htmlspecialchars($catName); ?></span></h3>


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
                <?php
                if ($pager->haveToPaginate()) {
                    include_component("common", "pagging", array('redirectUrl' => 'document', 'pager' => $pager));
                }
                ?>
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