<?php
//insert.phpの処理を持ってくる
//1. POSTデータ取得
$book_name   = $_POST["book_name"];
$book_URL  = $_POST["book_URL"];
$book_comment    = $_POST["book_comment"];
$id = $_POST["id"];

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//３．データ更新SQL作成（UPDATE テーブル名 SET 更新対象1=:更新データ ,更新対象2=:更新データ2,... WHERE id = 対象ID;）
//３．SQL文を用意(データ登録：INSERT)
$stmt = $pdo->prepare(
    "UPDATE gs_bm_table SET book_name=:book_name, book_URL=:book_URL, book_comment=:book_comment, indate=sysdate() WHERE id=:id" );
  
  // 4. バインド変数を用意
  $stmt->bindValue(':book_name', $book_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
  $stmt->bindValue(':book_URL', $book_URL, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
  $stmt->bindValue(':book_comment', $book_comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
  
  // 5. 実行
  $status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
  } else {
    redirect('select.php');
  }