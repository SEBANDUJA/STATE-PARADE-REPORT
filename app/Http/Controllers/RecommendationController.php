<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Recommendation;
use App\Models\User;
use App\Notifications\RecommendationNotification;
use Illuminate\Support\Facades\Auth;

class RecommendationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recom = Recommendation::all();
        return view ('admin.recommendation', compact('recom'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'send_to' => 'required|string|max:255',
            'message' => 'required|string',
            'audience' => 'nullable|array',
            'audience.*' => 'string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('fail', 'Failed to send recommendation.');;
        }

        try {
            $recommendation = new Recommendation();
            $recommendation->send_to = $request->get('send_to');
            $recommendation->message = $request->get('message');
            $recommendation->audience = $request->audience ? json_encode($request->audience) : null;
            $recommendation->sent_by = Auth::id();
            $recommendation->save();

            $user = User::where('job_title', $request->send_to)->first(); // or User::find($request->send_to)
            
            if ($user) {
                $user->notify(new RecommendationNotification($recommendation));
            }
            return redirect()->back()->with('success', 'Recommendation sent successfully!');
            } catch (\Exception $e) {
                //dd($e->getMessage());  
                return redirect()->back()->with('fail', 'Something went wrong. Please try again.');
            }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
