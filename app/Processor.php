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
use GuzzleHttp\Client;

class Processor
{
    public function __construct()
    {
        $this->stemmer = (new StemmerFactory())->createStemmer();
        $this->tokenizer = new WhitespaceAndPunctuationTokenizer();
        $this->punctuations = collect(['.', ',', ':', '?', '!']);
        
        // A HTTP Client
        $this->client = new Client([
            'base_uri' => env('TEXT_CLEANER_SERVICE_URL'),
            'timeout' => 2.0
        ]);
    }

    public function stem($text)
    {
        return $this->stemmer->stem($text);
    }

    public function removeConjunctions($text)
    {
        $response = $this->client->request('GET', '/', [
            'query' => ['input' => $text]
        ]);

        return json_decode($response->getBody())->result;
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

    public function calculateSimilarity($text_a, $text_b)
    {
        $term_frequency = $this->calculateTermFrequency(
            $this->removeConjunctions($this->stem($text_a)),
            $this->removeConjunctions($this->stem($text_b))
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

        if ($len_a * $len_b == 0) {
            return 0;
        }

        return round($numerator / ($len_a * $len_b), 4) * 100;
    }
}
