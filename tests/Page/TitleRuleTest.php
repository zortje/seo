<?php

namespace Zortje\SEO\Tests\Page;

use Zortje\Rules\Result;
use Zortje\Rules\Subject;
use Zortje\SEO\Page\TitleRule;

/**
 * Class TitleTest
 *
 * @package            Zortje\SEO\Tests\Page
 *
 * @coversDefaultClass Zortje\SEO\Page\TitleRule
 */
class TitleRuleTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var TitleRule
     */
    private $titleRule;

    public function setUp()
    {
        $this->titleRule = new TitleRule();
    }

    /**
     * @covers ::check
     */
    public function testCheckNoTitleTag()
    {
        $html = '<html><head></head></html>';

        $dom = new \DOMDocument();
        $dom->loadHTML($html);

        $subject = new Subject('');
        $subject->setDom($dom);

        $resultCollection = $this->titleRule->check($subject);

        $this->assertSame(1, $resultCollection->count());

        /**
         * @var Result $result
         */
        $result = $resultCollection->current();

        $this->assertSame('Title tag is missing', $result->getDescription());
    }

    /**
     * @covers ::check
     */
    public function testCheckTooLongTitle()
    {
        $tooLongTitle = str_repeat('a', 56);

        $this->assertSame(56, strlen($tooLongTitle));

        $html = "<html><head><title>$tooLongTitle</title></head></html>";

        $dom = new \DOMDocument();
        $dom->loadHTML($html);

        $subject = new Subject('');
        $subject->setDom($dom);

        $resultCollection = $this->titleRule->check($subject);

        $this->assertSame(1, $resultCollection->count());

        /**
         * @var Result $result
         */
        $result = $resultCollection->current();

        $this->assertSame('Title is longer than 55 characters', $result->getDescription());
    }

    /**
     * @covers ::check
     */
    public function testCheckTooManyTitleTags()
    {
        $html = '<html><head><title>Foo</title><title>Bar</title></head></html>';

        $dom = new \DOMDocument();
        $dom->loadHTML($html);

        $subject = new Subject('');
        $subject->setDom($dom);

        $resultCollection = $this->titleRule->check($subject);

        $this->assertSame(1, $resultCollection->count());

        /**
         * @var Result $result
         */
        $result = $resultCollection->current();

        $this->assertSame('There are more than one title tag', $result->getDescription());
    }
}
