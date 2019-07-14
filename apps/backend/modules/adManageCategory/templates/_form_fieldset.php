<?php if ('NONE' != $fieldset): ?>
    <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
<?php endif; ?>
<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
    <?php foreach ($fields as $name => $field): ?>
        <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
        <?php include_partial('adManageCategory/form_field', array(
            'name'       => $name,
            'attributes' => $field->getConfig('attributes', array()),
            'label'      => $field->getConfig('label'),
            'help'       => $field->getConfig('help'),
            'form'       => $form,
            'field'      => $field,
            'class'      => 'sf_admin_form_row sf_admin_'.strtolower($field->getType()).' sf_admin_form_field_'.$name,
            'ad_category' => $ad_category        )) ?>
    <?php endforeach; ?>
</fieldset>


<script type="text/javascript">
    select = document.getElementById('ad_category_type_link').value;
    changeLink(select);
    function changeSelectLink() {
        var select = document.getElementById('ad_category_type_link').value;
        changeLink(select);
    }
    function changeLink($select){
        if ($select == 0) {
            //Hi?n th? Text nh?p
            document.getElementById('ad_category_link_text').disabled='';
            document.getElementById('ad_category_link_content').disabled='false';
            document.getElementById('ad_category_page').disabled='false';
        }
        if ($select == 1) {
            //Hi?n th? combobox ch?n
            document.getElementById('ad_category_link_content').disabled='';
            document.getElementById('ad_category_link_text').disabled='false';
            document.getElementById('ad_category_page').disabled='false';
        }
        if ($select == 2) {
            document.getElementById('ad_category_page').disabled= false;
            document.getElementById('ad_category_link_text').disabled= false ;

        }
    }
</script>