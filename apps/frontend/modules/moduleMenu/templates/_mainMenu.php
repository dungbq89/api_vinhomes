<?php
/**
 * Created by PhpStorm.
 * User: vtsoft
 * Date: 4/25/14
 * Time: 10:27 AM
 */
$rootMenu = array();
foreach ($mainMenu as $menu) {
    if ($menu['level'] == 0) {
        $rootMenu[] = $menu;
    }
}
$i = 0;
?>
    <?php
    foreach ($rootMenu as $menu) {
        $subMenu = array();
        foreach ($mainMenu as $item) {
            if ($item['parent_id'] == $menu['id']) {
                $subMenu[] = $item;
            }
        }
        $link1 = url_for2('category_news', array('slug' => $menu['slug']));
        if ($menu['link'] != '') {
            if (VtHelper::startsWith($menu['link'], '@')) {
                $link1 = url_for($menu['link']);
            } else {
                $link1 = $menu['link'];
            }
        }
        echo "<li ><a class='menu-hori-title' href='".$link1."'>".$menu['name']."</a></li>";
    }
    ?>