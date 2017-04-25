//document.domain = "https://sinabro.com/login";

jQuery(document).ready(function(){
  // 로그인
  jQuery("#login-button").click(function(event){
      var action = $("#login-form").attr('action');
      var form_data = {
        user_id: $("#user_id").val(),
        user_password: $("#user_password").val(),
        is_ajax: 1
      };
      jQuery.ajax({
        type: "POST",
        url: action,
        data: form_data,
        success: function(response){ // 로그인 성공시
          setTimeout(function(){
            $('#loading').hide();
            if(response == 'success'){
              TextOutLoadPage($("#user_id").val() + " Login Success!",'./client-page.php', true, 1000);
            }
            else if(response == 'admin access'){
              TextOutLoadPage(" Welcome Admin!","./admin-page.php#t1",true,1000);
            }
            else{
              TextOutLoadPage("Login Fail " + response,'./login-page.php', false, 1000);
            }
          },2000); // 로그인 지연
        },
        beforeSend:function(){ // 데이터 보내기 전
            $('h1').text("");
            $('form').fadeOut(500);
            $('#loading').addClass("boxLoading");
        },
        timeout:100000 //응답제한시간
      });
      return false;
  });

  // 회원 가입
  jQuery("#signup-button").click(function(event){
    var action = $("#signup-form").attr('action');
    var form_data =
    {
      user_id: $("#user_id_set").val(),
      user_password: $("#user_password_set").val(),
      username: $("#username_set").val(),
      user_email: $("#user_email_set").val(),
      is_ajax: 1
    };
    jQuery.ajax({
      type: "POST",
      url: action,
      data: form_data,
      success: function(response){
        setTimeout(function(){
          $('#loading').hide();
          if(response == 'success'){
            TextOutLoadPage($("#user_id_set").val() + " Signup Success!","./login-page.php",true,1000);
          }
          else{
            TextOutLoadPage("Signup Fail\n"+response, "./login-page.php", false,1000);
          }
        },2000);
      },
      beforeSend:function(){
          $('h1').text("");
          $('form').fadeOut(500);
          $('#loading').addClass("boxLoading");
      },
      timeout:100000
    });
    return false;
  });

  // 토글
  jQuery(".toggle").click(function(event){
      event.preventDefault();
    $("#signup-form").slideToggle(500);
    $("#login-form").slideToggle(500);
  });

  function TextOutLoadPage(text, url, isSuccess, delayTime)
  {
    if(isSuccess){
      $('.wrapper').addClass('form-success');
      $('h1').text(text);
    }
    else {
      $('.wrapper').addClass('form-fail');
      $('h1').text(text);
    }
    setTimeout(function(){
      location.replace(url);
    },delayTime);
  }
});
