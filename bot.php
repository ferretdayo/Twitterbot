<?php

require_once ('twitteroauth.php');
require_once ('config.php');

$conn = new TwitterOAuth('/*コンシューマーなちゃらなど*/','','','');

$count = 0;
$take=0;

$fp = fopen('tweet.txt','r');

flock($fp,LOCK_SH);

while(!feof($fp)){//行数を数える
	$result = fgets($fp);

	$count += 1;
}
flock($fp,LOCK_UN);

$i = rand(1,$count);

echo $count.'<br>';

echo $i.'<br>';

function fileop($i){

	$count = 1;

	$fp = fopen('tweet.txt','r');

	flock($fp,LOCK_SH);

	while(!feof($fp)){
		$result = fgets($fp);
		if($count == $i){
			return $result;
		}
		$count += 1;
	}
	flock($fp,LOCK_UN);
}

$msg = fileop($i);

$params = array(

		'status' => $msg

);

$result = $conn->post('statuses/update',$params);

var_dump($result);

?>
