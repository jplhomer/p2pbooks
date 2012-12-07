<?php

// Fill with your API's endpoint
$endpoint = "";

require_once("./auth.php");

if (isset($_SESSION['p2pbooksuser'])) {
	$p2pbooksuser = $_SESSION['p2pbooksuser'][0];
}

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

		case 'listAllCampuses':
			listAllCampuses(true);
			break;
	}
}

if (!empty($_POST['action'])) {
	$action = $_POST['action'];

	switch ($action) {

		case 'addBook':
			addBook($_POST);
			break;

		case 'createUser':
			createUser($_POST);
			break;

		case 'requestBook':
			requestBook($_POST);
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

function listAllCampuses($echo=false) {
	global $endpoint;

	$request = $endpoint . "/campuses";

	$response  = file_get_contents($request);

	if ($echo) {
		echo $response;
	} else {
		$jsonobj  = json_decode($response);
		return $jsonobj;
	}
}

function lookupBook($bookId, $echo=true) {
	global $endpoint;

	$request = $endpoint . "/book/" . $bookId;
	$response = file_get_contents($request);

	if ($echo) {
		echo $response;
	} else {
		$jsonobj = json_decode($response);
		return $jsonobj;
	}
}

function searchBooks($query, $echo=true) {
	global $endpoint;

	//$request = $endpoint . "/searchBooks/" . $query;
	$request = $endpoint . "/searchBooks/" . $query;

	//echo $request;
	$response = file_get_contents($request);

	if ($echo) {
		echo $response;
	} else {
		$jsonobj = json_decode($response);
		return $jsonobj;
	}
}

function addBook($data) {

	global $endpoint;

	$request = $endpoint . "/addBook";

	// jSON URL which should be requested
	$json_url = $request;
	
	$data['listPrice'] = intval($data['listPrice']);

	$username = 'your_username';  // authentication
	$password = 'your_password';  // authentication
	 
	// jSON String for request
	$json_string = json_encode($data);
	 
	// Initializing curl
	$ch = curl_init( $json_url );
	 
	// Configuring curl options
	$options = array(
	CURLOPT_RETURNTRANSFER => true,
	//CURLOPT_USERPWD => $username . ":" . $password,   // authentication
	CURLOPT_HTTPHEADER => array('Content-type: application/json') ,
	CURLOPT_POSTFIELDS => $json_string
	);
	 
	// Setting curl options
	curl_setopt_array( $ch, $options );
	 
	// Getting results
	$result =  curl_exec($ch); // Getting jSON result string
	echo $result;
}

function createUser($data) {

	if ($data['password'] == $data['password-check']) {

		global $endpoint;

		$request = $endpoint . "/users";

		// jSON URL which should be requested
		$json_url = $request;
		 
		// jSON String for request
		$json_string = json_encode($data);
		 
		// Initializing curl
		$ch = curl_init( $json_url );
		 
		// Configuring curl options
		$options = array(
		CURLOPT_RETURNTRANSFER => true,
		//CURLOPT_USERPWD => $username . ":" . $password,   // authentication
		CURLOPT_HTTPHEADER => array('Content-type: application/json') ,
		CURLOPT_POSTFIELDS => $json_string
		);
		 
		// Setting curl options
		curl_setopt_array( $ch, $options );
		 
		// Getting results
		$result =  curl_exec($ch); // Getting jSON result string

	} else {
		echo "Passwords do not match";
	}
}

function createUserFromSingly($data) {

	global $endpoint;

	$user = array();

	$user['singlyId'] = $data['result']['id'];
	//$user['fbid'] = $data['result']['facebook'][0];
	//$user['access_token'] = $_SESSION['access_token'];

	// get Facebook request
	$morerequest = "https://api.singly.com/profile?access_token=" . $user['access_token'];
	$ch = curl_init($morerequest);

	$options = array(
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_HTTPHEADER => array('Content-type: application/json') ,
	);

	curl_setopt_array($ch, $options);

	$moreinfo = curl_exec($ch);

	$info = json_decode($moreinfo);

	$name = explode(' ', $info->name);

	$user['firstName'] = $name[0];
	$user['lastName'] = $name[1];
	$user['email'] = $info->email;
	$user['thumbnail'] = $info->thumbnail_url;	

	// add this user to the DB

	$json_url = $endpoint . "/addUser";
	 
	// jSON String for request
	$json_string = json_encode($user);
	
	// Initializing curl
	$ch = curl_init( $json_url );
		 
	// Configuring curl options
	$options = array(
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_HTTPHEADER => array('Content-type: application/json') ,
		CURLOPT_POSTFIELDS => $json_string
	);
		 
	// Setting curl options
	curl_setopt_array( $ch, $options );
	 
	// Getting results
	$result =  curl_exec($ch); // Getting jSON result string

	return ($result);
}

function loadUser($data) {
	
	if ($user = findUser($data['result']['id'])) {
		$_SESSION['p2pbooksuser'] = $user;
		//print_r($user);
		//echo $_SESSION['p2pbooksuser'];
	} else {
		// Add this new user to the DB
		$user = createUserFromSingly($data);
		$_SESSION['p2pbooksuser'] = $user;
		//print_r($_SESSION['user']);
		echo "Didn't find you. " . $user;
	}

	//print_r($user);
}

function findUser($singlyId) {
	global $endpoint;

	$request = $endpoint . '/users?{"singlyId":"' . $singlyId . '"}';
	//echo $request;
	$response = file_get_contents($request);
	//echo $response;
	$jsonobj = json_decode($response);

	if (count($jsonobj) == 1) {
		return $jsonobj;
	} else {
		return false;
	}
}

function listByUser($singlyId) {
	global $endpoint;

	$request = $endpoint . '/books?{"userId":"' . $singlyId . '"}';
	$response = file_get_contents($request);
	$jsonobj = json_decode($response);

	return $jsonobj;
}

function requestBook($data) {
	global $endpoint;
	global $p2pbooksuser;

	$bookId = $data['bookId'];

	$request = $endpoint . '/books?{"id":"' . $bookId . '"}';
	$response = file_get_contents($request);
	
	$jsonobj = json_decode($response);

	$currentRequests = $jsonobj->requests;

	$newRequest = "{'userId' : '" . $p2pbooksuser->singlyId . "','ts' : '" . time() . "'}";
	
	$new = json_encode($newRequest);

	//echo $newRequest;

	//push($currentRequests,$newRequest);

	print_r($currentRequests);
	/*

	$updatedData = array(
		"bookId" => $bookId,
		"requests" => $currentRequests
	);

	$json_url = $endpoint . "/books?";
	 
	// jSON String for request
	$json_string = json_encode($updatedData);
	
	echo $json_string; /*
	// Initializing curl
	$ch = curl_init( $json_url );
		 
	// Configuring curl options
	$options = array(
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_HTTPHEADER => array('Content-type: application/json'),
		CURLOPT_CUSTOMREQUEST => "PUT",
		CURLOPT_POSTFIELDS => $json_string
	);
		 
	// Setting curl options
	curl_setopt_array( $ch, $options );
	 
	// Getting results
	$result =  curl_exec($ch); // Getting jSON result string
	echo $result;
	*/

}

function sellBook($bookId) {

	global $endpoint;

	$request = $endpoint . "/sellBook/" . $bookId;

	// jSON URL which should be requested
	$json_url = $request;

	//echo $json_url;
 
	// Initializing curl
	$ch = curl_init( $json_url );
	 
	// Configuring curl options
	$options = array(
		CURLOPT_RETURNTRANSFER => true,
		//CURLOPT_HTTPHEADER => array('Content-type: application/json'),
		CURLOPT_POST => 1
	);
	 
	// setting curl options
	curl_setopt_array( $ch, $options );
	 
	// Getting results
	$result =  curl_exec($ch); // Getting jSON result string
	echo $result;
	//echo $result;	
}