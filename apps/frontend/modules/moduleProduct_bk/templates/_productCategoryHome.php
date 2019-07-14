
<?php
    if(isset($productCategory) && count($productCategory)):
?>
<ul class="nav nav-tabs">
    <?php
        foreach($productCategory as $key => $value){
            ?>
            <li class="<?php if($key==0) echo 'active' ?>"><a href="#<?php echo $value['slug'] ?>" data-toggle="tab">
                    <?php echo htmlspecialchars($value['name']) ?>
                </a></li>
            <?php
        }
    ?>
</ul>
<?php endif; ?>