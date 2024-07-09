<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class VoteController extends Controller
{
    public function vote(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'choice' => 'required|string|in:option1,option2,option3,option4',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = Auth::user();
        $existingVote = Vote::where('user_id', $user->id)->first();

        if ($existingVote) {
            return response()->json(['message' => 'You have already voted.'], 403);
        }

        $ipAddress = $request->ip();
        $location = $this->getLocationFromIP($ipAddress);

        $vote = Vote::create([
            'user_id' => $user->id,
            'choice' => $request->choice,
            'ip_address' => $ipAddress,
            'location' => $location,
        ]);

        return response()->json(['message' => 'Vote recorded successfully.'], 201);
    }

    private function getLocationFromIP($ip)
    {
        // Use a geolocation service to get the location from the IP address
        // Example using ipinfo.io:
        $response = Http::get("http://ipinfo.io/{$ip}/json");

        if ($response->successful()) {
            return $response->json()['city'] ?? 'Unknown';
        }

        return 'Unknown';
    }
}
