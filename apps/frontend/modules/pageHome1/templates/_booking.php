<div style="max-width:1160px; margin:auto;">
    <div class="box-booking-slide">
        <div style="text-transform:uppercase; color:#FFF"><?php echo __('Đặt phòng'); ?></div>
        <div class="c10"></div>
        <form action="/index4.php?page=booking&lang=" method="post" id="bookingform"
              onSubmit="return check_booking();">
            <?php echo $form->renderHiddenFields() ?>
            <input type="hidden" value="save" name="code"/>

            <div class="box-item-booking">
                <div class="item">
                    <?php echo $form['full_name']->render(array('placeholder'=> __('Họ tên')));
                    if ($form['full_name']->hasError()) {
                        echo '<span class="help-inline">' . $form['full_name']->renderError() . '</span>';
                    }?>
                </div>
                <div class="item">
                    <?php echo $form['phone']->render(array('placeholder'=> __('Số điện thoại')));
                    if ($form['phone']->hasError()) {
                        echo '<span class="help-inline">' . $form['phone']->renderError() . '</span>';
                    }?>
                </div>
                <div class="item">
                    <?php echo $form['email']->render(array('placeholder'=> __('Email')));
                    if ($form['email']->hasError()) {
                        echo '<span class="help-inline">' . $form['email']->renderError() . '</span>';
                    }?>
                </div>
                <div class="item">
                    <?php echo $form['category_id']->render(array());
                    if ($form['category_id']->hasError()) {
                        echo '<span class="help-inline">' . $form['category_id']->renderError() . '</span>';
                    }?>
                </div>
                <div class="item">
                    <?php echo $form['product_id']->render(array());
                    if ($form['product_id']->hasError()) {
                        echo '<span class="help-inline">' . $form['product_id']->renderError() . '</span>';
                    }?>
                </div>
                <div class="row-booking">
                    <div class="item item-1-2">
                        <?php echo $form['from_time']->render(array('class'=>'datepk'));
                        if ($form['from_time']->hasError()) {
                            echo '<span class="help-inline">' . $form['from_time']->renderError() . '</span>';
                        }?>
<!--                        <input name="from" placeholder="From" class="datepk" type="text">-->
                    </div>
                    <div class="item item-1-2">
                        <?php echo $form['to_time']->render(array('class'=>'datepk'));
                        if ($form['to_time']->hasError()) {
                            echo '<span class="help-inline">' . $form['to_time']->renderError() . '</span>';
                        }?>
                    </div>
                    <div class="c"></div>
                    <div class="item-2-3 item"><?php echo __('Số lượng người') ?></div>
                    <div class="item-1-3 item">
                        <?php echo $form['number_person']->render(array());
                        if ($form['number_person']->hasError()) {
                            echo '<span class="help-inline">' . $form['number_person']->renderError() . '</span>';
                        }?>
                    </div>
                    <div class="c"></div>
                    <div class="item-2-3 item"><?php echo __('Số lượng phòng') ?></div>
                    <div class="item-1-3 item">
                        <?php echo $form['number_room']->render(array());
                        if ($form['number_room']->hasError()) {
                            echo '<span class="help-inline">' . $form['number_room']->renderError() . '</span>';
                        }?>
                    </div>
                    <div class="c"></div>

                </div>
                <div>
                    <a href="#" onClick="$('#bookingform').submit(); return false"
                       class="btn-book-now"><?php echo __('Đặt phòng'); ?></a>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $( document ).ready(function() {
        $("#booking_category_id").change(function() {
            var categoryId = $("#booking_category_id").val();
            var url = "<?php echo url_for('@get_product_by_catid'); ?>";
            $.ajax({
                type: "GET",
                url: url,
                cache: true,
                data: {
                    catid: categoryId
                },
                success: function(data) {
                    obj = $.parseJSON(data);
                    $("#booking_product_id").html(obj);
                },
                error: function() {
                }
            });
        });
    });
</script>