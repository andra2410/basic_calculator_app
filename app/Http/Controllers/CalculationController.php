<?php

namespace App\Http\Controllers;

use App\Models\Calculation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CalculationController extends Controller
{
    /**
     * Display the calculation history for the authenticated user.
     */
    public function index(): View
    {
        $calculations = Auth::user()->calculations()->latest()->get();

        return view('history', ['calculations' => $calculations]);
    }

    /**
     * Store a newly created calculation.
     */
    public function store(Request $request): JsonResponse
    {
        if (! Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validated = $request->validate([
            'expression' => ['required', 'string'],
            'result' => ['required', 'string'],
        ]);

        $calculation = Calculation::create([
            'user_id' => Auth::id(),
            'expression' => $validated['expression'],
            'result' => $validated['result'],
        ]);

        return response()->json(['success' => true, 'calculation' => $calculation]);
    }
}
