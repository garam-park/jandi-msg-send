<?php
require __DIR__ . '/../vendor/autoload.php';

use Garam\Jandi\JandiSender;

$uri = "";

$sender = new JandiSender($uri);

$sender->sendSimpleMessage("hello");

$connectInfos =[
	[
		"title" => "title1",
		"description" => "description1",
	],
	[
		"title" => "title2",
		"description" => "description2",
	],
	[
		"title" => "title3",
		"description" => "description3",
		"imageUrl" => "http://4.bp.blogspot.com/-C1rlYxSvpG4/UJH3ftWTSkI/AAAAAAAAAGU/CVZUc02KOYs/s1600/1350016265_ok.jpg"

	],
];
$sender->sendDetailMessage("hello",$connectInfos);