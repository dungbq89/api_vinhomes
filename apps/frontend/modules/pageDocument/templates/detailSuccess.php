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
    <h3 class="title-main"><span class="label"><?php echo __('Chi tiết văn bản'); ?></span></h3>
        <table class="table bordered">
            <?php
            if ($document->file_path) {
                $newLink = '/uploads/' . sfConfig::get('app_document') . '/' . $document->file_path;
            }
            ?>
            <tr>
                <td class="td-document-detail">Tên văn bản</td>
                <td><a style="color: #3398cc; font-weight: bold;" href="<?php echo $newLink; ?>" target="_blank"><?php echo htmlspecialchars($document->name); ?></a></td>
            </tr>
            <tr>
                <td class="td-document-detail">Số văn bản</td>
                <td><?php echo htmlspecialchars($document->document_number); ?></td>
            </tr>
            <tr>
                <td class="td-document-detail">ngày ban hành</td>
                <td><?php echo date('d/m/Y',strtotime($document->getDocumentDate())); ?></td>
            </tr>
            <tr>
                <td class="td-document-detail">Trích yếu</td>
                <td><?php echo htmlspecialchars($document->description); ?></td>
            </tr>
        </table>
        <div class="download">
            <a href="<?php echo $newLink; ?>" >
                <img src="/img/download.png" style="border: none;">
                <span>Tải xuống</span>
            </a>
        </div>
    </div>
    </div>

    <div class="col-right">
        <?php include_component('moduleVideo','listVideoHome',array('limit'=>5,'width'=>'305')) ?>
        <?php include_component('moduleArticle','readNews',array('limit'=>5)) ?>
        <?php include_component('moduleDocument', 'hotDocument', array('limit' => 3)) ?>
        <?php include_component('moduleArticle', 'categoryHot', array('limit' => 3)) ?>

        <?php include_component('moduleAdvertise', 'advertise', array('location' => 'right')); ?>

    </div>
    <div class="clear"></div>
    </div>
    <?php include_component('moduleAdvertise', 'advertise', array('location' => 'bottom')); ?>