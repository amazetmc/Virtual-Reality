<?php
$id = $_GET['id']; // Get the maps panorama ID

if($id == "undefined"){ // Check to see if user has moved from the starting pos (Which is undefined cause screw you google)
  die("Please move from the starting pos"); // Stop PHP from processing any more
}

if (!file_exists("assets/img/$id/build.jpg")){ // if the current panorama has been generated, dont remake it.
  mkdir("assets/img/$id/"); // Make the directory for the images
  for ($x=0; $x <13 ; $x++) { // For every row in the Y axis
    for ($i=0; $i <26 ; $i++) { // For every row in the Y axis
      $tmp = file_get_contents("http://cbk0.google.com/cbk?output=tile&panoid=$id&zoom=5&x=$i&y=$x"); // load the tile from google
      file_put_contents("assets/img/$id/$x-$i.jpg",$tmp); // Save the tile
    }
  }

  $image = new Imagick(); // Initialize Imagick with the $image variable
  $image->newImage(13312, 6656, new ImagickPixel('none')); // Create a blank image
  $image->setImageFormat('jpg'); // Make it a jpeg
  $image->setCompression(Imagick::COMPRESSION_JPEG); // Add some compression algorithm
  $image->setCompressionQuality(80); // compress the image

  for ($x=0; $x <13 ; $x++) { // For every row in the Y axis
    for ($i=0; $i <26 ; $i++) { // For every row in the X axis
      $img2 = new Imagick("assets/img/$id/$x-$i.jpg"); // Initialize Imagick on the tile
      $image->compositeImage($img2, Imagick::COMPOSITE_DEFAULT, 512*$i, 512*$x); // Place the tile on the blank image with matching offsets
    }
  }
  $image->setImageFileName("assets/img/$id/build.jpg"); // Set the storage location for the final iamge
  $image->writeImage(); // Save it

  for ($x=0; $x <13 ; $x++) { // For every row in the Y axis
    for ($i=0; $i <26 ; $i++) { // For every row in the X axis
      unlink("assets/img/$id/$x-$i.jpg");
    }
  }

  }

$filename = "assets/img/$id/build.jpg"; // Set the filename variable to point to the build.jpg

?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


<script src="https://aframe.io/releases/0.2.0/aframe.min.js"></script> <!-- Load AFrame -->
<div class="container">
  <a-scene> <!-- Create A-Scene -->
        <a-sky src="<?php echo $filename?>" rotation="0 -130 0"></a-sky> <!-- Create a skybox (panorama) with the php echo of the filepath -->
  </a-scene>
<div class="container">
