<?php

namespace App;

use Sastrawi\Stemmer\StemmerFactory;
use NlpTools\Tokenizers\WhitespaceAndPunctuationTokenizer;
use NlpTools\Analysis\Idf;
use NlpTools\Analysis\FreqDist;
use NlpTools\Documents\TrainingSet;
use NlpTools\Documents\TokensDocument;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class Processor
{
    public function __construct()
    {
        $this->stemmer = (new StemmerFactory())->createStemmer();
        $this->tokenizer = new WhitespaceAndPunctuationTokenizer();
        $this->punctuations = collect(['.', ',', ':', '?', '!']);
    }

    public function stem($text)
    {
        return $this->stemmer->stem($text);
    }

    public function removeConjunctions($text)
    {
        $process = new Process([
            '../local_env/bin/python3',
            '../scripts/remove_conjunctions.py',
            $text
        ]);

        $process->run();

        return trim($process->getOutput());
    }

    public function calculateTermFrequency($text_a, $text_b)
    {
        $tokens_1 = $this->removePunctuations($this->tokenizer->tokenize(strtolower($text_a)));
        $tokens_2 = $this->removePunctuations($this->tokenizer->tokenize(strtolower($text_b)));
        $all_tokens = $tokens_1->merge($tokens_2);
        
        $freq_dist_1 = ( new FreqDist($tokens_1->toArray()) )->getKeyValues();
        $freq_dist_2 = ( new FreqDist($tokens_2->toArray()) )->getKeyValues();

        $term_frequency = $all_tokens->flatMap(function($token) use($freq_dist_1, $freq_dist_2) {
            return [$token => ['a' => $freq_dist_1[$token] ?? 0, 'b' => $freq_dist_2[$token] ?? 0]];
        });

        return $term_frequency;
    }

    public function removePunctuations($array)
    {
        return collect($array)
            ->reject(function ($token) {
                return $this->punctuations->contains($token);
            });
    }

    public function calculate_similarity($text_a, $text_b)
    {
        $term_frequency = $this->calculateTermFrequency(
            $this->removeConjunctions($this->stemText($text_a)),
            $this->removeConjunctions($this->stemText($text_b))
        );

        $numerator = $term_frequency->reduce(function($carry, $value) {
            $carry += ($value['a'] * $value['b']);
            return $carry;
        }, 0);

        $len_a = sqrt($term_frequency->reduce(function($carry, $value) {
            $carry += pow($value['a'], 2);
            return $carry;
        }, 0));

        $len_b = sqrt($term_frequency->reduce(function($carry, $value) {
            $carry += pow($value['b'], 2);
            return $carry;
        }, 0));

        return $numerator / ($len_a * $len_b);
    }
}
