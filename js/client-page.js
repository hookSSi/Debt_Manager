jQuery(document).ready(function(){
    // 탑 알림 배너
    jQuery(".banner-close").click(function(event){
      event.preventDefault();
      $(".banner-close").parent().slideUp(500);
      return false;
    });

    jQuery(".top-banner").slideDown("slow",function(){
      $(".top-banner").css("display","flex");
      return false;
    });

    // 메뉴
    jQuery(".dropdown").click(function(event){
      event.preventDefault();
      $(".dropdown-content").slideToggle(500);
      return false;
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
         if(response == 'success'){
           setTimeout(function(){
             $('#loading').hide();
             $('#group-form>button').show();

             location.href="./inside-group-page.php";
           },2000);
         }
         else{
           $('#loading').hide();
           $('#group-form>button').show();

           alert("그룹이름이 유효하지 않습니다.");
         }
       },
       beforeSend:function(){
           $('#loading').show();
           $('#group-form>button').hide();
       },
       timeout:100000
     });
     return false;
   });

   // 처음 데이터 불러오기
   function FirstLoad(container, value, count, event)
   {
     $.ajax({
       type: "POST",
       url: "./util/group_list_first_load.php",
       data: {keyword : value, list_count : count},
       success: function(response){
         if(response == 'failed'){
           setTimeout(function(){
             alert("그룹리스트를 불러오는 데 실패했습니다.");

             location.href="./client-page.php";
           }, 2000);
         }
         else if(response == 'none'){
            $(".loaderContainer").hide();
         }
         else { // 데이터를 불러오는 데 성공했을 경우
           container.empty();
           container.append(response);
           $(".loaderContainer").hide();
         }
       },
       beforeSend:function(){
         $(".loaderContainer").show();
       },
       timeout:100000
     });
   }

   // 데이터 좀 더 불러오기
   function MoreLoad(container, value, lastValue, count)
   {
     $.ajax({
       type: "POST",
       url: "./util/group_list_more_load.php",
       data: {keyword : value, lastListValue : lastValue, list_count : count},
       success: function(response){
         if(response == 'failed'){
           setTimeout(function(){
             alert("그룹리스트를 불러오는 데 실패했습니다.");

             location.href="./client-page.php";
           }, 2000);
         }
         else if(response == 'none')
         {
           $(".loaderContainer").hide();
         }
         else { // 데이터를 불러오는 데 성공했을 경우
           container.append(response);
           $(".loaderContainer").hide();
         }
       },
       beforeSend:function(){
         $(".loaderContainer").show();
       },
       timeout:100000
     });
     return false;
   }

   // 그룹 찾기 클릭 이벤트
   jQuery("#search-group").click(function(event){
      var groupListDoc = $("#group-list");
      groupListDoc.empty(); // 초기화

      $("#overlay").fadeIn(1000);
      $(".popupContainer").fadeIn(1000);
      $(".popupContainer").css("animation-name","popupAnimation");

      var groupSearchkeyword = $("#group-name").val();
      $("#group-name-to-search").val(groupSearchkeyword);
      var firstLoadCount = 5;

      FirstLoad(groupListDoc ,groupSearchkeyword,firstLoadCount);
      return false;
   });

   // 텍스트 변경 이벤트
   $("#group-name-to-search").on("input propertychange",function(event){
      var groupListDoc = $("#group-list");
      groupListDoc.empty(); // 초기화

      var groupSearchkeyword = $("#group-name-to-search").val();
      var firstLoadCount = 5;

      FirstLoad(groupListDoc ,groupSearchkeyword,firstLoadCount);
      return false;
   });

   // 스크롤 로딩 이벤트
   jQuery(function(){
     var loadCount = 5;

     $("#inside-search-group-window").scroll(function(){
        var searchWindow = $("#inside-search-group-window");
        var groupListDoc = $("#group-list");

        var groupSearchkeyword = $("#group-name-to-search").val(); // 검색 키워드
        var lastGroupName = $("#group-list>li:last-child>a>div").text(); // 리스트 마지막 요소
        var loadCount = 5;

        if((groupListDoc.height() - searchWindow.scrollTop() + 100) < searchWindow.height()){
            MoreLoad(groupListDoc, groupSearchkeyword, lastGroupName,loadCount);
            return false;
        }
     });
   });

   // 그룹 찾기 취소 이벤트
   jQuery("#overlay").click(function(event){
     event.preventDefault();
     $("#overlay").fadeOut(100);
     $(".popupContainer").fadeOut(100);
     $(".popupContainer").css("animation-name","");
     return false;
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
