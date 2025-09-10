<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Exception;

class InquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'full_name' =>'required','string','max:255','regex:/^[A-Za-z ]+$/',
                'country_code' => 'required|string',
                'contact_number' => 'required|string',
                'email' => 'required|email|email:rfc,dns',
                'message' => 'nullable|string',
            ]);

            // Store in database
            inquiry::create($validated);

            // Send email
            try {
                Mail::send([], [], function ($message) use ($validated) {
                    $message->to('careers@leadsagri.com')
                        ->subject('New Inquiry from ' . $validated['full_name'])
                        ->html(
                            '<div style="font-family: Arial, sans-serif; padding: 20px; max-width: 600px; margin: 0 auto;">
                                <h2 style="color: #2E7D32; margin-bottom: 20px;">New Inquiry Received</h2>
                                <div style="background-color: #f9f9f9; padding: 20px; border-radius: 5px;">
                                    <p style="margin: 10px 0;"><strong>Name:</strong> ' . htmlspecialchars($validated['full_name']) . '</p>
                                    <p style="margin: 10px 0;"><strong>Email:</strong> ' . htmlspecialchars($validated['email']) . '</p>
                                    <p style="margin: 10px 0;"><strong>Contact Number:</strong> ' . htmlspecialchars($validated['country_code']) . ' ' . htmlspecialchars($validated['contact_number']) . '</p>' .
                                    (!empty($validated['message']) ? '<p style="margin: 10px 0;"><strong>Message:</strong><br>' . nl2br(htmlspecialchars($validated['message'])) . '</p>' : '') . '
                                </div>
                            </div>'
                        );
                });
            } catch (Exception $e) {
                Log::error('Email sending failed: ' . $e->getMessage());
                Log::error('Email configuration: ' . json_encode([
                    'mailer' => config('mail.default'),
                    'host' => config('mail.mailers.smtp.host'),
                    'port' => config('mail.mailers.smtp.port'),
                    'username' => config('mail.mailers.smtp.username'),
                    'encryption' => config('mail.mailers.smtp.encryption'),
                    'from_address' => config('mail.from.address'),
                ]));
                return response()->json([
                    'message' => 'Inquiry was saved but email could not be sent. Please contact support.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return response()->json(['message' => 'Inquiry submitted successfully']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            Log::error('Inquiry submission failed: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to submit inquiry: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Inquiry $inquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inquiry $inquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inquiry $inquiry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inquiry $inquiry)
    {
        //
    }
}
