<?php

namespace App\Http\Controllers;

use App\Services\GeminiTranslationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TranslationApiController extends Controller
{
    protected GeminiTranslationService $translator;

    public function __construct(GeminiTranslationService $translator)
    {
        $this->translator = $translator;
    }

    /**
     * Translate texts dynamically via Gemini API.
     */
    public function translate(Request $request): JsonResponse
    {
        $target = $request->input('target', app()->getLocale() === 'en' ? 'en' : 'ta');
        $source = $request->input('source', $target === 'en' ? 'ta' : 'en');

        if ($request->has('text')) {
            $text = (string) $request->input('text');
            $translated = $this->translator->translate($text, $target, $source);

            return response()->json([
                'success' => true,
                'target' => $target,
                'source' => $source,
                'translation' => $translated,
            ]);
        }

        if ($request->has('texts') && is_array($request->input('texts'))) {
            $texts = $request->input('texts');
            $translations = $this->translator->translateBatch($texts, $target, $source);

            return response()->json([
                'success' => true,
                'target' => $target,
                'source' => $source,
                'translations' => $translations,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Please provide text or texts array for translation.',
        ], 422);
    }
}
