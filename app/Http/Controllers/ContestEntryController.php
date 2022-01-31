<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Illuminate\Http\Request;
use App\Models\ContestEntry;
use App\Events\NewEntryReceivedEvent;

class ContestEntryController extends Controller
{
    public function store(Request $request) {
        $data = $request->validate([
            'email' => 'required|email',
        ]);

        ContestEntry::create($data);

        event(NewEntryReceivedEvent::class);
    }
}
