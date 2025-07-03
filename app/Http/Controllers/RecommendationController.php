<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Recommendation;

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

        // Example: Store data in a Recommendation model (you can create it via artisan)
        // Assuming a `recommendations` table with fields: send_to, message, audience

        try {
            $recommendation = new Recommendation();
            $recommendation->send_to = $request->get('send_to');
            $recommendation->message = $request->get('message');
            $recommendation->audience = $request->audience ? json_encode($request->audience) : null;
            $recommendation->save();

                $user = User::where('job_title', $request->send_to)->first(); // or User::find($request->send_to)

                if ($user) {
                    $user->notify(new RecommendationNotification($recommendation));
                }
    //dd($request->send_to);
            return redirect()->back()->with('success', 'Recommendation sent successfully!');
            } catch (\Exception $e) {
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
