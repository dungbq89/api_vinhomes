<ul class="bobmenu  fl">
    <?php if (isset($productCategory) && count($productCategory)) { ?>
        <?php
        foreach ($productCategory as $key => $category) {
            $categoryChild = $category->getCategoryByParent();
            if (count($categoryChild) > 0) {
                ?>
                <li <?php if($key==0) echo "class='dau'"; ?>>
                    <a href="<?php echo url_for2('products', array('slug' => $category->slug)) ?>">
                        <h1><?php echo htmlspecialchars($category->getName()); ?></h1></a>

                    <div class="sub" role="menu">
                        <?php
                        foreach ($categoryChild as $child) {
                            ?>
                            <ul class="col">
                                <li class="title"><h2><a
                                            href="<?php echo url_for2('products', array('slug' => $child->slug)) ?>"><?php echo htmlspecialchars($child->getName()); ?></a>
                                    </h2></li>
                            </ul>
                        <?php } ?>
                    </div>
                </li>

            <?php
            } else {
                ?>
                <li>
                    <a href="<?php echo url_for2('products', array('slug' => $category->slug)) ?>">
                        <h1><?php echo htmlspecialchars($category->getName()); ?></h1></a>
                </li>
            <?php
            }
        }
    } ?>
</ul>

