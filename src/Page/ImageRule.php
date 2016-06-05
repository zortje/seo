<?php

namespace Zortje\SEO\Page;

use Zortje\Rules\Result;
use Zortje\Rules\ResultCollection;
use Zortje\Rules\Subject;

/**
 * Class ImageRule
 *
 * @package Page
 */
class ImageRule
{

    /**
     * Check image rules
     *
     * @param Subject $subject
     *
     * @return ResultCollection
     */
    public function check(Subject $subject): ResultCollection
    {
        $resultCollection = new ResultCollection();

        /**
         * Check
         */
        $contextDescription = $subject->getContextDescription();

        $imgTags = $subject->getDom()->getElementsByTagName('img');

        /**
         * @var \DOMElement $imgTag
         */
        $missingAltAttributes = 0;

        foreach ($imgTags as $imgTag) {
            $altAttribute = $imgTag->attributes->getNamedItem('alt');

            if (!$altAttribute || empty($altAttribute->nodeValue)) {
                $missingAltAttributes++;
            }
        }

        if ($missingAltAttributes > 0) {
            $resultCollection->add(new Result($contextDescription, "$missingAltAttributes img tag is missing alt attribute"));
        }

        return $resultCollection;
    }
}
