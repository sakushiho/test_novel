$(function() {
    $('.follow_button').click (function () {
        // alert('成功');
        var follow = $('button[name="follow"]').val()
          $.ajax({
                  url: "friend_process.php",
                  type: "post",
                  dataType: "text",
                  data:{'follow':follow,}

              }).done(function (response) {
                if (response == 1) {
                  $('.follow_button').text('フォロー中').val(response)
                }else {
                  $('.follow_button').text('フォローする').val(response)
                }
              }).fail(function (xhr,textStatus,errorThrown) {
                  alert('error');
              });
    });
});
