<?php

/*
 * Copyright (c) Jeroen Visser <jeroenvisser101@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bookworm;

/**
 * Bookworm.
 *
 * Bookworm is a library that estimates reading time.
 *
 * @author Jeroen Visser <jeroenvisser101@gmail.com>
 */
class Bookworm
{
    /**
     * The avarage number of words a person can read in one minute.
     *
     * @link http://ezinearticles.com/?What-is-the-Average-Reading-Speed-and-the-Best-Rate-of-Reading?&id=2298503
     *
     * @var int
     */
    private static $wordsPerMinute = 200;

    /**
     * The avarage number of words in a code section a person can read in one minute.
     *
     * @var int
     */
    private static $codewordsPerMinute = 200;

    /**
     * The avarage number of seconds a person looks at an image.
     *
     * @var int
     */
    private static $secondsPerImage = 12;

    /**
     * Estimates the time needed to read a given string.
     *
     * @param string       $text  The text to estimate
     * @param string|array $units singular | singular & plural
     *
     * @return string
     */
    public static function estimate($text, $units = array(' minute', ' minutes'))
    {
        // Count how many words are in the given text
        $wordCount = self::countWords($text);
        $wordSeconds = ($wordCount / self::$wordsPerMinute) * 60;
        // Count how many images are in the given text
        $imageCount = self::countImages($text);
        $imageSeconds = $imageCount * self::$secondsPerImage;
        // Count how many images are in the given text
        $codeCount = self::countCode($text);
        $codeSeconds = ($codeCount / self::$codewordsPerMinute) * 60;
        // Calculate the amount of minutes required to read the text
        $minutes = round(($wordSeconds + $imageSeconds + $codeSeconds) / 60);
        // If it's smaller than one or one, we default it to one
        $minutes = $minutes > 1 ? $minutes : 1;

        // return only int, if $units set to false

        if (is_string($units) === true) {
            return $minutes.$units;
        }

        if (is_array($units) === true && count($units) === 2) {
            $units = array_values($units);

            return $minutes.($minutes === 1 ? $units[0] : $units[1]);
        }

        return $minutes;
    }

    /**
     * Counts how many words are in a specific text.
     *
     * @param string $text The text from which the words should be counted
     *
     * @return int
     */
    private static function countWords($text)
    {
        // Remove markdown images from text
        $words = trim(preg_replace('/!\[([^\[]+)\]\(([^\)]+)\)/i', ' ', $text));
        // Remove image tags from text
        $words = trim(preg_replace('/<img[^>]*>/i', ' ', $words));
        // Remove picture tags from text (counted already due to mandatory img tag)
        $words = trim(preg_replace('/<picture[^>]*>([\s\S]*?)<\/picture>/i', ' ', $words));
        // Remove code markdown
        $words = trim(preg_replace('/(?<=(?<!`))`[^`\n\r]+`(?=(?!`))|```[\w+]?[^`]*```/i', ' ', $words));
        // Remove code html
        $words = trim(preg_replace('/<code>([\s\S]*?)<\/code>/i', ' ', $words));
        $words = strip_tags($words);
        // Explode on spaces to separate words
        $words = explode(' ', $words);

        return count($words);
    }

    /**
     * Counts how many images are in a specific text.
     *
     * @param string $text The text from which the words should be counted
     *
     * @return int
     */
    private static function countImages($text)
    {
        // Count markdown images from text
        $markdownImages = preg_match_all('/!\[([^\[]+)\]\(([^\)]+)\)/i', $text, $matches);
        // Count image tags from text
        $imgTags = preg_match_all('/<img[^>]*>/i', $text, $matches);

        return $markdownImages + $imgTags;
    }

    /**
     * Counts how many "code words" are in a specific text.
     *
     * @param string $text The text from which the words should be counted
     *
     * @return int
     */
    private static function countCode($text)
    {
        // remove code attribute content, like from href="" or d=""
        $text = preg_replace('/"[^"]*"/i', '', $text);
        // get markdown code
        $regex = '/(?<=(?<!`))`([^`\n\r]+)`(?=(?!`))|```[a-zA-Z]*([^`]*)```/i';
        $markdownCount = preg_match_all($regex, $text, $markdownMatches, PREG_PATTERN_ORDER);
        // Remove markdown code from text, as to not double count
        $text = trim(preg_replace('/(?<=(?<!`))`[^`\n\r]+`(?=(?!`))|```[a-zA-Z]*[^`]*```/i', ' ', $text));

        // get html code elements
        $regex = '/<code>([\s\S]*?)<\/code>/i';
        $htmlCount = preg_match_all($regex, $text, $htmlMatches, PREG_PATTERN_ORDER);

        // check if any matches exist
        if ($markdownCount === 0 && $htmlCount === 0) {
            return 0;
        }
        // concat all code
        $code = implode($markdownMatches[1], ' ').' '.implode($markdownMatches[2], ' ').' '.implode($htmlMatches[1], ' ');

        // replace multiple spaces
        $code = preg_replace(['/\s+/', '/^\s/'], [' ', ''], $code);

        // return the number words in the code blocks
        return count(array_filter(explode(' ', $code)));
    }
    /**
     * Alters the configuration.
     *
     * @param array $config
     */
    public static function configure(array $config = [])
    {
        $config = array_merge(
            [
                'wordsPerMinute' => self::$wordsPerMinute,
                'secondsPerImage' => self::$secondsPerImage,
                'codewordsPerMinute' => self::$codewordsPerMinute,
            ],
            $config
        );
        self::$wordsPerMinute = $config['wordsPerMinute'];
        self::$secondsPerImage = $config['secondsPerImage'];
        self::$codewordsPerMinute = $config['codewordsPerMinute'];
    }
}
