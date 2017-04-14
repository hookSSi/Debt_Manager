<?php
require_once("../class/group_class.php");
require_once("../class/account_class.php");
require_once("../class/userinfo_class.php");
require_once("../class/common_function.php");

$Group = new Group();

if(isset($_POST['keyword']) && isset($_POST['list_count'])){

  $keyword = $_POST['keyword'];
  $count = $_POST['list_count'];

  $result = $Group->GetGroupListByName2($keyword, $count);

  if($result != null ){
    $str = '';
    if(count($result) > 0){
      foreach ($result as $row)
      {
        $str .= "<li><a href='#' class = 'group-list-element'>"."<img src='#' alt='image not found'><div>".$row['groupName']."</div></a></li>";
      }
      echo($str);
    }
    else{
      echo 'none';
    }
  }
  else{
    echo 'none';
  }

}
else {
  echo 'failed';
}

?>
