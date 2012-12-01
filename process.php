<?php

function listAll($endpoint="http://sleepy-river-2588.herokuapp.com/books") {
	$request = $endpoint;

	$response  = file_get_contents($endpoint);
	$jsonobj  = json_decode($response);
	return $jsonobj;
}