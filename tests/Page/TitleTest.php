<?php

namespace Zortje\SEO\Tests\Page;

use Zortje\SEO\Page\Title;

/**
 * Class TitleTest
 *
 * @package Zortje\SEO\Tests\Page
 */
class TitleTest extends \PHPUnit_Framework_TestCase {

	public function testIsOptimized() {
		$title = new Title('Lorem ipsum');

		$this->assertTrue($title->isOptimized());
		$this->assertSame(0, count($title->getIssues()));
	}

	public function testIsNotOptimized() {
		$title = new Title('Lorem ipsum dolor sit amet, consectetur adipiscing elit.');

		$this->assertFalse($title->isOptimized());
		$this->assertGreaterThan(0, count($title->getIssues()));
	}

	public function testResetOfIssues() {
		$title = new Title('Lorem ipsum dolor sit amet, consectetur adipiscing elit.');

		/**
		 * Check isOptimized once and save the issues
		 */
		$title->isOptimized();

		$issues = $title->getIssues();

		/**
		 * Check isOptimized again and assert saved issues array is the same size as the current issues
		 */
		$title->isOptimized();

		$this->assertSameSize($issues, $title->getIssues());
	}
}
