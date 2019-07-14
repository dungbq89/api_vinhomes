<?php
if (isset($links) && $links):
    ?>
    <div class="link-website">
        <h3 class="h3-tinh-nang"><?php echo __("Liên kết website"); ?></h3>
        <select id="link-right" onchange="historyChanged(this);">
            <option value="">------------------Chọn liên kết-------------------</option>
        <?php foreach($links as $link): ?>
            <option value="<?php echo $link['link'] ?>"><?php echo $link['name']; ?></option>
        <?php endforeach; ?>
        </select>
    </div>
<?php
endif;
?>
<script type="text/javascript">
    function historyChanged() {
        var historySelectList = $('select#link-right');
        var selectedValue = $('option:selected', historySelectList).val();
        window.open(selectedValue , '_blank');
    }

    $(function() {
        $('select#link-right').change(historyChanged);
    });
</script>