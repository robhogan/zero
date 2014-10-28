<?php

namespace Zero;

/**
 * Controller
 *
 * @package Zero
 */
class Controller {
	/**
	 * @param string $rawArgs
	 * @return string
	 */
	public function dispatch($rawArgs) {
		$actionArgs = array();
		if (!isset($rawArgs[1])) {
			return $this->error("Missing arguments");
		}
		$urlParts = parse_url($rawArgs[1]);

		if (!isset($urlParts['path'])) {
			return $this->error("Controller is missing");
		}

		$class = $urlParts['path'];
		$query = $urlParts['query'];

		parse_str($query, $actionArgs);

		if (!class_exists($class) && in_array('Zero\Action', class_implements($class))) {
			return $this->error("Controller doesn't implement Zero\\Action");
		}

		$action = new $class();

		if (!$action instanceof Action) {
			return $this->error("Controller doesn't implement Zero\\Action");
		}

		return $action->execute($actionArgs);
	}

	/**
	 * @param string $message
	 * @return string
	 */
	protected function error($message) {
		return "ERROR: " . $message;
	}
}