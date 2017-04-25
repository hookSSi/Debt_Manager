//document.domain = "https://sinabro.com/admin";

jQuery(document).ready(function(){

  // CSS 일부 자동적으로 생성
  var pageCount = $(".fa-ul a").length;

  $("section").css("width", "400%");

  for(var i = 0; i < pageCount; i++)
  {
    $("section").wrap("<div class = 'ct' id = 't" + (i+1) +"' ></div>");

    $("#p" + (i+1)).css("left", (100*i) + "%");

    $("#p" + (i+1)).append("<ul class = 'bg-bubbles'></ul>");
    var ul = $("#p" + (i+1) + " .bg-bubbles");
    $(ul).attr("id","bg-bubbles" + (i+1));

    if(i !== 0)
      CreateBubble(i+1);
  }

  function CreateBubble(pageNum)
  {
    var bubbleCount = 10;

    if(($("#bg-bubbles" + (pageNum) + "li").length != bubbleCount))
    {
      for(var j = 0; j < bubbleCount; j++)
      {
        $("#bg-bubbles" + (pageNum)).append("<li></li>");
      }
    }
  }


  // 데이터 베이스 리셋
  jQuery("#reset_or_install").click(function(event){
      var result = confirm('데이터베이스 정보가 모두 리셋됩니다. 계속하겠습니까?');
      if(result){
        var action = $("#reset_or_install").parent().attr('action');
        var form_data = {
          information: "admin informaion 확인"
        };
        jQuery.ajax({
          type: "POST",
          url: action,
          data: form_data,
          success: function(response){
            if(response == 'success'){
              $(".loader").remove();
              alert("데이터베이스가 리셋 되었습니다!");
            }
            else{
              $(".loader").remove();
              alert("요청한 수행이 실패했습니다! 축하드립니다!");
            }
          },
          beforeSend: function(){
            $("#reset_or_install").parent().append("<span class = 'loader loader-quart'></span>");
          },
          timeout:100000
        });
        return false;
      }
      else {
        return false;
      }
    });
});
