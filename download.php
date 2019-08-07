<?php

    define("URL", "https://books.zoho.com/api/v3/invoices/print?organization_id=677074428");

	$header = ['Authorization: Zoho-authtoken 4865853d7d34b1053b2b82f77c362d9b'];
	
	$curl = curl_init(URL);
    curl_setopt_array($curl, array(
	  CURLOPT_HTTPHEADER => $header,
	  CURLOPT_HTTPGET => 1,
	  CURLOPT_RETURNTRANSFER => true
	));
	$download_invoices = curl_exec($curl);



	function _Download($f_location, $f_name){
		$file = uniqid() . '.pdf';
	
		file_put_contents($file,file_get_contents($f_location));
	
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Length: ' . filesize($file));
		header('Content-Disposition: attachment; filename=' . basename($f_name));
	
		readfile($file);
	}
	
	_Download($_GET['file'], "file.pdf");

?>