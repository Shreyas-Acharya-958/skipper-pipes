<?php

namespace App\Http\Controllers;

use App\Models\BlogComment;
use App\Models\CareerApplication;
use App\Models\Contact;
use App\Models\PartnerEnquiry;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Exports\CareerApplicationsExport;
use App\Exports\ContactsExport;
use App\Exports\DealerEnquiriesExport;
use App\Exports\DistributorEnquiriesExport;
use App\Exports\BlogCommentsExport;
use Maatwebsite\Excel\Facades\Excel;

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
        $filename = 'career_applications_' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new CareerApplicationsExport, $filename);
    }

    public function exportContacts()
    {
        $filename = 'contacts_' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new ContactsExport, $filename);
    }

    public function exportDealerEnquiries()
    {
        $filename = 'dealer_enquiries_' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new DealerEnquiriesExport, $filename);
    }

    public function exportDistributorEnquiries()
    {
        $filename = 'distributor_enquiries_' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new DistributorEnquiriesExport, $filename);
    }

    public function exportBlogComments()
    {
        $filename = 'blog_comments_' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new BlogCommentsExport, $filename);
    }
}
