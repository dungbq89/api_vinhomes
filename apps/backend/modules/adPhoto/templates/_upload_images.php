  <fieldset style="padding: 15px;height:850px;overflow:scroll; ">
    <div>
      <input type="file" id="file_upload" name="file_uploads" />
    </div>
    <div id="images_list">
        
    </div>
  </fieldset>
  <script type="text/javascript">
  <?php $timestamp = time(); ?>
             $(function() {
               $('#file_upload').uploadifive({
                 'formData': {
                   'timestamp': '<?php echo $timestamp; ?>',
                   'token': $("#ajax_token").val()
                 },
                 'uploadScript': '<?php echo url_for('@ajax_upload_image_files') ?>',
                 'buttonText': 'Tải file mới',
                 'removeCompleted': 'true',
                 'fileSizeLimit': '51200',
                 'fileTypeExts': '*.jpg;*.gif;*.png',
                 'fileTypeDesc': 'Upload Files (JPG, GIF, PNG)',
                 'queueSizeLimit': '5',
                 'onUploadComplete': function(file, data) {
                   var response = JSON.parse(data);

                   if (response.errCode == 1) {

                   var template =
                    "<div class='img_div' id='img_file_"+response.id+"'>"
                           +"<img class='item-image' src='"+response.message+"' />"
                           + "<div class='item-content'>"
                           +"<p>Tên ảnh:"
                           +"<input class='img-title' type='text' />"
                           +"- Số thứ tự: <input class='img-order_number'"
                           +"type='text' value='0' />"
                           +"</p>"
                           +"<p>Mô tả ảnh:"
                           +"<textarea class='img-content'  >"
                           +"</textarea>"
                           +"</p>"
                           +"<input class='btn' type='button'"
                           +"onclick='updateContentOfImage("+response.id+")' value='Cập nhật nội dung' />"
                           +"<a class='btn btn-danger' data-toggle='tooltip' title='Delete'"
                           +"onclick='removeImage("+response.id+")' >Xóa</a>"
                           +"</div>"
                           +"</div>"
                           +" <div style='clear:both;'></div>";
                  $("#images_list").prepend(template);

//
//                     $("#images_list").append("" +
//                         "<div class='img_div' id='img_file_" + response.id + "'> " +
//                         "<img src='" + response.message + "' />" +
//                         "<a class='btn btn-danger' data-toggle='tooltip' title='Delete' onclick='removeImage(" + response.id + ")' >" +
//                         "X</a> " +
//                         "</div>");
                   } else
                     alert(response.message);
                 }
               });
             });

             function removeImage(fid) {

               if (confirm("Bạn có chắc chắn muốn xóa?")) {
                 var dataString = {
                     file_id: fid,
                     token: $("#ajax_token").val()
                 };
                 $.ajax({
                   type: "GET",
                   url: '<?php echo url_for('@ajax_remove_image_file') ?>',
                   data: dataString,
                   dataType: 'html',
                   success: function(data)
                   {
                       var json = JSON.parse(data);
                     if (json.errorCode == 0) {

                       $("#img_file_" + fid).remove();
                       alert(json.message);

                     } else {
                      alert(json.message);
                     }
                   }
                 });
               }
               ;
             }

  </script>
