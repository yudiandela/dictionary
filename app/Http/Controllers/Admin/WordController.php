<?php

namespace App\Http\Controllers\Admin;

use App\Models\Word;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $words = Word::with('category')->paginate(10);
        return view('admin.word.index', compact('words'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $languages = $this->getLanguages();

        return view('admin.word.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'words' => ['required', 'array'],
        ]);

        $words = $request->input('words');
        $groupId = Str::orderedUuid();

        foreach ($words as $word) {
            foreach ($word as $key => $value) {
                $languange = $this->getLanguagesWithKey($words['language_code'][$key]);

                Word::create([
                    'category_id' => 1,
                    'group_id' => $groupId,
                    'daily_text' => $words['daily_text'][$key],
                    'slug' => Str::slug($words['daily_text'][$key]),
                    'formal_text' => $words['formal_text'][$key],
                    'language_code' => $words['language_code'][$key],
                    'language' => $languange,
                    'voice' => '',
                ]);
            }
        }

        return back()->with('success', 'Words stored successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request): View
    {
        $slug = $request->input('w');
        $group = $request->input('g');

        $words = Word::where('group_id', $group)->get();
        $languages = $this->getLanguages();

        return view('admin.word.edit', compact('words', 'slug', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Word $word): RedirectResponse
    {
        $request->validate([
            'words' => ['required', 'array'],
        ]);

        $words = $request->input('words');

        foreach ($words as $word) {
            $languange = $this->getLanguagesWithKey($word['language_code']);

            Word::where('id', $word['id'])->update([
                'daily_text' => $word['daily_text'],
                'formal_text' => $word['formal_text'],
                'language_code' => $word['language_code'],
                'language' => $languange,
            ]);
        }

        return back()->with('success', 'Words updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Word $word): RedirectResponse
    {
        //
    }

    private function getLanguages(): Collection
    {
        return collect([
            'ar' => 'Arabic',
            'ac' => 'Achinese',
            'en' => 'English',
            'id' => 'Indonesian',
            'my' => 'Malay',
            'tl' => 'Tagalog',
            'vi' => 'Vietnamese',
            'zh' => 'Chinese',
            'jp' => 'Japanese',
            'ko' => 'Korean',
            'th' => 'Thai',
            'ru' => 'Russian',
            'it' => 'Italian',
            'fr' => 'French',
            'de' => 'German',
            'es' => 'Spanish',
            'pt' => 'Portuguese',
            'nl' => 'Dutch',
            'pl' => 'Polish',
            'cs' => 'Czech',
            'sk' => 'Slovak',
            'sl' => 'Slovenian',
            'hu' => 'Hungarian',
            'sv' => 'Swedish',
            'tr' => 'Turkish',
            'fa' => 'Persian',
            'he' => 'Hebrew',
            'ur' => 'Urdu',
        ])->sort();
    }

    private function getLanguagesWithKey(string $code): string
    {
        $languange = $this->getLanguages()[$code];
        return isset($languange) ? $languange : '';
    }
}
