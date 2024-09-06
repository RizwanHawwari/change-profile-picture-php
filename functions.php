<?php 
$servername = "localhost";
$username = "root";        
$password = "";            
$database = "profile";

$conn = mysqli_connect($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function query($query) {
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function edit() {
  global $conn;
  $image = upload();
  if ( !$image ) {
    return false;
  }

  $query = "UPDATE images SET
  image = '$image'
  WHERE id = 1
  ";
  $result = mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function upload() {
  global $conn;
  
  $nameFile = $_FILES["image"]["name"];
  $tmpName = $_FILES["image"]["tmp_name"];
  $size = $_FILES["image"]["size"];
  $error = $_FILES["image"]["error"];

  if ( $error == 4 ) {
    echo "<script>
    alert('Please Insert File');
    </script>";

    return false;
  }

  $validExtension = ['jpg', 'jpeg', 'gif', 'png'];
  $extension = explode(".", $nameFile);
  $extension = strtolower(end($extension));
  if (!in_array($extension, $validExtension)) {
    echo "<script>
alert('The file you uploaded is not an image');
    </script>";

    return false;
  }

  if ( $size > 1000000 ) {
    echo "<script>
alert('The size of the image is too large');
    </script>";

    return false;
  }

  $newNameFile = uniqid();
  $newNameFile .= "." . $extension;
  move_uploaded_file($tmpName,  'img/' . $newNameFile);
  
  return $newNameFile;
}
?>