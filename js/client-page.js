jQuery(document).ready(function(){
    // 탑 알림 배너
    jQuery(".close").click(function(){
      $(".close").parent().slideUp(500);
    });

    jQuery(".top-banner").slideDown("slow",function(){
      $(".top-banner").css("display","flex");
    });

    // 메뉴
    jQuery(".dropdown").click(function(){
      $(".dropdown-content").slideToggle(500);
    });

    // 그룹 만들기
   jQuery("#create").click(function(event){
     var action = $("#create").attr('action');
     var form_data =
     {
       groupName: $("#group-name").val(),
       is_ajax: 1
     };
     jQuery.ajax({
       type: "POST",
       url: action,
       data: form_data,
       success: function(response){
         setTimeout(function(){
           $('#loading').hide();

           location.href="./inside-group-page.php";
         },2000);
       },
       beforeSend:function(){
          //  $('h1').text("");
          //  $('form').fadeOut(500);
          //  $('#loading').addClass("boxLoading");
       },
       timeout:100000
     });
     return false;
   });

   // 그룹 찾기
   jQuery("#search-group").click(function(){
      $("#overlay").fadeIn(1000);
      $(".popupContainer").fadeIn(1000);
      $(".popupContainer").css("animation-name","popupAnimation");

      var groupName = $("#group-name").val();
      $("#group-name-to-search").val(groupName);
      // top:100,
      // overlay:0.6,
      // closeButton: ".window-close"
   });

   jQuery("#overlay").click(function(){
     $("#overlay").fadeOut(1000);
     $(".popupContainer").fadeOut(1000);
     $(".popupContainer").css("animation-name","");
   });

   // 그룹 들어가기
   jQuery(".sign-in").click(function(event){

       var action = $("#sign-in").attr('action');
       var form_data =
       {
         groupName: $("#group-name").val(),
         is_ajax: 1
       };
       jQuery.ajax({
         type: "POST",
         url: action,
         data: form_data,
         success: function(response){
           setTimeout(function(){
             $('#loading').hide();

             location.href="#";
           },2000);
         },
         beforeSend:function(){
            //  $('h1').text("");
            //  $('form').fadeOut(500);
            //  $('#loading').addClass("boxLoading");
         },
         timeout:100000
       });
       return false;
   });
});
