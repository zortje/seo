<?php

namespace Zortje\SEO;

use Zortje\SEO\Page\Title;

/**
 * Class Page
 *
 * @package Zortje\SEO
 */
class Page {

	/**
	 * @var \DOMDocument
	 */
	private $dom;

	/**
	 * @var array
	 */
	private $issues = [];

	public function __construct(\DOMDocument $dom) {
		$this->dom = $dom;
	}

	public function isOptimized() {
		/**
		 * Check H1 tag(s)
		 */
		$headingOneCount = $this->dom->getElementsByTagName('h1')->length;

		if ($headingOneCount === 0) {
			$this->issues[] = 'Page has no H1 tags';
		} else if ($headingOneCount > 1) {
			$this->issues[] = 'Page has more than one H1 tags';
		}

		/**
		 * Check title tag
		 */
		$title = $this->dom->getElementsByTagName('title');

		if ($title->length > 0) {
			$title = new Title($title->item(0)->nodeValue);

			if (!$title->isOptimized()) {
				foreach ($title->getIssues() as $issue) {
					$this->issues[] = $issue;
				}
			}
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
