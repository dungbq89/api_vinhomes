<div class="clearfix"></div>
<?php include_component('moduleAdvertise', 'topOne'); ?>
<div class="clearfix"></div>


<div class="content fll">
    <?php include_component('common', 'support'); ?>
    <div class="right_pico fr">
        <div class="all">
            <div class="top_product2">
                <div id="it"><?php echo htmlspecialchars($article->getTitle()); ?></div>
            </div>

            <div class="views_sp views_sp02">
				<div style="padding: 20px;">
                    <?php echo $article->getBody(); ?>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

    </div>
</div>
<style>
    .slide {
        margin-top: 3px !important;
    }
</style>