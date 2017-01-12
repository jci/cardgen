<?php

header('Content-type: image/png');

$image = new Imagick('empty.png');

// If 0 is provided as a width or height parameter,
// // aspect ratio is maintained
//$image->thumbnailImage(0, 0);
//
 echo $image;

?>
