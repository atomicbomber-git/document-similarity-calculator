<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Processor;

class ProcessController extends Controller
{
    /**
     * @var Processor
     */
    private $processor;

    public function __construct(Processor $processor) {
        $this->processor = $processor;
    }

    public function stem() {
        $data = $this->validate(request(), [
            'raw_text' => 'required|string'
        ]);

        return [
            'status' => 'success',
            'data' => $this->processor->stem($data['raw_text'])
        ];
    }

    public function clean()
    {
        $data = $this->validate(request(), [
            'input' => 'required|string'
        ]);

        return [
            'status' => 'success',
            'data' => $this->processor->removeConjunctions($data['input'])
        ];
    }

    public function termFrequency()
    {
        $data = $this->validate(request(), [
            'first' => 'string|required',
            'second' => 'string|required'
        ]);

        return [
            'status' => 'success',
            'data' => $this->processor->calculateTermFrequency($data['first'], $data['second'])
        ];
    }
}
