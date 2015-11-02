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
	 * @var array<string, array<string, string>> Heading count patterns
	 */
	private $headingCountPattern = [
		'h1' => [
			'pattern' => '/^1$/',
			'issue'   => 'There should be one and only one h1 tag'
		],
		'h2' => [
			'pattern' => '/^[0-5]$/',
			'issue'   => 'There should be no more than five h2 tags'
		],
		'h3' => [
			'pattern' => '/^[0-7]$/',
			'issue'   => 'There should be no more than seven h3 tags'
		]
	];

	/**
	 * @var \DOMDocument
	 */
	private $dom;

	/**
	 * @param \DOMDocument $dom
	 */
	public function __construct(\DOMDocument $dom) {
		$this->dom = $dom;
	}

	/**
	 * Analyze page for issues
	 *
	 * @return array Issues; empty if optimized
	 */
	public function analyzeForIssues() {
		$issues = [];

		/**
		 * Meta description
		 */
		// @todo

		/**
		 * Title
		 */
		$issues = array_merge($issues, $this->analyzeTitleForIssues());

		/**
		 * Headings
		 */
		$issues = array_merge($issues, $this->analyzeHeadingsForIssues());

		/**
		 * Return issues
		 */
		return $issues;
	}

	/**
	 * Analyze title for issues
	 *
	 * @return array Issues; empty if optimized
	 */
	private function analyzeTitleForIssues() {
		$issues = [];

		/**
		 * Create title object
		 */
		$title = new Title();

		$titleTags = $this->dom->getElementsByTagName('title');

		if ($titleTags->length > 0) {
			$title->setTitle($titleTags->item(0)->nodeValue);
		}

		$issues = array_merge($issues, $title->analyzeForIssues());

		/**
		 * Return issues
		 */
		return $issues;
	}

	/**
	 * Analyze headings for issues
	 *
	 * @return array Issues; empty if optimized
	 */
	private function analyzeHeadingsForIssues() {
		$issues = [];

		/**
		 * Go though the heading count patterns
		 */
		foreach ($this->headingCountPattern as $tag => $rule) {
			$elementCount = $this->dom->getElementsByTagName($tag)->length;

			if (!preg_match($rule['pattern'], $elementCount)) {
				$issues[] = $rule['issue'];
			}
		}

		/**
		 * Return issues
		 */
		return $issues;
	}

}
