$(document).ready(function () {
  // initialization code goes here
  $(".sf_admin_batch_checkbox").click(function () {
//      if (this.checked == false) {
//        document.getElementById('sf_admin_list_batch_checkbox').checked = false;
//      }
    var checkAll = true;
    $('.sf_admin_batch_checkbox').each(function () {
      if (this.checked == false) {
        checkAll = false;
      }
    });
    if (checkAll == true) {
      document.getElementById('sf_admin_list_batch_checkbox').checked = true;
    } else {
      document.getElementById('sf_admin_list_batch_checkbox').checked = false;
    }
  });

  $('div.control-group input:text:not([readonly]):not([disabled])').eq(0).focus();
  $('div.sf_admin_form_row.error input').eq(0).focus();
  $('div.control-group.error input').eq(0).focus();

});

function sendMail(it, box) {
  var visible = (box.checked) ? "block" : "none";
  document.getElementById(it).style.display = visible;
}


function checkOne() {
  var checked = true;
  $('.sf_admin_batch_checkbox_rank').each(function () {
    if ($(this).is(':checked') == false) {
      checked = false;
    }
  });
  $('#sf_admin_list_batch_checkbox_rank').attr('checked', checked);
}

function checkAllRank() {
  var listrank = document.getElementsByTagName('input');
  for (var index = 0; index < listrank.length; index++) {
    box = listrank[index];
    if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox_rank') {
      box.checked = document.getElementById('sf_admin_list_batch_checkbox_rank').checked;
    }
  }
  return true;
}


function setBatchActionValue(value, messageConfirm, messageAlert) {
  if(messageConfirm == undefined || messageAlert == undefined){
    alert("Chưa truyền message");
    return false;
  }
  $('#batch_action_input').val(value);
  var itemChecker = false;
  if (value == 'batchDelete')
  {
    $('.sf_admin_batch_checkbox').each( function(){
      if (this.checked == true) {                    {
        itemChecker = true;
//                      break;
      }
      }
    });

    if(itemChecker == true){
      var agree = confirm(messageConfirm);
      if(agree)
        return true;
    } else{
      alert(messageAlert);
    }
    return false;
  }
}

function CheckIsNumeric(input)
{
    return (input - 0) == input && input.length > 0 && input != 0;
}

function checkValidateOnSaveAlbum(){
    var allow=true;
    $(".checkValidateOrderNumber").each(function(){
        if(CheckIsNumeric(this.value)==false){
//            alert("Trường số thứ tự "+this.value+" không phải là số.")
            $(this).next("span").show();
            this.focus();
            allow = false;
        }else if(this.value<0){
            $(this).next("span").show();
            this.focus();
            allow = false;
        }
    })
    return allow;
}

function setBatchActionValueRank(value, messageConfirm, messageAlert) {
  if(messageConfirm == undefined || messageAlert == undefined){
    alert("Chưa truyền message");
    return false;
  }
  $('#batch_action_input_rank').val(value);
  var itemChecker = false;
  if (value == 'batchDelete')
  {
    $('.sf_admin_batch_checkbox_rank').each( function(){
      if (this.checked == true) {                    {
        itemChecker = true;
      }
      }
    });

    if(itemChecker == true){
      var agree = confirm(messageConfirm);
      if(agree)
        return true;
    } else{
      alert(messageAlert);
    }
    return false;
  }
}
