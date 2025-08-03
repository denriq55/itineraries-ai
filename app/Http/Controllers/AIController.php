<?php

namespace App\Http\Controllers;
use App\Services\AIService;

use Illuminate\Http\Request;

class AIController extends Controller
{
    public function showForm()
    {
        return view('ai_form');
    }

    public function generate(Request $request, AIService $aiService)
{
    $validated = $request->validate([
        'destination' => 'required|string|max:100',
        'budget' => 'required|string|in:low,medium,high', // assuming dropdown
        'days' => 'required|integer|min:1|max:30',
        'interests' => 'nullable|string|max:255', // optional: museums, food, etc.
    ]);

    $prompt = "Create a travel itinerary for a {$validated['days']}-day trip to {$validated['destination']} on a {$validated['budget']} budget.";

    if (!empty($validated['interests'])) {
        $prompt .= " The traveler is interested in {$validated['interests']}.";
    }

    try {
        
        $response = $aiService->generateText($prompt);

       
        return view('ai_form', [
            'output' => $response,
            'input' => $validated, 
        ]);

    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'AI request failed: ' . $e->getMessage()])
                     ->withInput(); // preserve input on error
    }
    }
}
