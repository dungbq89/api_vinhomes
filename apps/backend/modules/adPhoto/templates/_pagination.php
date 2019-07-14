<div class="pagination">
    <ul>
        <?php if($pager->getPage() != $pager->getFirstPage()): ?>
            <li class="prev"><a href="<?php echo url_for('@ad_photo') ?>?page=1<?php if(isset($default_album_id)){ echo "&default_album_id=$default_album_id";} ?>">&laquo;</a></li>
            <li><a href="<?php echo url_for('@ad_photo') ?>?page=<?php echo $pager->getPreviousPage() ?><?php if(isset($default_album_id)){ echo "&default_album_id=$default_album_id";} ?>">&lsaquo;</a></li>
        <?php endif ?>

        <?php foreach ($pager->getLinks() as $page): ?>
            <?php if ($page == $pager->getPage()): ?>
                <li class="active"><a href="#"><?php echo $page ?></a></li>
            <?php else: ?>
                <li><a href="<?php echo url_for('@ad_photo') ?>?max_per_page=<?php echo $pager->getMaxPerPage()?>&page=<?php echo $page ?><?php if(isset($default_album_id)){ echo "&default_album_id=$default_album_id";} ?>"><?php echo $page ?></a></li>
            <?php endif; ?>
        <?php endforeach; ?>

        <?php if($pager->getPage() != $pager->getLastPage()): ?>
            <li><a href="<?php echo url_for('@ad_photo') ?>?page=<?php echo $pager->getNextPage() ?><?php if(isset($default_album_id)){ echo "&default_album_id=$default_album_id";} ?>">&rsaquo;</a></li>
            <li class="next"><a href="<?php echo url_for('@ad_photo') ?>?page=<?php echo $pager->getLastPage() ?><?php if(isset($default_album_id)){ echo "&default_album_id=$default_album_id";} ?>">&raquo;</a></li>
        <?php endif ?>
    </ul>
</div>