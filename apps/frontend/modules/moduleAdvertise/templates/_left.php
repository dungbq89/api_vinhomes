<?php
if (count($advertise) > 0) {
    $advertiseImage = $advertise[0]['AdvertiseImage'];
    $count = count($advertiseImage);
    if ($count > 0) { ?>
        <div class="adv-body">
            <a target="_blank" href="<?php if ($advertiseImage[0]['link']) echo $advertiseImage[0]['link']; ?>">
                <img width="664px" height="90px" alt="" src="<?php echo sfConfig::get('app_url_media_file') . '/' . sfConfig::get('app_advertise_images') . $advertiseImage[0]['file_path']; ?>">
            </a>
        </div>
    <?php } }else{ ?>
    <div class="adv-body">
        <a target="_blank" href="http://baohatinh.vn/adclick/e45248519e1c6e60c66bfced8775f899/575?b=388&amp;r=792&amp;url=http://hoanhsongroup.vn/Web/vi-Vn/Trang-Chu" id="iad575"><img width="664px" height="90px" alt="" src="http://i.baohatinh.vn/ads/4/mdtim4528.jpg"></a>
    </div>
<?php } ?>