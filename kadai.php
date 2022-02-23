<?php
  date_default_timezone_set('Asia/Tokyo');
  $result = "";
  $data = date("Y/m/d H:i:s");
  $kadai_file = 'kadai.txt';

  if (isset($_POST['syukkin'])) { //出勤
      $fp = fopen($kadai_file, 'a');
      if ($fp){
         if (flock($fp, LOCK_EX)){
            if (fwrite($fp,  "<tr><td>".$data . "     出勤"."</td></tr>". PHP_EOL) === FALSE){
               print('ファイル書き込みに失敗しました');
            }
               flock($fp, LOCK_UN);
         }else{
          print('ファイルロックに失敗しました');
         }
      }
      fclose($fp);
  }
  elseif (isset($_POST['taikin'])) { //退勤
      $fp = fopen($kadai_file, 'a');
      if ($fp){
         if (flock($fp, LOCK_EX)){
             if (fwrite($fp,  "<tr><td>".$data . "     退勤"."</td></tr>". PHP_EOL) === FALSE){
                 print('ファイル書き込みに失敗しました');
             }
             flock($fp, LOCK_UN);
         }else{
             print('ファイルロックに失敗しました');
         }
      }
      fclose($fp);
   }
  elseif (isset($_POST['kyuukei'])) { //休憩
      $fp = fopen($kadai_file, 'a');
      if ($fp){
         if (flock($fp, LOCK_EX)){
             if (fwrite($fp,  "<tr><td>".$data . "     休憩"."</td></tr>". PHP_EOL) === FALSE){
                 print('ファイル書き込みに失敗しました');
             }
             flock($fp, LOCK_UN);
         }else{
             print('ファイルロックに失敗しました');
         }
      }
      fclose($fp);
   }
  else { //戻り
      $fp = fopen($kadai_file, 'a');
      if ($fp){
         if (flock($fp, LOCK_EX)){
             if (fwrite($fp,  "<tr><td>".$data . "     戻り"."</td></tr>". PHP_EOL) === FALSE){
                 print('ファイル書き込みに失敗しました');
             }
             flock($fp, LOCK_UN);
         }else{
             print('ファイルロックに失敗しました');
         }
      }
     fclose($fp);
}
echo $result;
?>

<!DOCTYPE html>
<html>
 <head>
    <meta charset="utf-8">
    <title>1984</title>
    <link href="css/kadai.css" rel="stylesheet">
    <script src="script/jikoku.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Ravi+Prakash" rel="stylesheet">
 </head>
<body>
   <headre class="yohaku"></headre>
    <div class="oya">
     <p id="showTime"></p>
     <div class="botan">
         <div class="botan1">
          <form action="kadai.php" method="post"> 
           <input type="submit" name="syukkin">
           <img id="btn-send" src="image/syukkin.png" alt=出勤>
          </form>
         </div>
         <div class="botan1">
          <form action="kadai.php" method="post"> 
           <input type="submit" name="taikin">
           <img id="btn-send" src="image/taikin.png" alt=退勤>
          </form>
         </div>
         <div class="botan1">
          <form action="kadai.php" method="post"> 
           <input type="submit" name="kyuukei">
           <img id="btn-send" src="image/kyuukei.png" alt=休憩>
          </form>
         </div>
         <div class="botan1">
          <form action="kadai.php" method="post"> 
           <input type="submit" name="modori">
           <img id="btn-send" src="image/modori.png" alt=戻り>
          </form>
         </div>
      </form>     
     </div>
     <div class="hyouji">
      <table class="table"> <!-- 表示-->
       
       <?php
	     $tmp = file($kadai_file);			// ファイル内容を一行ずつ配列に取得
	     $allbody = array_reverse($tmp);	// 配列の内容を逆順にする
	     foreach($allbody as $line){
		  $buf = preg_split("/\t/", $line);
		  $line = $buf[0];
		  print $line;
         }
       ?>
     
     </table>
     </div>
 </body>
</html>
