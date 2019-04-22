$(function () {
  $('#keep').click (function () {

    var book_id = $(':hidden[name="book_id"]').val()
    var keep_deleteflg = $('button[name="keep"]').val()
        $.ajax({
                url: "keep_process.php",
                type: "post",
                dataType: "text",
                data:{'book_id':book_id,'keep_deleteflg':keep_deleteflg}

          }).done(function (response) {
              if (response==1) {
                $('#keep').text('キープする').val(response)
              }else if(response==0){
                $('#keep').text('キープ中').val(response)
              }else if (response==='非ログイン') {
                alert('キープ機能を使うにはログインが必要です')
              }
              
          }).fail(function (xhr,textStatus,errorThrown) {
              alert('error');
          });
  })
})
