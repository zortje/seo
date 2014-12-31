<?php

namespace SEO\Tests\Page;

use SEO\Page\Title;

/**
 * Class TitleTest
 *
 * @package SEO\Tests\Page
 */
class TitleTest extends \PHPUnit_Framework_TestCase {

	public function testIsOptimized() {
		$title = new Title('Lorem ipsum');

		$this->assertTrue($title->isOptimized());
	}
}
