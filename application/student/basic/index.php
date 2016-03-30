<div class="mainbar">
    <div class="article">
<?
	if(isset($_GET["task"]))
		include $_GET["task"].'.php';
	else
		include 'default.php';
?>
	</div>
</div>