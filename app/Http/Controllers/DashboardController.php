<?php

namespace App\Http\Controllers;

use App\Models\BlogComment;
use App\Models\CareerApplication;
use App\Models\Contact;
use App\Models\PartnerEnquiry;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $inquiries = [
            'career' => CareerApplication::count(),
            'contact' => Contact::count(),
            'partner' => PartnerEnquiry::count(),
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
}
