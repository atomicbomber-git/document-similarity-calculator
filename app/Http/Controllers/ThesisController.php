<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thesis;
use App\Processor;

class ThesisController extends Controller
{
    public function __construct()
    {
        $this->processor = new Processor;
    }

    public function index()
    {
        $theses = Thesis::select('id', 'title')
            ->orderBy('created_at', 'DESC')
            ->paginate(7);

        return view('thesis.index', compact('theses'));
    }

    public function create()
    {
        return view('thesis.create');
    }

    public function store()
    {
        $data = $this->validate(request(), [
            'title' => ['required', 'string'],
            'abstract' => ['nullable', 'string'],
            'chapter_1' => ['nullable', 'string'],
            'chapter_2' => ['nullable', 'string'],
            'chapter_5' => ['nullable', 'string']
        ]);

        Thesis::create($data);

        return redirect()
            ->route('thesis.index')
            ->with('message.success', 'Data berhasil ditambahkan.');
    }

    public function detail(Thesis $thesis)
    {
        return view('thesis.detail', compact('thesis'));
    }

    public function update(Thesis $thesis)
    {
        $data = $this->validate(request(), [
            'title' => ['required', 'string'],
            'abstract' => ['nullable', 'string'],
            'chapter_1' => ['nullable', 'string'],
            'chapter_2' => ['nullable', 'string'],
            'chapter_5' => ['nullable', 'string']
        ]);

        $thesis->update($data);

        return back()
            ->with('message.success', 'Data berhasil diperbarui.');
    }

    public function delete(Thesis $thesis)
    {
        $thesis->delete();
        return back()
            ->with('message.success', 'Data berhasil dihapus.');
    }

    public function compare(Thesis $thesis)
    {
        $other_theses = Thesis::query()
            ->select('id', 'title', 'abstract', 'chapter_1', 'chapter_2', 'chapter_5')
            ->where('id', '<>', $thesis->id)
            ->get();

        $similarities = $other_theses->map(function($other_thesis) use($thesis) {

            $title_s = $this->processor->calculateSimilarity($thesis->title, $other_thesis->title);
            $abstract_s = $this->processor->calculateSimilarity($thesis->abstract, $other_thesis->abstract);
            $chapter_1_s = $this->processor->calculateSimilarity($thesis->chapter_1, $other_thesis->chapter_1);
            $chapter_2_s = $this->processor->calculateSimilarity($thesis->chapter_2, $other_thesis->chapter_2);
            $chapter_5_s = $this->processor->calculateSimilarity($thesis->chapter_5, $other_thesis->chapter_5);

            return [
                'id' => $other_thesis->id,
                'title' => $title_s,
                'abstract' => $abstract_s,
                'chapter_1' => $chapter_1_s,
                'chapter_2' => $chapter_2_s,
                'chapter_5' => $chapter_5_s,
                'average' => collect([$title_s, $abstract_s, $chapter_1_s, $chapter_2_s, $chapter_5_s])->average()
            ];
        });

        $other_theses = $other_theses->keyBy('id');
        return view('thesis.similarity', compact('thesis', 'similarities', 'other_theses'));
    }
}
