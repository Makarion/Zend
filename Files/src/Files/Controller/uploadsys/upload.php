<?php

function upload($argv)
{
        $connection=pg_connect('host=localhost dbname=tutorial user=makarewk password=peperoni08') or die('No i chuj');
       // $rt = pg_query('SELECT * from files ORDER BY id DESC LIMIT 1');
       // $lastId = pg_fetch_row($rt)[0];
	$arguments = $argv;
	unset($arguments[0]);
	foreach($arguments as $arg){

         if(is_file('../pliki/' . $arg)){
                $uploaded = file_get_contents('../pliki/' . $arg);
                $path = pathinfo('../pliki/' . $arg);
                $extension = $path['extension'];
                $name = $path['filename'] . '.'. $path['extension'];
       		 //      $info = new SplFileInfo('../pliki/' . $arg);
       		 //      $name = var_dump($info->getFileName());
                $size = filesize('../pliki/' . $arg);

		echo $uploaded . " ";
                echo $name . " ";
                echo $extension . " ";
                echo $size . PHP_EOL;
//              $escaped = pg_escape_bytea($uploaded);
		$query = pg_query("INSERT INTO files (id,nazwa,typ,rozmiar) VALUES (DEFAULT,'{$name}','{$extension}','{$size}')");
                }
	else
	{
		echo "Plik " . $arg . ' nie istnieje ' . PHP_EOL;
	}

	}
}
?>
