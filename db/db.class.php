<?php
     class DB
     {
      private static $conn;
      static function getConn()
      {
       if(is_null(self::$conn))
       {
        self::$conn = new PDO('mysql:host=127.1.1.1; dbname=socialnetwork', 'root', '');
       }
       return self::$conn;
      }
     }
?>
