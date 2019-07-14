<?php
if (isset($links) && $links):
    ?>
    <div id="div-website">
        <h3 class="website-unit">Website các đơn vị</h3>
        <ul id="link-footer">
            <?php foreach ($links as $link): ?>

                <li><a href="<?php echo $link['link'] ?>" target="_blank"><?php echo $link['name']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php
endif;
?>