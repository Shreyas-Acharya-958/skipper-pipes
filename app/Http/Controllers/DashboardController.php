<?php

namespace App\Http\Controllers;

use App\Models\BlogComment;
use App\Models\CareerApplication;
use App\Models\Contact;
use App\Models\PartnerEnquiry;

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
}