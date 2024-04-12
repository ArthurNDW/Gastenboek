<?php
$jsonData = file_get_contents('jsondata.json');

$data = json_decode($jsonData, true);

$htmlString = '';

rsort($data);

if ($data != null) {

    foreach ($data as $message) {
        $htmlString .= "<div class='speech-bubble'>";

        $htmlString .= "<div class='name'>" . $message['name'] . "</div>";
        $htmlString .= "<div class='message'>" . $message['message'] . "</div>";
        if (isset($message['uploadedImage']))
            $htmlString .= "<img class='uploadedImage' src='" . $message['uploadedImage'] . "'>";
        $htmlString .= "<div class= 'time'>" . $message['time'] . "</div>";

        $htmlString .= "</div>";
    }
}
