<?php

session_start();

if (isset($_SESSION['message_sent']) && $_SESSION['message_sent'] === true) {
  header("Location: index.php?status=alreadysent");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {


  $jsonData = file_get_contents('jsondata.json');

  $data = json_decode($jsonData, true);

  include 'timestamp.php';

  $name = htmlspecialchars($_POST['name']);
  $message = htmlspecialchars($_POST['message']);
  $file = null;
  if (uploadImage()) {
    $file = $_FILES['uploadedImage']['name'];
  }
  $timeStamp = $formattedTime;


  $data[] = (
    [
      "name" => $name,
      "message" => $message,
      "uploadedImage" => $file,
      "time" => $timeStamp,
    ]
  );

  $json = json_encode($data, JSON_PRETTY_PRINT);

  file_put_contents('jsondata.json', $json);
  $_SESSION['message_sent'] = true;
  header("Location: index.php");
  // echo  '<pre>' . $json . "</pre>";
}

function uploadImage()
{
  if ($_FILES['uploadedImage']['error'] !== UPLOAD_ERR_OK) {
    return false;
  }

  $target_dir = "uploads/";
  $file_name = basename($_FILES["uploadedImage"]["name"]);
  $target_file = $target_dir . $file_name;
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
  if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["uploadedImage"]["tmp_name"]);
    if ($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }

  // Check if file already exists
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    return true;
  }

  // Check file size
  if ($_FILES["uploadedImage"]["size"] > 1000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
  ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["uploadedImage"]["tmp_name"], $target_file)) {
      return true;
    }
    return false;
  }
}
