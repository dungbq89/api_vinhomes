<?php
if (isset($listDocument) && $listDocument):
    ?>
    <div class="box-mod category">
        <h3 class="title"><span class="label"><?php echo __('Văn bản pháp quy'); ?> &raquo;</span>
        </h3>
        <ul>
            <?php
            foreach ($listDocument as $doc):
                ?>
                <li>
                    <a href="<?php echo url_for('@page_document_detail?id='.$doc['id']); ?>"
                       title="<?php echo htmlspecialchars($doc['name']); ?>" ><?php echo htmlspecialchars($doc['name']); ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php
endif;
?>