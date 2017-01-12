<?
$mysqli = new mysqli("localhost", "forge", "", "forge");
$result = $mysqli->query("SELECT * from zombie") or die("123");
while($row = $result->fetch_assoc())
{
	echo "<a href='view.php?id=" .$row['id'] . "'>";	echo $row['id'] . " " . $row['cardname'] . "</a><br/>";
}
?>
