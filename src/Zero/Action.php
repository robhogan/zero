<?php

namespace Zero;

/**
 * Action
 *
 * @package Zero
 */
interface Action {
	/**
	 * @param array $request
	 * @return string
	 */
	public function execute($request);
}
