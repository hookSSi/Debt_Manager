jQuery(document).ready(function(){

  var toggleButton = $("#option-button");
  var menu = $("#option-menu");
  var icon = $("#option-button");
  var type = "#"; // 버튼의 타입

  toggleButton.click(function(event){
      menu.toggle();

      if(menu.is(':visible') === true){ // + 눌렀을 때
        icon.css({'transform':'rotate(45deg)'});
      }
      else{ // X 눌렀을 때
        icon.css({'transform':'rotate(0deg)'});
        nameListContainer.fadeOut();
        nameListContainer.animate({width: '0%'});
        type = "#";
      }

      return false;
  });

  var iconButton = $(".util-button");
  var nameListContainer = $("#name-list-container");


  iconButton.click(function(event){
    nameListContainer.fadeIn();
    nameListContainer.animate({width: '30%'});
    type = $(this).attr('href');

    return false;
  });

  var nameBox = $(".name-box");
  var overlay = $("#overlay");

  nameBox.click(function(event){

    switch (type) {
      case "#돈":
        break;
      case "#이모티콘":
        break;
      case "#알림":
        break;
      default:
        return false;
    }

    return false;
  });
});
