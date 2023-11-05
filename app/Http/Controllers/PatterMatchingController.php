<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PatterMatchingController extends Controller
{

    public function index()
    {
        return view('pattern-matching');
    }

    public function getMatchedInfo(Request $request): JsonResponse
    {
        $text = $request->input('text');
        $pattern = $request->input('pattern');

        $textLength = strlen($text);
        $patternLength = strlen($pattern);

        // Two simple way to do this
//        $occurrences = substr_count($text, $pattern);
//        $occurrences = preg_match_all("/$pattern/", $text, $matches);

        $occurrences = 0; // Initialize a variable to keep track of pattern occurrences

        for ($i = 0; $i <= $textLength - $patternLength; $i++) {
            // Start a loop to iterate through the input text

            $match = true; // Initialize a flag to track if a match is found

            for ($j = 0; $j < $patternLength; $j++) {
                // Start a nested loop to compare characters in the text and pattern

                if ($text[$i + $j] !== $pattern[$j]) {
                    // If the characters don't match, set the 'match' flag to false and break out of the loop
                    $match = false;
                    break;
                }
            }

            if ($match) {
                // If 'match' is still true, it means a complete pattern match is found
                $occurrences++; // Increment the count of pattern occurrences
                $i += $patternLength - 1; // Skip ahead to the next potential match
            }
        }

        return response()->json(['message' => "The pattern '$pattern' appears in the text '$text' $occurrences times."]);
    }
}
