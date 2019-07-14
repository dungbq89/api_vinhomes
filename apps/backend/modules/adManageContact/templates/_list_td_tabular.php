
<td class="sf_admin_text sf_admin_list_td_title" field="title" title="<?php echo htmlspecialchars($ad_contact->getTitle())?>">
    <?php echo VtHelper::truncate($ad_contact->getTitle(), 50, '...', true) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_content" field="content"><?php
    echo nl2br(htmlspecialchars($ad_contact->getContent()));
    ?></td>      
<td class="sf_admin_text sf_admin_list_td_lat" field="lat"><?php echo VtHelper::truncate($ad_contact->getLat(), 50, '...', true) ?></td>      
<td class="sf_admin_text sf_admin_list_td_lng" field="lng"><?php echo VtHelper::truncate($ad_contact->getLng(), 50, '...', true) ?></td>    