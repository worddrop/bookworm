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

    protected $codeWords = [
        '<span>Some Words here</span>',
        '<div class="test">A div</div>',
        '<img src="test" data-lang="de" class="user" />'
    ];

    protected $code = [
        'markdown' => [
            '`{$$code$$}`',
            '``` {$$code$$}```',
            '```bash {$$code$$}```',
        ],
        'html' => [
            '<code>{$$code$$}</code>',
            '<pre><code>{$$code$$}</code></pre>',
        ]
    ];

    public function __construct()
    {
        $this->wordCount = count($this->words);
    }
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
    /*
     * create text and html code
     */
     public function minutesOfHtml($readingTime = 1, $wordsPerMinute = 200)
     {
         $totalWords = $readingTime*$wordsPerMinute;

         return $this->code($totalWords, 'html');
     }
     /*
      * create text and markdown code
      */
      public function minutesOfMarkdown($readingTime = 1, $wordsPerMinute = 200)
      {
          $totalWords = $readingTime*$wordsPerMinute;

          return $this->code($totalWords, 'markdown');
      }
}
