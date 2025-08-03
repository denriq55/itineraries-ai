@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-6 max-w-xl px-4">

    <h1 class="text-2xl font-bold mb-6">AI Itinerary Generator</h1>

    <form method="POST" action="{{ route('ai.generate') }}" class="space-y-4">
        @csrf
     
        <div>
            <label for="destination" class="block font-semibold mb-1">Destination:</label>
            <input type="text" name="destination" id="destination" 
                value="{{ old('destination', $input['destination'] ?? '') }}"
                class="border rounded px-3 py-2 w-full bg-white" required maxlength="100" />
            @error('destination') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="budget" class="block font-semibold mb-1">Budget:</label>
            <select name="budget" id="budget" class="border rounded px-3 py-2 w-full bg-white" required>
                <option value="" disabled selected>Select your budget</option>
                <option value="low" {{ (old('budget', $input['budget'] ?? '') == 'low') ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ (old('budget', $input['budget'] ?? '') == 'medium') ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ (old('budget', $input['budget'] ?? '') == 'high') ? 'selected' : '' }}>High</option>
            </select>
            @error('budget') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="days" class="block font-semibold mb-1">Number of Days:</label>
            <input type="number" name="days" id="days" min="1" max="30" 
                value="{{ old('days', $input['days'] ?? '') }}"
                class="border rounded px-3 py-2 w-full bg-white" required />
            @error('days') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="interests" class="block font-semibold mb-1">Interests (optional):</label>
            <input type="text" name="interests" id="interests"
                value="{{ old('interests', $input['interests'] ?? '') }}"
                placeholder="e.g., museums, food, hiking"
                class="border rounded px-3 py-2 w-full bg-white" maxlength="255" />
            @error('interests') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Generate Itinerary</button>
    </form>

    @error('error')
        <div class="mt-6 text-red-600 font-semibold">{{ $message }}</div>
    @enderror

    @isset($output)
        <div class="mt-6 p-6 border bg-gray-50 whitespace-wrap rounded max-w-prose mx-auto mt-10">
            <h2 class="text-xl font-semibold mb-2">Generated Itinerary:</h2>
            <pre class="whitespace-pre-wrap">{{ $output }}</pre>
        </div>
    @endisset

</div>
@endsection