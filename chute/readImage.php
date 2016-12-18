<?php


$count = "1000000"; 
$ar = array();
$name = "Hello";
/*$file = fopen("ads.txt","r") or die("fail to open file");
while(! feof($file)){ 

     
  $ar = fgetcsv($file);
  $qb =  intval($ar[6]);
  $x = intval($count); 
  
  if ($qb < $x) {
      $count = $ar[6];
      $name = trim($ar[0]);   
    }       
  }

fclose($file); */
$file = "ads.txt";
if (($handles = fopen($file, "r")) !== FALSE) {
    while (($datas = fgetcsv($handles, 0, ",")) !== FALSE) {
        $qb =  intval($datas[6]);
        $x = intval($count); 
        if ($qb < $x) {
            $count = $datas[6];
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
         $infos[] = trim($data[0]) . ',' . $data[1] . ',' . $data[2] . ',' . $data[3] . ',' . $data[4] . ',' . $data[5] . ',' . $finalval . ',' . $data[7] . ',' . $data[8] . ',' . $data[9] . ',' . $data[10] . ',' . trim($data[11]);   
        }
    }
    fclose($handle);
}
ob_clean;

$fp = fopen('write.txt', 'w');
 
foreach ($infos as $info) {
    fputcsv($fp, array($info),',',chr(0));
}
 
fclose($fp);

$fn = (string)($name.'.jpg');
$type = 'image/jpeg';
header('Content-Type:'.$type);
header('Content-Length: ' . filesize($fn));
readfile($fn);

unlink("ads.txt");
rename("write.txt","ads.txt");

?>