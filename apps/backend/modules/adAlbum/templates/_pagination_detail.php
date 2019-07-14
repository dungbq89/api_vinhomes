<div class="pagination">
    <ul>
        <?php if($pager->getPage() != $pager->getFirstPage()): ?>
            <li class="prev"><a href="<?php echo url_for('ad_album_edit',$ad_album) ?>?page=1">&laquo;</a></li>
            <li><a href="<?php echo url_for('ad_album_edit',$ad_album) ?>?page=<?php echo $pager->getPreviousPage() ?>">&lsaquo;</a></li>
        <?php endif ?>

        <?php foreach ($pager->getLinks() as $page): ?>
            <?php if ($page == $pager->getPage()): ?>
                <li class="active"><a href="#"><?php echo $page ?></a></li>
            <?php else: ?>
                <li><a href="<?php echo url_for('ad_album_edit',$ad_album) ?>?max_per_page=<?php echo $pager->getMaxPerPage()?>&page=<?php echo $page ?>"><?php echo $page ?></a></li>
            <?php endif; ?>
        <?php endforeach; ?>

        <?php if($pager->getPage() != $pager->getLastPage()): ?>
            <li><a href="<?php echo url_for('ad_album_edit',$ad_album) ?>?page=<?php echo $pager->getNextPage() ?>">&rsaquo;</a></li>
            <li class="next"><a href="<?php echo url_for('ad_album_edit',$ad_album) ?>?page=<?php echo $pager->getLastPage() ?>">&raquo;</a></li>
        <?php endif ?>
    </ul>
</div>