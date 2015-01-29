<?php namespace Chaucerbao;

class Censorship
{
    protected $dictionary = [];
    protected $symbol = '*';

    public function __construct(array $dictionary = [])
    {
        if ($dictionary) {
            $this->load($dictionary);
        }
    }

    public function load(array $dictionary)
    {
        $this->dictionary = array_map(function ($word) {
            return PorterStemmer::Stem($word);
        }, $dictionary);
    }

    public function setSymbol($character)
    {
        $this->symbol = $character;
    }

    public function censor($text, $symbol = null)
    {
        $symbol = $symbol ?: $this->symbol;

        $tokens = explode(' ', $text);
        foreach ($tokens as &$token) {
            $word = preg_replace('/[^a-z]/i', '', $token);
            if (in_array(PorterStemmer::Stem($word), $this->dictionary)) {
                $token = preg_replace('/[\w\-]/i', $symbol, $token);
            }
        }

        return implode(' ', $tokens);
    }
}
