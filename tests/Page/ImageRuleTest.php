<?php

namespace Zortje\SEO\Tests\Page;

use Zortje\Rules\Result;
use Zortje\Rules\Subject;
use Zortje\SEO\Page\ImageRule;

/**
 * Class ImageRuleTest
 *
 * @package            Zortje\SEO\Tests\Page
 *
 * @coversDefaultClass Zortje\SEO\Page\ImageRule
 */
class ImageRuleTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var ImageRule
     */
    private $imageRule;

    public function setUp()
    {
        $this->imageRule = new ImageRule();
    }

    /**
     * @covers ::check
     */
    public function testCheckOneMissingAlt()
    {
        $html = '<html><body><img src="" alt="Foo"><img src=""></body></html>';

        $dom = new \DOMDocument();
        $dom->loadHTML($html);

        $subject = new Subject('');
        $subject->setDom($dom);

        $resultCollection = $this->imageRule->check($subject);

        $this->assertSame(1, $resultCollection->count());

        /**
         * @var Result $result
         */
        $result = $resultCollection->current();

        $this->assertSame('1 img tag is missing alt attribute', $result->getDescription());
    }

    /**
     * @covers ::check
     */
    public function testCheckThreeMissingAlt()
    {
        $html = '<html><body><img src="" alt="Foo"><img src=""><img src=""><img src="" alt="Bar"><img src=""></body></html>';

        $dom = new \DOMDocument();
        $dom->loadHTML($html);

        $subject = new Subject('');
        $subject->setDom($dom);

        $resultCollection = $this->imageRule->check($subject);

        $this->assertSame(1, $resultCollection->count());

        /**
         * @var Result $result
         */
        $result = $resultCollection->current();

        $this->assertSame('3 img tag is missing alt attribute', $result->getDescription());
    }

    /**
     * @covers ::check
     */
    public function testCheckEmptyAlt()
    {
        $html = '<html><body><img src="" alt=""></body></html>';

        $dom = new \DOMDocument();
        $dom->loadHTML($html);

        $subject = new Subject('');
        $subject->setDom($dom);

        $resultCollection = $this->imageRule->check($subject);

        $this->assertSame(1, $resultCollection->count());

        /**
         * @var Result $result
         */
        $result = $resultCollection->current();

        $this->assertSame('1 img tag is missing alt attribute', $result->getDescription());
    }
}
