<td class="sf_admin_text sf_admin_list_td_name" field="name">
    <?php echo link_to(VtHelper::truncate($ad_document->getName(), 50, '...', true), 'ad_document_edit', $ad_document) ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_category_id" field="category_id">
    <?php
    $category = AdDocumentCategoryTable::getCategoryDocumentById($ad_document->getCategoryId());
    if($category){
        echo VtHelper::truncate($category['name'], 50, '...', true);
    }

    ?>
</td>
<td class="sf_admin_text sf_admin_list_td_document_number"
    field="document_number"><?php echo VtHelper::truncate($ad_document->getDocumentNumber(), 50, '...', true) ?></td>
<td class="sf_admin_text sf_admin_list_td_priority"
    field="priority"><?php echo VtHelper::truncate($ad_document->getPriority(), 50, '...', true) ?></td>