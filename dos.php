<?php


function GetTextSize($font,$text,$max_weight,$max_width){
$size = $max_weight;
$imagick=new Imagick();
while (true){
    $draw = new ImagickDraw();
    $draw->setFontSize($size);
    $draw->setfont($font);
    $bbox2=$imagick->queryFontMetrics($draw,$text);
    $width_of_text = $bbox2[textWidth];
    if ($width_of_text > $max_width){
        $size -= 1;
    }else{
        break;
        }
    }
    return $size;
}


$id=$_GET["id"];

if ($id=="")
{
	$id=1;
}


$mysqli = new mysqli("localhost", "forge", "", "forge");
$result = $mysqli->query("SELECT * from zombie where id=$id") or die("123");
$mytext="";
while($row = $result->fetch_assoc())
{
	//	echo "<a href='view.php?id=" .$row['id'] . "'>";	echo $row['id'] . " " . $row['cardname'] . "</a><br/>";
	$mytext.=$row['description'] . "\n\n";

	$mytext.=$row['day'] . "\n\n";
	$mytext.=$row['night'] ;

	break; continue;
}


header('Content-type: image/png');
/* Text to write */
$text = "Hello World!";

/* Create Imagick objects */
$image = new Imagick('empty.png');
$draw = new ImagickDraw();
$color = new ImagickPixel('#000000');
$white = new ImagickPixel('#FFFFFF');
$background = new ImagickPixel('none'); // Transparent

/* Font properties */


//$draw->setViewBox(0,0,100,100);
$draw->setFont('Arial');
$draw->setFontSize(20);
$draw->setFillColor($color);
$draw->setStrokeAntialias(true);
$draw->setTextAntialias(true);


$inttext = wordwrap($mytext,60,"\n");

$mytext = $inttext;

/* Get font metrics */
$metrics = $image->queryFontMetrics($draw, $mytext, true);

/* Create text */

$draw->setTextAlignment(\Imagick::ALIGN_LEFT);
$draw->annotation(140, 566, wordwrap($row['description'],50,"\n"));
$draw->annotation(140, 698, wordwrap($row['day'],50,"\n"));
$draw->annotation(140, 830, wordwrap($row['night'],50,"\n"));



$draw->setFillColor($white);
// 636/2 = 318
$draw->setTextAlignment(\Imagick::ALIGN_CENTER);


$draw->setFontSize(25);
$metrics = $image->queryFontMetrics($draw,$row['cardname']);
$draw->annotation(318, 56, $row['cardname'] );

/* Create image */

//$fondo = new Imagick('empty.png');

//$image->newImage(700,300,$background);
$image->setImageFormat('png');
$image->drawImage($draw);

echo $image;

?>
