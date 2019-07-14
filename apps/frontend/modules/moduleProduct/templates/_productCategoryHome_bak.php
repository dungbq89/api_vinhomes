
<?php
    if(isset($productCategory) && count($productCategory)):
?>
<ul class="mainnavcat">
    <?php
        foreach($productCategory as $key => $value){
            ?>
            <li>
                <a href="<?php echo url_for('@products?slug=' . $value['slug']); ?>"><?php echo htmlspecialchars($value['name']); ?><i class="fa fa-angle-right"></i></a>
            </li>
            <?php
        }
    ?>
</ul>
<?php endif; ?>