<?php

namespace SEO\Page;

/**
 * Class Title
 *
 * @package SEO\Page
 */
class Title {

	private $title;

	/**
	 * @param string $title Page title
	 */
	public function __construct($title) {
		$this->title = $title;
	}

	/**
	 * Determines if a page title is optimized
	 *
	 * @return bool TRUE if optimized, otherwise FALSE
	 */
	public function isOptimized() {
		return true;
	}
}
