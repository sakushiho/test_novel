$(function () {
  $('#recommended').click (function () {
    var comment = $('#comment').val()
    var book_id = $(':hidden[name="book_id"]').val()
    var recommended_deleteflg = $('button[name="recommended"]').val()
    // alert(recommended_deleteflg);

            $.ajax({
                url: "recommended_process.php",
                type: "post",
                dataType: "text",
                data:{'book_id':book_id,
                      'comment':comment,
                      'recommended_deleteflg':recommended_deleteflg}

            }).done(function (response) {
                if (response==1) {
                  $('#recommended').text('おすすめする').val(response)
                }else if(response==0){
                  $('#recommended').text('登録中').val(response)
                }else if (response==='非ログイン') {
                  alert('おすすめ機能を使うにはログインが必要です')
                }
            }).fail(function (xhr,textStatus,errorThrown) {
                alert('error');
            });
  })
})
