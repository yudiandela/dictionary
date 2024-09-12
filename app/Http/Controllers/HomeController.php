<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        $slug = $request->input('s');
        $lang = $request->input('l');

        if ($slug && $lang) {
            $result = Word::select('id', 'group_id', 'slug', 'daily_text', 'language_code', 'language', 'formal_text', 'voice')
                ->where('slug', $slug)
                ->where('language_code', $lang)
                ->first();

            $words = Word::select('id', 'group_id', 'slug', 'daily_text', 'language_code', 'language', 'formal_text', 'voice')
                ->where('group_id', $result->group_id)
                ->whereNot('id', $result->id)
                ->get();

            $inputText = $result->formal_text;
        } else {
            $result = collect([]);
            $words = Word::orderBy('created_at')->limit(5)->get();
            $inputText = '';
        }

        return view('home', compact('words', 'result', 'inputText'));
    }

    /**
     * Handle the incoming request.
     */
    public function search(Request $request)
    {
        $query = $request->input('q');
        $words = Word::select('id', 'group_id', 'slug', 'daily_text', 'language_code', 'language', 'formal_text', 'voice')
            ->where('daily_text', 'ilike', '%' . $query . '%')
            ->limit(5)
            ->get();

        if($words->count() == 0) {
            return response()->json([
                'errors' => [
                    'list' => [
                        __('Data Not Found')
                    ]
                ]
            ], 404);
        }

        return response()->json([
            'data' => $words
        ]);
    }
}
