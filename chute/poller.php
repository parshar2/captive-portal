<?php


poll_ads();

function poll_ads() {
    $polling_url = "http://shopperts.in:8080/AgentOnboardingEngine/AgentListServlet";;
    $last_poll_time = 124;

    $curl = curl_init();

    $url = $polling_url . '?mac=' . urlencode($last_poll_time);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POST, 0);

    $result = curl_exec($curl);
    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    curl_close($curl);

    echo $result;
}

?>