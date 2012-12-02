<?php

$endpoint = "http://sleepy-river-2588.herokuapp.com";

if (!empty($_GET['action'])) {
	$action = $_GET['action'];
	$bookId = $_GET['bookId'];

	switch ($action) {

		case 'lookupBook':
			lookupBook($bookId);
			break;

		case 'listAll':
			listAll(true);
			break;

		case 'searchBooks':
			searchBooks($query);
			break;
	}
}

function listAll($echo=false) {
	global $endpoint;

	$request = $endpoint . "/books";

	$response  = file_get_contents($request);

	if ($echo) {
		echo $response;
	} else {
		$jsonobj  = json_decode($response);
		return $jsonobj;
	}
}

function lookupBook($bookId) {
	global $endpoint;

	$request = $endpoint . "/book/" . $bookId;
	$response = file_get_contents($request);

	echo $response;
}

function searchBooks($query, $echo=true) {
	global $endpoint;

	$request = $endpoing . "/searchBooks/" . $query;
	$response = file_get_contents($request);

	if ($echo) {
		echo $response;
	} else {
		$jsonobj = json_decode($response);
		return $jsonobj;
	}
}