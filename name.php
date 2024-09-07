<?php 

require "functions.php";
$name = query("SELECT * FROM images");

if ( isset( $_POST["changename"] ) ) {
  if ( editName() > 0 ) {
    echo "<script>
alert('name changed!');
window.location.href = 'index.php';
    </script>";
  } else {
    echo "<script>
alert('failed to change name');
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
  <link rel="stylesheet" href="css/name.css">
  <title>Change Name</title>
</head>

<body>
  <div class="container">
    <div class="header">
      <h1>Change Name</h1>
      <hr>
    </div>
    <div class="profile-picture">
      <?php foreach( $name as $img ) : ?>
      <ul>
        <li>
          <img src="img/<?= $img["image"]; ?>" width="60" height="60">
          <div class="text">
            <p><?= $img["name"]; ?></p>
          </div>
        </li>
      </ul>
      <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $img["id"]; ?>">
        <label for="name">Change Name: </label>
        <input type="text" name="name" id="name" required> <br>
        <button type="submit" name="changename" class="btn">Change</button>
      </form>
      <a href="index.php" class="change-name">Want to Change Profile? Here</a>
      <?php endforeach; ?>
    </div>
  </div>
</body>

</html>