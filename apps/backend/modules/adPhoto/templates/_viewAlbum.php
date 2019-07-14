<div class="control-group">
    <fieldset id="sf_fieldset_none">
        <table border="0" cellpadding="5px">
            <tr>
                <td width="150">
                    <label for="ad_advertise_image_advertise_id" class="text-services"><?php echo __("Tên album: "); ?></label>
                </td>
                <td>
                    <span>
                        <?php echo htmlentities(VtHelper::truncate($ad_album->getName(), 50, '...', true), ENT_QUOTES, "UTF-8")?>
                        <?php // echo VtHelper::truncate($ad_album->getName(), 50, '...', true); ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="text-services" for="ad_advertise_image_advertise_id"><?php echo __("Ngày diễn ra sự kiện: "); ?></label>
                </td>
                <td> 
                    <span><?php echo VtHelper::truncate(htmlentities(date("d-m-Y", strtotime($ad_album->getEventDate())), ENT_QUOTES, "UTF-8"), 50, '...', true); ?></span>
                </td>
            </tr>
        </table>
    </fieldset>            
</div>


