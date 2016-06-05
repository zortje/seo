<?php

namespace Zortje\SEO;

use Zortje\Rules\ResultCollection;
use Zortje\Rules\RuleCollection;
use Zortje\Rules\RuleInterface;
use Zortje\Rules\Subject;
use Zortje\SEO\Page\ImageRule;
use Zortje\SEO\Page\TitleRule;

/**
 * Class PageRule
 *
 * @package Zortje\SEO
 */
class PageRule implements RuleInterface
{

    /**
     * Check page rules
     *
     * @param Subject $subject
     *
     * @return ResultCollection
     */
    public function check(Subject $subject): ResultCollection
    {
        $ruleCollection = new RuleCollection();

        $ruleCollection->add(new TitleRule());
        $ruleCollection->add(new ImageRule());

        return $ruleCollection->check($subject);
    }
}
