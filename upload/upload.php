<?php

	ini_set('display_errors','OFF');
	$connection=pg_connect('host=localhost dbname=tutorial user=makarewk password=peperoni08') or die('No i chuj');

	//$uploaded = file_get_contents('../pliki/plik1.txt');	
	$files = scandir('../pliki/');
	$rt = pg_query('SELECT * from files ORDER BY id DESC LIMIT 1');
	$lastId = pg_fetch_row($rt)[0];	

	foreach ($files as $file)
	{
		$uploaded = file_get_contents('../pliki/' . $file);
		$path = pathinfo('../pliki/' . $file);
		$extension = $path['extension'];
                $name = $path['filename'] . '.'. $path['extension'];
	//	$info = new SplFileInfo('../pliki/' . $file);
	//	$name = var_dump($info->getFileName());
		$size = filesize('../pliki/' . $file); 		
				
		if ($extension === 'txt')
		{
			echo $name . " ";
			echo $extension . " ";
			echo $size . PHP_EOL;
			$escaped = pg_escape_bytea($uploaded);
//			$query = pg_query("INSERT INTO files (id,nazwa,typ,rozmiar,content) VALUES (DEFAULT,'{$name}','{$extension}','{$size}','{$escaped}')");
	//		$query = pg_query("INSERT INTO files (id,nazwa,typ,rozmiar,content) SELECT '{$lastId}','{$name}','{$extension}','{$size}','{$escaped}' WHERE NOT EXISTS ( SELECT nazwa FROM files WHERE nazwa = '{$name}')");
		}
	}


	//echo $lastId . PHP_EOL;
?>
