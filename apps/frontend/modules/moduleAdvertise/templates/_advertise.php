<?php
if (count($advertise) > 0) {
    $advertiseImage = $advertise[0]['AdvertiseImage'];
    $count = count($advertiseImage);
    if ($count > 0) { ?>
        <section class="dq-stt-1" style="margin-top: -20px;">
            <section class="header clearb">
                <div class="header-slide">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php for ($i = 0; $i < count($advertiseImage); $i++) {
                                ?>
                                <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>"
                                    class="<?php if ($i == 0) echo 'active'; ?>"></li>
                                <?php
                            } ?>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <?php for ($i = 0; $i < count($advertiseImage); $i++) {
                                ?>
                                <div class="item <?php if ($i == 0) echo 'active'; ?>">
                                    <a href="#"><img
                                                src="<?php echo sfConfig::get('app_url_media_file') . '/' . sfConfig::get('app_advertise_images') . $advertiseImage[$i]['file_path']; ?>"
                                                alt="" class="img-slide-w100"></a>
                                </div>
                                <?php
                            } ?>
                        </div>
                        <div class="container">
                            <a class="left carousel-control" href="#carousel-example-generic" role="button"
                               data-slide="prev">
                        <span aria-hidden="true"><img
                                    src="/images/arrow-lefta89f.png"
                                    alt="Future"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" role="button"
                               data-slide="next">
                        <span aria-hidden="true"><img
                                    src="/images/arrow-righta89f.png"
                                    alt="Future"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    <?php }
}else{
    ?>
    <section class="breadc">
        <div class="container breadpos">
        </div>
    </section>
    <?php
} ?>



