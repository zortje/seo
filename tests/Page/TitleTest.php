<?php

namespace Zortje\SEO\Tests\Page;

use Zortje\SEO\Page\Title;

/**
 * Class TitleTest
 *
 * @package            Zortje\SEO\Tests\Page
 *
 * @coversDefaultClass Zortje\SEO\Page\Title
 */
class TitleTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @covers ::setTitle
	 * @covers ::getTitle
	 */
	public function testSetterAndGetter() {
		$title = new Title();
		$title->setTitle('Lorem ipsum');

		$this->assertSame('Lorem ipsum', $title->getTitle());
	}

	/**
	 * @covers ::analyzeForIssues
	 */
	public function testAnalyzeForIssuesOptimized() {
		$title = new Title();
		$title->setTitle('Lorem ipsum');

		$this->assertSame([], $title->analyzeForIssues());
	}

	/**
	 * @covers ::analyzeForIssues
	 */
	public function testAnalyzeForIssuesEmpty() {
		$title = new Title();

		$this->assertSame(0, strlen($title->getTitle()));
		$this->assertSame(['Title is not set or empty'], $title->analyzeForIssues());
	}

	/**
	 * @covers ::analyzeForIssues
	 */
	public function testAnalyzeForIssuesTooLong() {
		$title = new Title();
		$title->setTitle('abcdefghijklmnopqrstuvwxyz abcdefghijklmnopqrstuvwxyz ab');

		$this->assertSame(56, strlen($title->getTitle()));
		$this->assertSame(['Title is longer than 55 characters'], $title->analyzeForIssues());
	}

}
