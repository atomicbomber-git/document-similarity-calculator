<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thesis;

class ThesisController extends Controller
{
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
            'chapter_2' => ['nullable', 'string']
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
            'chapter_2' => ['nullable', 'string']
        ]);

        $thesis->update($data);

        return redirect()
            ->route('thesis.index')
            ->with('message.success', 'Data berhasil diperbarui.');
    }

    public function delete(Thesis $thesis)
    {
        $thesis->delete();
        return back()
            ->with('message.success', 'Data berhasil dihapus.');
    }
}
