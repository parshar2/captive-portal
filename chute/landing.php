<?php

function getImageFilename() {
  $count = "1000000"; 
  $ar = array();
  $name = "Hello";
  $file = "ads.txt";
  if (($handles = fopen($file, "r")) !== FALSE) {
      while (($datas = fgetcsv($handles, 0, ",")) !== FALSE) {
          $qb =  intval($datas[7]);
          $x = intval($count); 
          if ($qb < $x) {
              $count = $datas[7];
              $name = trim($datas[0]);   
          }  
      }
      fclose($handles);
  }

  $finalval = intval($count)+1;
  $infos = array();
  $file_name = "ads.txt";
  if (($handle = fopen($file_name, "r")) !== FALSE) {
      while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
          if($name != trim($data[0])){
            $infos[] = trim($data[0]) . ',' . $data[1] . ',' . $data[2] . ',' . $data[3] . ',' . $data[4] . ',' . $data[5] . ',' . $data[6] . ',' . $data[7] . ',' . $data[8] . ',' . $data[9] . ',' . $data[10] . ',' . trim($data[11]);
          } else {
            $infos[] = trim($data[0]) . ',' . $data[1] . ',' . $data[2] . ',' . $data[3] . ',' . $data[4] . ',' . $data[5] . ',' . $data[6] . ',' . $finalval . ',' . $data[8] . ',' . $data[9] . ',' . $data[10] . ',' . trim($data[11]);   
          }
      }
      fclose($handle);
  }
  ob_clean();

  $fp = fopen('write.txt', 'w');
   
  foreach ($infos as $info) {
      fputcsv($fp, array($info),',',chr(0));
  }
   
  fclose($fp);
  //$fn = (string)($name.'.jpg');
  //$type = 'image/jpeg';
  //header('Content-Type:'.$type);
  //header('Content-Length: ' . filesize($fn));
  //readfile($fn);
  unlink("ads.txt");
  rename("write.txt","ads.txt");
  echo $name . '.jpg';
}
?>

<head>
<link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
<header class="header">
  <ul>
    <li class="cor-1"></li>
    <li class="cor-2"></li>
    <li class="cor-3"></li>
    <li class="cor-4"></li>
    <li class="cor-5"></li>
  </ul>
  </header>
<div class="wrap">
  

<nav class="menu">
  <ul>
    <li>
      <a href="#">Home</a>
    </li>
    <li>
      <a href="#">About</a>
    </li>
    <li>
      <a href="#">Contact</a>
    </li>
  </ul>
  </nav>
    <aside class="sidebar">
    <div class="widget">
    
      <p>Ad Sponsored By STARBUCKS Router</p>
      </div>
  </aside>
    <div class="blog">

    <div class="conteudo">
    <div class="post-info">
      STARBUCKS Ad
    </div>
    <img src="<?php getImageFilename();?>">
    
      <a target="_blank" href="index.php" class="continue-lendo">Continue to Internet →</a>
  </div>
  </div>
</div>
</body>