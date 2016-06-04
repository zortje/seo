<?php

namespace Zortje\SEO\Page;

/**
 * Class Title
 *
 * @package Zortje\SEO\Page
 */
class Title
{

    /**
     * @var string
     */
    private $title;

    /**
     * @param string $title Page title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string Page title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Analyze title for issues
     *
     * @return array Issues; empty if optimized
     */
    public function analyzeForIssues()
    {
        $issues = [];

        /**
         * Length
         */
        if (strlen($this->title) === 0) {
            $issues[] = 'Title is not set or empty';
        }

        if (strlen($this->title) > 55) {
            $issues[] = 'Title is longer than 55 characters';
        }

        return $issues;
    }

}
