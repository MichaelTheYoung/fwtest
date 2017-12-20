<? class messenger extends core {

	public function addMessage ($msg, $type = "error") {
		!isset($_SESSION["messages"]) ? $_SESSION["messages"] = array() : null;
		$message["msg"] = $msg;
		$message["type"] = $type;
		array_push($_SESSION["messages"], $message);
	}

	public function showMessages() {
		foreach($_SESSION["messages"] as $message) {
			?><p><?=$message["msg"]?></p><?
		}
		unset($_SESSION["messages"]);
		return $message["type"];
	}

} ?>