<?php

/*
 * Copyright (c) Jeroen Visser <jeroenvisser101@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bookworm;

/**
 * Bookworm
 *
 * Bookworm is a library that estimates reading time.
 *
 * @author Jeroen Visser <jeroenvisser101@gmail.com>
 */
class Bookworm
{
    /**
     * Types that Bookworm can return the duration.
     */
    const TYPE_SHORT = 1;
    const TYPE_LONG = 2;
    const TYPE_NONE = 3;

    /**
     * Translations used in the estimate function
     *
     * @var array
     * @see Bookworm::configure()
     */
    private static $translations = array(
        'minute' => 'minute',
        'min'    => 'min'
    );

    /**
     * The avarage number of words a person can read in one minute.
     *
     * @link http://ezinearticles.com/?What-is-the-Average-Reading-Speed-and-the-Best-Rate-of-Reading?&id=2298503
     * @var int
     */
    private static $wordsPerMinute = 200;

    /**
     * The avarage number of seconds a person looks at an image.
     *
     * @var int
     */
    private static $secondsPerImage = 12;

    /**
     * Estimates the time needed to read a given string.
     *
     * @param string $text The text to estimate
     * @param int    $type The type of the returned estimate
     *
     * @return string
     */
    public static function estimate($text, $type = self::TYPE_SHORT)
    {
        // Count how many words are in the given text
        $wordCount = self::countWords($text);
        $wordSeconds = ($wordCount / self::$wordsPerMinute) * 60;
        // Count how many images are in the given text
        $imageCount = self::countImages($text);
        $imageSeconds = $imageCount * self::$secondsPerImage;
        // Calculate the amount of minutes required to read the text
        $minutes = round(($wordSeconds + $imageSeconds) / 60);
        // If it's smaller than one or one, we default it to one
        $minutes = $minutes > 1 ? $minutes : 1;

        // Get the proper textual representation
        if ($type !== self::TYPE_NONE) {
            $textual = ' ' . self::$translations[$type == self::TYPE_SHORT ? 'min' : 'minute'];
        }

        return $minutes . (isset($textual) ? $textual : '');
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
        // Replace any non-word character group with a space
        $words = trim(preg_replace('/[^\w0-9]+/i', ' ', $words));
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
        $images = preg_match_all('/!\[([^\[]+)\]\(([^\)]+)\)/i', $text, $matches);

        return $images;
    }

    /**
     * Alters the configuration.
     *
     * @param int   $wordsPerMinute The amount of words an average person reads per minute
     * @param array $translations   The translations that have to be used
     */
    public static function configure($wordsPerMinute, array $translations = null)
    {
        if ($translations) {
            self::$translations = $translations;
        }

        if ($wordsPerMinute) {
            self::$wordsPerMinute = $wordsPerMinute;
        }
    }
}
