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

        // Calculate the amount of minutes required to read the text
        $minutes = round($wordCount / self::$wordsPerMinute);

        // If it's smaller than one or one, we default it to one
        $minutes = $minutes > 1 ? $minutes : 1;

        // Get the proper textual representation
        $textual = self::$translations[$type == self::TYPE_SHORT ? 'min' : 'minute'];

        return $minutes . ' ' . $textual;
    }

    /**
     * Counts how many words are in a specific test.
     *
     * @param string $text The text from which the words should be counted
     *
     * @return int
     */
    private static function countWords($text)
    {
        // Replace any non-word character group with a space
        $words = trim(preg_replace('/[^\w0-9]+/i', ' ', $text));

        // Explode on spaces to separate words
        $words = explode(' ', $words);

        return count($words);
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
