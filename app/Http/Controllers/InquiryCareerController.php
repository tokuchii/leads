<?php

namespace App\Http\Controllers;

use App\Models\InquiryCareer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Exception;

class InquiryCareerController extends Controller
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
                'full_name' => 'required|string|max:255|regex:/^[A-Za-z ]+$/',
                'email' => 'required|email|email:rfc,dns',
                'position' => 'required|string|max:255',
                'message' => 'nullable|string',
                'resume_file' => 'nullable|file|mimes:pdf,doc,docx|max:15360',
            ]);

            // Handle file upload if present
            if ($request->hasFile('resume_file')) {
                $file = $request->file('resume_file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('resumes'), $fileName);
                $validated['resume_file'] = $fileName;
            }

            // Store in database
            InquiryCareer::create($validated);

            // Send email
            try {
                Mail::send([], [], function ($message) use ($validated) {
                    $message->to('careers@leadsagri.com')
                        ->subject('New Career Application from ' . $validated['full_name'])
                        ->html(
                            '<div style="font-family: Arial, sans-serif; padding: 20px; max-width: 600px; margin: 0 auto;">
                                <h2 style="color: #2E7D32; margin-bottom: 20px;">New Career Application Received</h2>
                                <div style="background-color: #f9f9f9; padding: 20px; border-radius: 5px;">
                                    <p style="margin: 10px 0;"><strong>Name:</strong> ' . htmlspecialchars($validated['full_name']) . '</p>
                                    <p style="margin: 10px 0;"><strong>Email:</strong> ' . htmlspecialchars($validated['email']) . '</p>
                                    <p style="margin: 10px 0;"><strong>Position:</strong> ' . htmlspecialchars($validated['position']) . '</p>' .
                                    (!empty($validated['message']) ? '<p style="margin: 10px 0;"><strong>Message:</strong><br>' . nl2br(htmlspecialchars($validated['message'])) . '</p>' : '') . '
                                    <p style="margin: 10px 0;"><strong>Resume:</strong> ' . (isset($validated['resume_file']) ? 'Attached to this email' : 'No file uploaded') . '</p>
                                </div>
                            </div>'
                        );

                    // Attach the resume file if it exists
                    if (isset($validated['resume_file'])) {
                        $filePath = public_path('resumes/' . $validated['resume_file']);
                        if (file_exists($filePath)) {
                            $message->attach($filePath, [
                                'as' => $validated['resume_file'],
                                'mime' => mime_content_type($filePath)
                            ]);
                        }
                    }
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
                    'message' => 'Application was saved but email could not be sent. Please contact support.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return response()->json(['message' => 'Career application submitted successfully']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'No data found, Please fill-up the blank field.',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            Log::error('Career application submission failed: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to submit application: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(InquiryCareer $inquiryCareer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InquiryCareer $inquiryCareer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InquiryCareer $inquiryCareer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InquiryCareer $inquiryCareer)
    {
        //
    }
}
