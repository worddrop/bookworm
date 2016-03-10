<?php

namespace Bookworm\tests;


class Texts
{
    protected $words = [
            'consectetur',
            'vestibulum',
            'Lorem',
            'amet',
            'sit',
            'at',
            'a',
    ];

    /*
     * create a text that has $words words
     */
    public function words($words = 200)
    {
        $text = "";
        $wordCount = count($this->words)-1;

        for( $i=0; $i < $words; $i++ ){
            $text .= $this->words[rand(0,$wordCount)].' ';
        }

        return $text;
    }
    /*
     * create a text that takes $readingTime minutes to read at a speed of $wordsPerMinute
     */
    public function minutesOfText($readingTime = 1, $wordsPerMinute = 200)
    {
        $totalWords = $readingTime*$wordsPerMinute;

        return $this->words($totalWords);
    }
}
