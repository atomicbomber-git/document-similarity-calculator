<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sastrawi\Stemmer\StemmerFactory;

class ProcessController extends Controller
{
    public function __construct() {
        $this->stemmer = (new StemmerFactory())->createStemmer();
    }

    public function stem() {
        $data = $this->validate(request(), [
            'raw_text' => 'required|string'
        ]);

        $stemmed_text = $this->stemmer->stem($data['raw_text']);

        session()->flash('raw_text', $data['raw_text']);
        session()->flash('stemmed', $stemmed_text);

        return back();
    }
}
