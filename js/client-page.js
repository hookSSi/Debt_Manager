jQuery(document).ready(function(){


    // 탑 알림 배너
    jQuery(".close").click(function(){
      $(".close").parent().slideUp(500);
    });

    $(".top-banner").slideDown("slow",function(){
      $(".top-banner").css("display","flex");
    });

    // 그룹 만들기
   jQuery("#create").click(function(event){
     var action = $("#create").attr('action');
     var form_data =
     {
       groupName: $("#group_name").val(),
       is_ajax: 1
     };
     jQuery.ajax({
       type: "POST",
       url: action,
       data: form_data,
       success: function(response){
         setTimeout(function(){
           $('#loading').hide();
           if(response !== false){
              alert(response);
           }
           else{
              alert(response);
           }
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
   // 그룹 찾아 들어가기
   jQuery("#sign-in").click(function(event){

       var action = $("#sign-in").attr('action');
       var form_data =
       {
         groupName: $("#group_name").val(),
         is_ajax: 1
       };
       jQuery.ajax({
         type: "POST",
         url: action,
         data: form_data,
         success: function(response){
           setTimeout(function(){
             $('#loading').hide();
             if(response !== false){
                alert(response);
             }
             else{
                alert(response);
             }
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
