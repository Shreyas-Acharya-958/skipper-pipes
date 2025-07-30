<?php

namespace App\Http\Controllers;

use App\Models\BlogComment;
use App\Models\CareerApplication;
use App\Models\Contact;
use App\Models\PartnerEnquiry;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    public function index()
    {
        $inquiries = [
            'career' => CareerApplication::count(),
            'contact' => Contact::count(),
            'dealer' => PartnerEnquiry::where('partner_id', 1)->count(),
            'distributor' => PartnerEnquiry::where('partner_id', 2)->count(),
            'blog_comment' => BlogComment::count(),
        ];
        return view('admin.dashboard', compact('inquiries'));
    }

    public function deleteInquiry(Request $request)
    {
        $type = $request->input('type');
        $id = $request->input('id');
        $model = null;
        switch ($type) {
            case 'career':
                $model = \App\Models\CareerApplication::find($id);
                break;
            case 'contact':
                $model = \App\Models\Contact::find($id);
                break;
            case 'partner':
                $model = \App\Models\PartnerEnquiry::find($id);
                break;
            case 'blog_comment':
                $model = \App\Models\BlogComment::find($id);
                break;
        }
        if ($model) {
            $model->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

    public function exportCareerApplications()
    {
        $careers = CareerApplication::all();

        $filename = 'career_applications_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($careers) {
            $file = fopen('php://output', 'w');

            // Add headers
            fputcsv($file, ['Name', 'Email', 'Phone', 'Subject', 'DOB', 'Address', 'Resume Download Link', 'Created At']);

            // Add data
            foreach ($careers as $career) {
                $resumeLink = '';
                if ($career->resume_path) {
                    $resumeLink = url('storage/' . $career->resume_path);
                }

                fputcsv($file, [
                    $career->name,
                    $career->email,
                    $career->phone,
                    $career->subject,
                    $career->dob ? date('Y-m-d', strtotime($career->dob)) : '',
                    $career->address,
                    $resumeLink,
                    $career->created_at ? date('Y-m-d H:i:s', strtotime($career->created_at)) : ''
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportContacts()
    {
        $contacts = Contact::all();

        $filename = 'contacts_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($contacts) {
            $file = fopen('php://output', 'w');

            // Add headers
            fputcsv($file, ['Name', 'Email', 'Phone', 'Subject', 'Message', 'Status', 'Is Active', 'Created At']);

            // Add data
            foreach ($contacts as $contact) {
                fputcsv($file, [
                    $contact->name,
                    $contact->email,
                    $contact->phone,
                    $contact->subject,
                    $contact->message,
                    $contact->status ? 'Active' : 'Inactive',
                    $contact->is_active ? 'Yes' : 'No',
                    $contact->created_at ? date('Y-m-d H:i:s', strtotime($contact->created_at)) : ''
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportDealerEnquiries()
    {
        $dealers = PartnerEnquiry::where('partner_id', 1)->get();

        $filename = 'dealer_enquiries_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($dealers) {
            $file = fopen('php://output', 'w');

            // Add headers
            fputcsv($file, ['Name', 'Email', 'Phone', 'Firm Name', 'GST', 'Pincode', 'Occupation', 'Experience', 'Dealership Type', 'Description', 'Created At']);

            // Add data
            foreach ($dealers as $dealer) {
                fputcsv($file, [
                    $dealer->name,
                    $dealer->email,
                    $dealer->phone,
                    $dealer->firm_name,
                    $dealer->gst,
                    $dealer->pincode,
                    $dealer->occupation,
                    $dealer->experience,
                    $dealer->dealership_type,
                    $dealer->description,
                    $dealer->created_at ? date('Y-m-d H:i:s', strtotime($dealer->created_at)) : ''
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportDistributorEnquiries()
    {
        $distributors = PartnerEnquiry::where('partner_id', 2)->get();

        $filename = 'distributor_enquiries_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($distributors) {
            $file = fopen('php://output', 'w');

            // Add headers
            fputcsv($file, ['Name', 'Email', 'Phone', 'Firm Name', 'GST', 'Pincode', 'Occupation', 'Experience', 'Dealership Type', 'Description', 'Created At']);

            // Add data
            foreach ($distributors as $distributor) {
                fputcsv($file, [
                    $distributor->name,
                    $distributor->email,
                    $distributor->phone,
                    $distributor->firm_name,
                    $distributor->gst,
                    $distributor->pincode,
                    $distributor->occupation,
                    $distributor->experience,
                    $distributor->dealership_type,
                    $distributor->description,
                    $distributor->created_at ? date('Y-m-d H:i:s', strtotime($distributor->created_at)) : ''
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportBlogComments()
    {
        $comments = BlogComment::all();

        $filename = 'blog_comments_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($comments) {
            $file = fopen('php://output', 'w');

            // Add headers
            fputcsv($file, ['Name', 'Email', 'Description', 'Status', 'Created At']);

            // Add data
            foreach ($comments as $comment) {
                fputcsv($file, [
                    $comment->name,
                    $comment->email,
                    $comment->description,
                    $comment->status == 0 ? 'Pending' : 'Approved',
                    $comment->created_at ? date('Y-m-d H:i:s', strtotime($comment->created_at)) : ''
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
