<?php
function IsInputValid($value, $limit)
{
  if($value != "")
  {
    if(mb_strlen($value,'UTF-8') > $limit)
    {
      return true;
    }
    else
    {
      return false;
    }
  }
  else
  {
    return false;
  }

  return false;
}
?>
