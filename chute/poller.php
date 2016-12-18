<?php

poll_ads();
//fetch_image();
//return_image();

function poll_ads() {
    //$polling_url = "http://shopperts.in:8080/AgentOnboardingEngine/AgentListServlet";
    $polling_url = "http://159.203.138.122/ads/api/";
    $last_poll_time = 124;

    $curl = curl_init();

    $url = $polling_url . '?last_poll_time=' . urlencode($last_poll_time);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POST, 0);

    $result = curl_exec($curl);
    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    echo $result;
    curl_close($curl);

    decode_ads($result);
}

function decode_ads($ad_string){
  $ads = json_decode($ad_string);
  $ad_file = fopen("ads.txt", "a");
  foreach ($ads as $ad){
     $uuid = $ad->uuid;
     $name = $ad->name;
     $description = $ad->description;
     $date_submitted = $ad->date_submitted;
     $date_approved = $ad->date_approved;
     $duration = $ad->duration;
     $status = $ad->status;
     $impressions = $ad->impressions;
     $purchased_amount = $ad->purchased_amount;
     $time_remaining = $ad->time_remaining;
     $image = $ad->image;
     fetch_image($image_url, $uuid);
     $thumbnail = $ad->thumbnail;
     fwrite($ad_file, $uuid.",".$name.",".$description.",".$date_submitted.",".$date_approved.",".$duration.",".$status.",".$impressions.",".$purchased_amount.",".$time_remaining.",".$im
age.",".$thumbnail."\n");
  }
  fclose($ad_file);
}


function fetch_image($image_url, $uuid){
        //Get the file
        //$image_url = "https://paradrop-leaflets.s3.amazonaws.com/media/ads/images/creative-advertisement_13.jpg";
        $content = file_get_contents($image_url);
        $fp = fopen($uuid.".png", "w");
        fwrite($fp, $content);
        fclose($fp);

}

function return_image(){
        header('Content-Type: image/png');
        readfile('ad_tim.png');
        exit;
}
?>