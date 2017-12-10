<? class messenger extends fw {

	public function addMessage ($msg) {
		!isset($_SESSION["messages"]) ? $_SESSION["messages"] = array() : null;
		array_push($_SESSION["messages"], $msg);
	}

	public function showMessages() {
		foreach($_SESSION["messages"] as $msg) {
			?><p><?=$msg?></p><?
		}
		unset($_SESSION["messages"]);
	}

} ?>