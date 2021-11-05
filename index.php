<?php 

include('./views/header.php');
include_once("./models/FileAndFolder.php");

$file = new FileAndFolder();
$pathToFile = "./file.txt";
$file->writeFile($pathToFile);
 
$result = $file->search();
?>

<title>Netpay Files</title>

<?php include('./views/navbar.php');?>

<div class="container">
	<h2>Search Files </h2>	
	<br>	
	<div class="row">	 
		<div class="col-md-12">
		<form class="form-inline" action="/search" method="post">
			<div class="form-group">
				<input type="text" class="form-control" name="search" placeholder="Search">
			</div>
			<button type="submit" class="btn btn-default">Search</button>
		</form>
		</div>
		<?php if (isset($_REQUEST['search'])) : ?>
			<?php foreach ($result as $value) { ?>
			<pre><?php echo $value ?></pre>
			<?php } ?>
		<?php endif; ?>
	</div>
	
</div>
<?php include('./views/footer.php');?>
