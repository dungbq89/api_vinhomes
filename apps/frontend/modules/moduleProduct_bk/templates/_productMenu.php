
<div class="col-sm-3">
    <div class="left-sidebar">
        <?php if(isset($productCategory)): ?>
        <h2>Chuyên mục sản phẩm</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            <?php
                foreach($productCategory as $category){
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="menu-product" href="#<?php echo $category->getSlug(); ?>">
                                    <?php echo htmlspecialchars($category->getName()); ?>
                                </a>
                            </h4>
                        </div>
                        <?php
                            $categoryChild = $category->getCategoryByParent();
                            if(count($categoryChild)>0){
                                    ?>
                                    <div id="<?php echo $category->getSlug(); ?>" class="panel-collapse">
                                        <div class="panel-body">
                                            <ul>
                                                <?php
                                                    foreach($categoryChild as $child){
                                                ?>
                                                <li><a href="<?php echo url_for2('products',array('slug'=>$child->slug)) ?>" class="menu-product"><?php echo htmlspecialchars($child->getName()); ?></a></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php
                            }
                        ?>

                    </div>
                <?php
                }
            ?>
        </div><!--/category-products-->
        <?php endif; ?>


        <div class="shipping text-center"><!--shipping-->
            <img src="images/home/shipping.jpg" alt="" />
        </div><!--/shipping-->

    </div>
</div>
