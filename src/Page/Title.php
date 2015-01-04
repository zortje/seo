<?php

namespace Zortje\SEO\Page;

/**
 * Class Title
 *
 * @package Zortje\SEO\Page
 */
class Title {

	/**
	 * @var string
	 */
	private $title;

	/**
	 * @var array
	 */
	private $issues;

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
		/**
		 * Reset issues
		 */
		$this->issues = [];

		/**
		 * Check length
		 */
		if (strlen($this->title) > 55) {
			$this->issues[] = 'Title is longer than 55 characters';
		}

		/**
		 * Check if there are any issues
		 */
		$isOptimized = count($this->issues) === 0;

		return $isOptimized;
	}

	/**
	 * Gets issues if any
	 *
	 * @return array Issues
	 */
	public function getIssues() {
		return $this->issues;
	}
}
