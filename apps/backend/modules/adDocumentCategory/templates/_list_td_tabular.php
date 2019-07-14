  
  <td class="sf_admin_text sf_admin_list_td_name" field="name">
      <?php echo link_to(VtHelper::truncate($ad_document_category->getName(), 50, '...', true),'ad_document_category_edit',$ad_document_category) ?>
  </td>
  <td class="sf_admin_text sf_admin_list_td_description" field="description"><?php echo  VtHelper::truncate($ad_document_category->getDescription(), 50, '...', true)  ?></td>      
  <td class="sf_admin_text sf_admin_list_td_priority" field="priority"><?php echo  VtHelper::truncate($ad_document_category->getPriority(), 50, '...', true)  ?></td>    