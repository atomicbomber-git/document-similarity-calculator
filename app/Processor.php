<?php

namespace App;

use NlpTools\Analysis\FreqDist;
use NlpTools\Tokenizers\TokenizerInterface;
use Sastrawi\Stemmer\StemmerInterface;
use Sastrawi\StopWordRemover\StopWordRemover;

class Processor
{
    /**
     * @var StopWordRemover
     */
    private $stopWordRemover;

    /**
     * @var StemmerInterface
     */
    private $stemmer;

    /**
     * @var TokenizerInterface
     */
    private $tokenizer;

    public function __construct(StemmerInterface $stemmer, StopWordRemover $stopWordRemover, TokenizerInterface $tokenizer)
    {
        $this->stemmer = $stemmer;
        $this->tokenizer = $tokenizer;
        $this->stopWordRemover = $stopWordRemover;

        $this->punctuations = collect(['.', ',', ':', '?', '!']);
    }

    public function calculateSimilarity($text_a, $text_b)
    {
        $term_frequency = $this->calculateTermFrequency(
            $this->removeConjunctions($this->stem($text_a)),
            $this->removeConjunctions($this->stem($text_b))
        );

        $numerator = $term_frequency->reduce(function ($carry, $value) {
            $carry += ($value['a'] * $value['b']);
            return $carry;
        }, 0);

        $len_a = sqrt($term_frequency->reduce(function ($carry, $value) {
            $carry += pow($value['a'], 2);
            return $carry;
        }, 0));

        $len_b = sqrt($term_frequency->reduce(function ($carry, $value) {
            $carry += pow($value['b'], 2);
            return $carry;
        }, 0));

        if ($len_a * $len_b == 0) {
            return 0;
        }

        return round($numerator / ($len_a * $len_b), 4) * 100;
    }

    public function calculateTermFrequency($text_a, $text_b)
    {
        $tokens_1 = $this->removePunctuations($this->tokenizer->tokenize(strtolower($text_a)));
        $tokens_2 = $this->removePunctuations($this->tokenizer->tokenize(strtolower($text_b)));
        $all_tokens = $tokens_1->merge($tokens_2);

        $freq_dist_1 = (new FreqDist($tokens_1->toArray()))->getKeyValues();
        $freq_dist_2 = (new FreqDist($tokens_2->toArray()))->getKeyValues();

        return $all_tokens->flatMap(function ($token) use ($freq_dist_1, $freq_dist_2) {
            return [$token => ['a' => $freq_dist_1[$token] ?? 0, 'b' => $freq_dist_2[$token] ?? 0]];
        });
    }

    public function removePunctuations($array)
    {
        return collect($array)
            ->reject(function ($token) {
                return $this->punctuations->contains($token);
            });
    }

    public function removeConjunctions($text)
    {
        return $this->stopWordRemover->remove($text);
    }

    public function stem($text)
    {
        return $this->stemmer->stem($text);
    }
}
