<?php

namespace Zortje\SEO\Page;

use Zortje\Rules\Result;
use Zortje\Rules\ResultCollection;
use Zortje\Rules\RuleInterface;
use Zortje\Rules\Subject;

/**
 * Class TitleRule
 *
 * @package Zortje\SEO\Page
 */
class TitleRule implements RuleInterface
{

    /**
     * Check title rules
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

        $titleTags = $subject->getDom()->getElementsByTagName('title');

        if ($titleTags->length === 0) {
            $resultCollection->add(new Result($contextDescription, 'Title tag is missing'));

        } else if ($titleTags->length === 1) {
            if (strlen($titleTags->item(0)->nodeValue) > 55) {
                $resultCollection->add(new Result($contextDescription, 'Title is longer than 55 characters'));
            }
        } else {
            $resultCollection->add(new Result($contextDescription, 'There are more than one title tag'));
        }

        return $resultCollection;
    }
}
