jQuery(document).ready(function(){

  var toggleButton = $("#option-button");
  var menu = $("#option-menu");
  var icon = $("#option-button");

  toggleButton.click(function(event){
      menu.toggle();

      if(menu.is(':visible') === true){
        icon.css({'transform':'rotate(45deg)'});
      }
      else{
        icon.css({'transform':'rotate(0deg)'});
      }

      return false;
  });

  var iconButton = $(".util-button");
  var nameListContainer = $("#name-list-container");

  iconButton.click(function(event){
    nameListContainer.fadeIn();
    nameListContainer.animate({width: '30%'});

    return false;
  });

});
