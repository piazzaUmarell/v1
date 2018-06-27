<!doctype html>
<html lang="it">

  <head>
  </head>
  <body >
    <?php
      $index=0;
      if(date("N")==7) 
      {
        if(file_exists("umarell_puntate_new.xml")){
          while(file_exists("umarell_puntate_old_" .$index.".xml")) $index++;
          rename("umarell_puntate.xml", "umarell_puntate_old_" .$index.".xml");
          rename("umarell_puntate_new.xml","umarell_puntate.xml");
        }
      }
    ?>
  </body>
</html>
