<?php
//if (extract_teamname_from_cookie("technews") === false)
//    exit;

if(isset($_GET["id"]) &&  (strpos($_GET["id"],'jpg') !== false))//is file type is jpg?
{
#  echo "$_GET["id"]";
  
  header('Cache-control: private');

	preg_match("/^php:\/\/.*resource=([^|]*)/i", trim($_GET["id"]), $matches);
//die ("<pre>" . trim($_GET["id"]));
//die ("<pre>///".print_r($matches, true)."///");
	if (isset($matches[1]))
		$_GET["id"] = $matches[1];

	if (file_exists("./" . $_GET["id"]) == false)
		die("file not found");
	if (substr(realpath("./" . $_GET["id"]), 0, 24) != "/var/www/technology-news")
		die(".");

	header('Content-Type: image/jpg');
	header('Content-Length: '.filesize($_GET["id"]));
	header('Content-Disposition: filename='.$_GET["id"]);

	$img_data = file_get_contents($_GET["id"]);
	$img_data = sharifctf_internal_put_it($img_data, "technews");
	echo $img_data;
  
}
else //file type is not jpg! show the error message
{
	echo "file not found";
}