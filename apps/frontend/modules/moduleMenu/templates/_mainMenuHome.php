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

<div class="menubar" id="menubar">
    <ul class="nav hide-on-pad hide-on-tab hide-on-mobile" id="navbar">
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
                    $link1 = url_for2($menu['link'], array('slug' => $menu['slug']));
                } else {
                    $link1 = $menu['link'];
                }
            }


            $i++;
            if (count($subMenu) == 0) {
                echo '<li>';
                echo '<a href="' . $link1 . '">' . VtHelper::strip_html_tags_and_decode($menu['name']) . '</a>';
                echo '</li>';
            } else {
                echo '<li class="">';
                echo '<a href="' . $link1 . '">' . VtHelper::strip_html_tags_and_decode($menu['name']) . '<i class="fa fa-angle-down"></i></a>';
                $i = 1;
                echo '<ul class="mnu-one-col">';
                foreach ($subMenu as $sub) {
                    $link = url_for2('category_news', array('slug' => $sub['slug']));
                    $parentMenu = array();
                    foreach ($mainMenu as $item) {
                        if ($item['parent_id'] == $sub['id']) {
                            $parentMenu[] = $item;
                        }
                    }
                    if ($sub['link'] != '') {
                        if (VtHelper::startsWith($sub['link'], '@')) {
                            $link = url_for($sub['link'], array('slug' => $sub['slug']));
                        } else {
                            $link = $sub['link'];
                        }
                    }
                    echo '    <li>';
                    if (count($parentMenu) == 0) {
                        echo '      <a href="' . $link . '">' . VtHelper::strip_html_tags_and_decode($sub['name']) . '</a>';
                    } else {
                        echo '      <a href="' . $link . '"><strong>' . VtHelper::strip_html_tags_and_decode($sub['name']) . '</strong></a>';
                    }
                    echo '    </li>';

                    foreach ($parentMenu as $parent) {
                        if ($parent['link'] != '') {
                            if (VtHelper::startsWith($parent['link'], '@')) {
                                $link = url_for($parent['link'], array('slug' => $parent['slug']));
                            } else {
                                $link = $parent['link'];
                            }
                        }
                        echo '    <li>';
                        echo '      <a href="' . $link . '">' . VtHelper::strip_html_tags_and_decode($parent['name'], ENT_QUOTES) . '</a>';
                        echo '    </li>';
                    }
                }
                echo '</ul>';
                echo '</li>';
            }
        }
        ?>
<!--        <li class=" active">-->
<!--            <a href="/">Home</a>-->
<!--        </li>-->
<!--        <li class="">-->
<!--            <a href="/about-us-1/">About us</a>-->
<!--        </li>-->
<!--        <li class="">-->
<!--            <a href="chain/"> Chain</a>-->
<!--        </li>-->
<!--        <li class="">-->
<!--            <a href="/services/">Services</a>-->
<!--        </li>-->
<!--        <li class="">-->
<!--            <a href="/photos/">Photos</a>-->
<!--            <ul class="mnu-one-col">-->
<!--                <li><a href="/photo-newland-1/"> Newland 1 Photos</a>-->
<!--                    <ul>-->
<!--                        <li><a href="/photo-newland-1/studio-apartment-1">Studio apartment 1</a>-->
<!--                        <li><a href="/photo-newland-1/studio-apartment-2/">Studio apartment 2</a>-->
<!--                        <li><a href="/photo-newland-1/2-bedrooms-apartment/">2 bedrooms-->
<!--                                Apartment </a>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li><a href="/newland-6-photos/">Newland 6 Photos</a>-->
<!--                    <ul>-->
<!--                        <li><a href="/newland-6-photos/studio-apartment-1/">Studio apartment 1</a>-->
<!--                        <li><a href="/newland-6-photos/studio-apartment-2/">Studio apartment 2</a>-->
<!--                        <li><a href="/newland-6-photos/studio-apartment-3/">Studio apartment 3</a>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li><a href="/newland-8-photos/">Newland 7 Photos</a>-->
<!--                    <ul>-->
<!--                        <li><a href="/newland-8-photos/studio-apartment-1/">Studio apartment 1</a>-->
<!--                        <li><a href="/newland-8-photos/studio-apartment-2/">Studio apartment 2</a>-->
<!--                        <li><a href="/newland-8-photos/1-bedroom-apartment/"> 1 bedroom-->
<!--                                Apartment</a>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li><a href="/newland-8-photos-1/">Newland 8 Photos</a>-->
<!--                    <ul>-->
<!--                        <li><a href="/newland-8-photos-1/studio-apartment-1/">Studio apartment 1</a>-->
<!--                        <li><a href="/newland-8-photos-1/studio-apartment-2/">Studio apartment 2</a>-->
<!--                        <li><a href="/newland-8-photos-1/superior-studio-apartment/">Superior Studio-->
<!--                                apartment</a>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li><a href="/newland-9-photos/">Newland 9 Photos</a>-->
<!--                    <ul>-->
<!--                        <li><a href="/newland-9-photos/standard-studio-apartment/">Standard Studio-->
<!--                                apartment</a>-->
<!--                        <li><a href="/newland-9-photos/superior-studio-apartment/">Superior Studio-->
<!--                                apartment</a>-->
<!--                    </ul>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </li>-->
<!--        <li class="">-->
<!--            <a href="/news/">News</a>-->
<!--        </li>-->
<!--        <li class="">-->
<!--            <a href="/contact-us/">Contact us</a>-->
<!--        </li>-->
<!---->

    </ul>
    <ul class="nav hide-on-pc " id="navmobile">
        <li><a href="#menu" class="fa fa-bars"></a></li>
        <li class="active"><a href="/" class="fa fa-home"></a></li>
    </ul>
</div>