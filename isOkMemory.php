<?php

$result = memory_get_usage();

 ?>

 <html>
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>
     <p>
     <?php
      echo($result);
      ?>
    </p>
   </body>
 </html>
