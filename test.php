<?

	$messenger = addMessage("hi there");

	foreach ($messenger as $msg) {

		echo $msg["type"], " ", $msg["msg"]; exit;

	}


	function addMessage ($message, $type = "error") {

		!isset($messenger) ? $messenger = array() : null;

		$msg["msg"] = $message;
		$msg["type"] = $type;

		array_push($messenger, $msg);

		return $messenger;

	}



?>



