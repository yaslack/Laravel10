<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Event extends Model
{
    use HasFactory;


    public function removeEvent(String $request)
    {
        try {
            // Convert the request string to a Carbon datetime instance
            $timestamp = \Carbon\Carbon::parse($request);
    
            // Fetch the event by its created_at timestamp
            $event = Event::where('created_at', $timestamp)->first();
    
            if (!$event) {
                return response()->json(['message' => 'Event not found'], 404);
            }
    
            // Delete the event
            $event->delete();
    
        } catch (\Exception $e) {
            // Handle any exceptions that may occur while parsing the timestamp
            return response()->json(['message' => 'Invalid timestamp'], 400);
        }
    }
    
}
