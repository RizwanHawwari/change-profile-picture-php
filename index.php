<?php 

require "functions.php";
$image = query("SELECT * FROM images");

if ( isset( $_POST["submit"] ) ) {
  if ( edit() > 0 ) {
    echo "<script>
alert('picture changed!');
window.location.href = 'index.php';
    </script>";
  } else {
    echo "<script>
alert('failed to change picture');
    </script>";

    return false;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styles.css">
  <title>Change Profile</title>
</head>

<body>
  <div class="container">
    <div class="header">
      <h1>Change Profile</h1>
      <hr>
    </div>
    <div class="profile-picture">
      <?php foreach( $image as $img ) : ?>
      <ul>
        <li>
          <img src="img/<?= $img["image"]; ?>" width="60" height="60">
          <div class="text">
            <p>Future</p>
          </div>
        </li>
      </ul>
      <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $img["id"]; ?>">
        <label for="image">Insert File: </label>
        <input type="file" name="image" id="image" required> <br>
        <button type="submit" name="submit" class="btn">Change</button>
      </form>
      <?php endforeach; ?>
    </div>
  </div>
</body>

</html>