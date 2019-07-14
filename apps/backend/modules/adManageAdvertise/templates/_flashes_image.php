<?php if ($sf_user->hasFlash('successImage')): ?>
    <div class="alert alert-success fade in">
        <button class="close" data-dismiss="alert" type="button">×</button>
        <?php echo __($sf_user->getFlash('successImage'), array(), 'messages') ?>
    </div>
    <?php $sf_user->setAttribute('successImage', 'true', 'symfony/user/sfUser/flash/remove') ?>
<?php endif; ?>

<?php if ($sf_user->hasFlash('noticeImage')): ?>
    <div class="alert alert-warning fade in">
        <button class="close" data-dismiss="alert" type="button">×</button>
        <?php echo __($sf_user->getFlash('noticeImage'), array(), 'messages') ?>
    </div>
    <?php $sf_user->setAttribute('noticeImage', 'true', 'symfony/user/sfUser/flash/remove') ?>
<?php endif; ?>

<?php if ($sf_user->hasFlash('errorImage')): ?>
    <div class="alert alert-error fade in">
        <button class="close" data-dismiss="alert" type="button">×</button>
        <?php echo __($sf_user->getFlash('errorImage'), array(), 'messages') ?>
    </div>
    <?php $sf_user->setAttribute('errorImage', 'true', 'symfony/user/sfUser/flash/remove') ?>
<?php endif; ?>

<?php if ($sf_user->hasFlash('infoImage')): ?>
    <div class="alert alert-info fade in">
        <button class="close" data-dismiss="alert" type="button">×</button>
        <?php echo __($sf_user->getFlash('infoImage'), array(), 'messages') ?>
    </div>
    <?php $sf_user->setAttribute('infoImage', 'true', 'symfony/user/sfUser/flash/remove') ?>
<?php endif; ?>