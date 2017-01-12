<?
$mysqli = new mysqli("localhost", "forge", "", "forge");
if (isset($_GET["id"]))
{
	$result = $mysqli->query("SELECT * from zombie where id=" . $_GET["id"] .  " ") or die("123");
	$row = $result->fetch_assoc();

?>	
<table border=1>
<tr>
<td>
<form action="view.php" method="POST">
cardname : <input type="text" name="cardname" value='<? echo $row['cardname']; ?>'>
<input type="hidden" name="id" value="<?  echo $_GET["id"]; ?>">
<br />
Description:
<textarea name="description" cols=40 rows=10><? echo $row["description"]; ?></textarea>
<br/>
day : 
<textarea name="day" cols=40 rows=10><? echo $row["day"]; ?></textarea>
<br/>
night:
<textarea name="night" cols=40 rows=10><? echo $row["night"]; ?></textarea>
<br/>
skippable?
<input type="checkbox" name="skippable" checked>
<br/>
<input type="submit">
</form>
</td>
<td>
<img src="dos.php?id=<? echo $row["id"]; ?> " height="60%">
</td>
</tr>
</table>
<a href="index.php">Main</a>

<?

}

if (isset($_POST["id"]))
{

	$result = $mysqli->query("update zombie set day='" .  $mysqli->real_escape_string($_POST["day"]) . "', night='" .  $mysqli->real_escape_string($_POST["night"]).  "', cardname='" .  $mysqli->real_escape_string($_POST["cardname"]). "',	description='" . $mysqli->real_escape_string($_POST["description"]). "' where id=' " . $_POST["id"].  " '") or die("123");

	header("Location: view.php?id=" . $_POST['id']);
}
?>
