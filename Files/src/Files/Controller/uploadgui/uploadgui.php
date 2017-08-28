<?php

   //     $connection=pg_connect('host=localhost dbname=tutorial user=makarewk password=peperoni08') or die('No i chuj');

    //    $uploaded = file_get_contents('../pliki/' . $arg);

	if(isset($_FILES['file']))
	{
		$file = $_FILES['file'];
		
		$name = $file['name'];
		$tmp = $file['tmp_name'];
		$type = $file['type'];
		$size = $file['size'];
		$error = $file['error'];
		
		$extension = explode('.',$name);
		$extension = strtolower(end($extension));

	}

	echo $name . PHP_EOL;

//	$query = pg_query("INSERT INTO files (id,nazwa,typ,rozmiar) VALUES (DEFAULT,'{$name}','{$extension}','{$size}')");
?>
