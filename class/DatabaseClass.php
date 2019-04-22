<?php

class DatabaseClass
{

  // function __construct(argument)
  // {
  //   // code...
  // }
  public function dbConnect()
  {
    $db['host'] = "localhost";  // DBサーバのURL
    $db['user'] = "root";  // ユーザー名
    $db['pass'] = "";  // ユーザー名のパスワード
    $db['dbname'] = "novelkosaku_db";  // データベース名
    $dsn = 'mysql:host=localhost;dbname=novelkosaku_db;charset=utf8';
    return new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
  }
}

 ?>
