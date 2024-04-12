<?php
include 'getMessages.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gastenboek</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <div class="container">

    <div class="Gastenboek">
      <H1 class="GB">Gastenboek</H1>
      <img id="logo" src="512x512bb.jpg" alt="ik" style="width:205px;height:205px;">
      <a href="index.php">
        <button>Terug naar Homepage</button>
      </a>

    </div>
    <div class="messages-container">
      <br>
      <div class="messages">

        <?php
        echo $htmlString;
        ?>

      </div>
      <br>

    </div>

    <div class="NBFV">

      <form class="nb" action="post_information.php" method="post" enctype="multipart/form-data">
        <input type="text" name="name" maxlength="50" required placeholder="Naam">
        <br>
        <input type="text" name="message" maxlength="500" required placeholder="Bericht                (Max:500)">
        <br>
        <input type="file" name="uploadedImage">
        <br>
        <input type="submit" value="Plaats Bericht" name="submit">
        <br>
      </form>

    </div>

  </div>


</body>

</html>

<?php
if (isset($_GET['status']) && $_GET['status'] === "alreadysent") {
  echo "<script> alert('Maximaal aantal berichten bereikt voor deze sessie.'); </script>";
}
?>