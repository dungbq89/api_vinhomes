<?php
$params = array();
if (isset($vtParams)) {
    foreach ($vtParams as $key => $value) {
        $params = array_merge(array($key => $value), $params);
    }
}
?>
<?php if ($pager->haveToPaginate()): ?>
        <ul class="pagination">
            <?php if ($pager->getPage() != $pager->getFirstPage()): ?>
                <li class="page-item"><a class="page-link"
                       href="<?php echo url_for($redirectUrl, array_merge(array('page' => $pager->getPreviousPage()), $params)); ?>">&laquo;</a>
                </li>
            <?php endif; ?>
            <?php foreach ($pager->getLinks() as $page): ?>
                <?php if ($page == $pager->getPage()): ?>
                    <li class="active page-item disabled"><a href="#" class="page-link"><?php echo $page ?></a></li>
                <?php else: ?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo url_for($redirectUrl, array_merge(array('page' => $page), $params)) ?>"><?php echo $page ?></a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php if ($pager->getPage() != $pager->getLastPage()) : ?>
                <li class="page-item"><a class="page-link"
                       href="<?php echo url_for($redirectUrl, array_merge(array('page' => $pager->getNextPage()), $params)); ?>">&raquo;</a>
                </li>
            <?php endif; ?>
        </ul>
<?php endif; ?>
