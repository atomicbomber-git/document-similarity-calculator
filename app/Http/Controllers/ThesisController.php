<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Skripsi;
use App\Processor;

class ThesisController extends Controller
{
    /**
     * @var Processor
     */
    private $processor;

    public function __construct(Processor $processor)
    {
        $this->processor = $processor;
        $this->middleware([
            "auth",
        ]);
    }

    public function index()
    {
        $theses = Skripsi::select('id', 'title')
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
            'abstract' => ['required', 'string'],
            'chapter_1' => ['required', 'string'],
            'chapter_2' => ['required', 'string'],
            'chapter_5' => ['required', 'string'],
            'student_name' => ['nullable', 'string'],
            'student_id' => ['nullable', 'string'],
            'study_program' => ['nullable', 'string'],
            'seminar_date' => ['nullable', 'date'],
            'advisor_1_id' => ['nullable', 'string'],
            'advisor_1_name' => ['nullable', 'string'],
            'advisor_2_id' => ['nullable', 'string'],
            'advisor_2_name' => ['nullable', 'string']
        ]);

        Skripsi::create($data);

        return redirect()
            ->route('thesis.index')
            ->with('message.success', 'Data berhasil ditambahkan.');
    }

    public function detail(Skripsi $thesis)
    {
        return view('thesis.detail', compact('thesis'));
    }

    public function update(Skripsi $thesis)
    {
        $data = $this->validate(request(), [
            'title' => ['required', 'string'],
            'abstract' => ['required', 'string'],
            'chapter_1' => ['required', 'string'],
            'chapter_2' => ['required', 'string'],
            'chapter_5' => ['required', 'string'],
            'student_name' => ['nullable', 'string'],
            'student_id' => ['nullable', 'string'],
            'study_program' => ['nullable', 'string'],
            'seminar_date' => ['nullable', 'string'],
            'advisor_1_id' => ['nullable', 'string'],
            'advisor_1_name' => ['nullable', 'string'],
            'advisor_2_id' => ['nullable', 'string'],
            'advisor_2_name' => ['nullable', 'string']
        ]);

        $thesis->update($data);

        return back()
            ->with('message.success', 'Data berhasil diperbarui.');
    }

    public function delete(Skripsi $thesis)
    {
        $thesis->delete();
        return back()
            ->with('message.success', 'Data berhasil dihapus.');
    }

    private function getSimilarities(Skripsi $thesis, $other_theses)
    {
        return $other_theses->map(function($other_thesis) use($thesis) {

            $title_s = $this->processor->calculateSimilarity($thesis->title, $other_thesis->title);
            $abstract_s = $this->processor->calculateSimilarity($thesis->abstract, $other_thesis->abstract);
            $chapter_1_s = $this->processor->calculateSimilarity($thesis->chapter_1, $other_thesis->chapter_1);
            $chapter_2_s = $this->processor->calculateSimilarity($thesis->chapter_2, $other_thesis->chapter_2);
            $chapter_5_s = $this->processor->calculateSimilarity($thesis->chapter_5, $other_thesis->chapter_5);

            $total_s = $this->processor->calculateSimilarity(
                join(" ", [$thesis->title, $thesis->abstract, $thesis->chapter_1, $thesis->chapter_2, $thesis->chapter_5]),
                join(" ", [$other_thesis->title, $other_thesis->abstract, $other_thesis->chapter_1, $other_thesis->chapter_2, $other_thesis->chapter_5])
            );

            return [
                'id' => $other_thesis->id,
                'title' => $title_s,
                'abstract' => $abstract_s,
                'chapter_1' => $chapter_1_s,
                'chapter_2' => $chapter_2_s,
                'chapter_5' => $chapter_5_s,
                'total' => $total_s,
            ];
        });
    }

    public function compare(Skripsi $thesis)
    {
        $other_theses = Skripsi::query()
            ->select('id', 'title', 'abstract', 'chapter_1', 'chapter_2', 'chapter_5')
            ->where('id', '<>', $thesis->id)
            ->get();

        $similarities = $this->getSimilarities($thesis, $other_theses);

        $three_largest_totals = $similarities
            ->sortByDesc('total')
            ->take(3);

        $largest_abstract_s = $similarities->sortByDesc('abstract')->shift();
        $largest_chapter_1_s = $similarities->sortByDesc('chapter_1')->shift();
        $largest_chapter_2_s = $similarities->sortByDesc('chapter_2')->shift();
        $largest_chapter_5_s = $similarities->sortByDesc('chapter_5')->shift();

        $other_theses = $other_theses->keyBy('id');

        return view(
            'thesis.similarity',
            compact(
                'thesis',
                'similarities',
                'other_theses',
                'three_largest_totals',
                'largest_abstract_s',
                'largest_chapter_1_s',
                'largest_chapter_2_s',
                'largest_chapter_5_s'
            )
        );
    }

    public function summary(Skripsi $thesis)
    {
        $other_theses = Skripsi::query()
            ->select('id', 'title', 'abstract', 'chapter_1', 'chapter_2', 'chapter_5')
            ->where('id', '<>', $thesis->id)
            ->get();

        $similarities = $this->getSimilarities($thesis, $other_theses);

        $three_largest_totals = $similarities
            ->sortByDesc('total')
            ->take(5);

        $largest_abstract_s = $similarities->sortByDesc('abstract')->shift();
        $largest_chapter_1_s = $similarities->sortByDesc('chapter_1')->shift();
        $largest_chapter_2_s = $similarities->sortByDesc('chapter_2')->shift();
        $largest_chapter_5_s = $similarities->sortByDesc('chapter_5')->shift();

        $other_theses = $other_theses->keyBy('id');

        return view(
            'thesis.summary',
            compact('thesis', 'other_theses',
                'three_largest_totals',
                'largest_abstract_s',
                'largest_chapter_1_s',
                'largest_chapter_2_s',
                'largest_chapter_5_s'
            )
        );
    }
}
