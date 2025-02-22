<?php

namespace GearboxSolutions\MailLog\Http\Controllers;

use GearboxSolutions\MailLog\Models\MailLog;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;

class MailController extends Controller
{
    public function index(Request $request)
    {
        $mailQuery = MailLog::select(['id', 'from_email', 'to_email', 'subject', 'sent_at', 'from_name', 'attachments'])
            ->selectRaw('SUBSTRING(content_text, 1, 300) as content_text');

        $search = $request->input('search');
        $dates = $request->input('dates');

        if ($search) {
            $mailQuery->where(function ($query) use ($search) {
                $query->where('subject', 'like', '%'.$search.'%')
                    ->orWhere('to_email', 'like', $search.'%')
                    ->orWhere('to_email_domain', 'like', $search.'%')
                    ->orWhere('to_name', 'like', '%'.$search.'%');
            });
        }

        if (is_array($dates)) {
            $startDate = $dates[0];
            // get the end date from the query, or if there's only one date, use the same day as the end date
            $endDate = $dates[1] ?? $dates[0];
            $mailQuery->whereBetween('sent_at', [
                date('Y-m-d 00:00:00', strtotime($startDate)),
                date('Y-m-d 23:59:59', strtotime($endDate)),
            ]);
        }

        $mail = $mailQuery->latest('sent_at')->paginate(25);

        $data = [
            'paginatedMail' => $mail,
        ];

        return Inertia::render('Mail/MailIndex', $data);
    }

    public function show(Request $request, string $id)
    {
        $mail = MailLog::find($id);

        $data = [
            'mail' => $mail,
        ];

        return Inertia::render('Mail/MailShow', $data);
    }
}
