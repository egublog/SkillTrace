
$(function(){
 
  //talk_showにてenterキーで送信
  $("#message").keypress(function(event) {
    if (event.which == 13) {
      event.preventDefault();
      $("#talk-txt").submit();
    }
  });

  //talk_showにて最新の会話にスクロール
  $(window).on('load', function () {
    // 〜処理〜
    $('#talk-middle-scroll').animate({ scrollTop: $('#talk-middle-scroll')[0].scrollHeight }, 'fast');
  });
  
});