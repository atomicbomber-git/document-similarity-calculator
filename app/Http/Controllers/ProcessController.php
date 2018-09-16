<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sastrawi\Stemmer\StemmerFactory;
use NlpTools\Tokenizers\WhitespaceAndPunctuationTokenizer;
use NlpTools\Analysis\Idf;
use NlpTools\Documents\TrainingSet;
use NlpTools\Documents\TokensDocument;
use NlpTools\Analysis\FreqDist;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ProcessController extends Controller
{
    public function __construct() {
        $this->stemmer = (new StemmerFactory())->createStemmer();
        $this->tokenizer = new WhitespaceAndPunctuationTokenizer();

        $this->punctuations = collect([
            '.', ',', ':', '?', '!'
        ]);
    }

    private function stemText($text)
    {
        return $this->stemmer->stem($text);
    }

    private function removeConjunctions($text)
    {
        $process = new Process([
            '../local_env/bin/python3',
            '../scripts/remove_conjunctions.py',
            $text
        ]);

        $process->run();

        return trim($process->getOutput());
    }

    private function calculateTermFrequency($text_a, $text_b)
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

    public function stem() {
        $data = $this->validate(request(), [
            'raw_text' => 'required|string'
        ]);

        return [
            'status' => 'success',
            'data' => $this->stemText($data['raw_text'])
        ];
    }

    public function clean()
    {
        $data = $this->validate(request(), [
            'input' => 'required|string'
        ]);

        return [
            'status' => 'success',
            'data' => $this->removeConjunctions($data['input'])
        ];
    }

    public function frequencyDistribution()
    {
        $data = $this->validate(request(), [
            'input' => 'required|string'
        ]);

        $tokens = $this->tokenizer->tokenize($data['input']);
        $freq_dist = new FreqDist($tokens);

        return [
            'status' => 'success',
            'data' => $freq_dist->getKeyValues()
        ];
    }

    private function removePunctuations($array)
    {
        return collect($array)
            ->reject(function ($token) {
                return $this->punctuations->contains($token);
            });
    }

    public function termFrequency()
    {
        $data = $this->validate(request(), [
            'first' => 'string|required',
            'second' => 'string|required'
        ]);

        return [
            'status' => 'success',
            'data' => $this->calculateTermFrequency($data['first'], $data['second'])
        ];
    }
}
