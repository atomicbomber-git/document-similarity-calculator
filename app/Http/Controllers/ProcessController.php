<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sastrawi\Stemmer\StemmerFactory;
use NlpTools\Tokenizers\WhitespaceTokenizer;
use NlpTools\Analysis\FreqDist;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ProcessController extends Controller
{
    public function __construct() {
        $this->stemmer = (new StemmerFactory())->createStemmer();
        $this->tokenizer = new WhiteSpaceTokenizer();
    }

    public function stem() {
        $data = $this->validate(request(), [
            'raw_text' => 'required|string'
        ]);

        $stemmed_text = $this->stemmer->stem($data['raw_text']);

        return [
            'status' => 'success',
            'data' => $stemmed_text
        ];
    }

    public function clean()
    {
        $data = $this->validate(request(), [
            'input' => 'required|string'
        ]);

        $process = new Process([
            'python',
            '../scripts/remove_conjunctions.py',
            $data['input']
        ]);

        $process->run();

        return [
            'status' => 'success',
            'data' => trim($process->getOutput())
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
}
