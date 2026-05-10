<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Inertia\Inertia;
use Inertia\Response;

class ContactSubmissionController extends Controller
{
    public function index(Request $request): Response
    {
        $filters = [
            'q' => trim((string) $request->query('q', '')),
            'source' => (string) $request->query('source', ''),
            'locale' => (string) $request->query('locale', ''),
            'read' => (string) $request->query('read', ''),
            'sort' => (string) $request->query('sort', 'latest'),
            'per_page' => (int) $request->integer('per_page', 15),
        ];

        $perPage = in_array($filters['per_page'], [10, 15, 25, 50], true) ? $filters['per_page'] : 15;

        $query = $this->applyFilters(ContactSubmission::query(), $filters);

        $stats = [
            'total' => ContactSubmission::count(),
            'unread' => ContactSubmission::where('is_read', false)->count(),
            'today' => ContactSubmission::whereDate('created_at', now()->toDateString())->count(),
            'filtered' => (clone $query)->count(),
        ];

        $submissions = $query
            ->paginate($perPage)
            ->withQueryString();

        return Inertia::render('ContactSubmissions/Index', [
            'submissions' => $submissions,
            'filters' => $filters,
            'stats' => $stats,
        ]);
    }

    public function markRead(Request $request, ContactSubmission $contactSubmission): RedirectResponse
    {
        $data = $request->validate([
            'is_read' => ['required', 'boolean'],
        ]);

        $contactSubmission->update([
            'is_read' => (bool) $data['is_read'],
            'read_at' => (bool) $data['is_read'] ? now() : null,
        ]);

        return back()->with('success', $data['is_read'] ? 'Submission marked as read.' : 'Submission marked as unread.');
    }

    public function destroy(ContactSubmission $contactSubmission): RedirectResponse
    {
        $contactSubmission->delete();

        return back()->with('success', 'Submission deleted successfully.');
    }

    public function bulkDestroy(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['integer', 'exists:contact_submissions,id'],
        ]);

        $deletedCount = ContactSubmission::whereIn('id', $data['ids'])->delete();

        return back()->with('success', "{$deletedCount} submission(s) deleted.");
    }

    public function export(Request $request): StreamedResponse
    {
        $filters = [
            'q' => trim((string) $request->query('q', '')),
            'source' => (string) $request->query('source', ''),
            'locale' => (string) $request->query('locale', ''),
            'read' => (string) $request->query('read', ''),
            'sort' => (string) $request->query('sort', 'latest'),
        ];

        $rows = $this->applyFilters(ContactSubmission::query(), $filters)
            ->get([
                'id',
                'name',
                'email',
                'subject',
                'message',
                'locale',
                'source',
                'is_read',
                'read_at',
                'ip_address',
                'created_at',
            ]);

        $filename = 'contact_submissions_' . now()->format('Ymd_His') . '.csv';

        return response()->streamDownload(function () use ($rows): void {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'ID',
                'Name',
                'Email',
                'Subject',
                'Message',
                'Locale',
                'Source',
                'Read',
                'Read At',
                'IP Address',
                'Created At',
            ]);

            foreach ($rows as $row) {
                fputcsv($handle, [
                    $row->id,
                    $row->name,
                    $row->email,
                    $row->subject,
                    $row->message,
                    $row->locale,
                    $row->source,
                    $row->is_read ? 'yes' : 'no',
                    optional($row->read_at)?->toDateTimeString(),
                    $row->ip_address,
                    optional($row->created_at)?->toDateTimeString(),
                ]);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    /**
     * @param  array{q:string,source:string,locale:string,read:string,sort:string,per_page?:int}  $filters
     */
    private function applyFilters(Builder $query, array $filters): Builder
    {
        if ($filters['q'] !== '') {
            $search = '%' . str_replace('%', '\\%', $filters['q']) . '%';
            $query->where(function (Builder $inner) use ($search): void {
                $inner->where('name', 'like', $search)
                    ->orWhere('email', 'like', $search)
                    ->orWhere('subject', 'like', $search)
                    ->orWhere('message', 'like', $search);
            });
        }

        if (in_array($filters['source'], ['home', 'contact'], true)) {
            $query->where('source', $filters['source']);
        }

        if (in_array($filters['locale'], ['en', 'id'], true)) {
            $query->where('locale', $filters['locale']);
        }

        if (in_array($filters['read'], ['read', 'unread'], true)) {
            $query->where('is_read', $filters['read'] === 'read');
        }

        if (($filters['sort'] ?? 'latest') === 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }

        return $query;
    }
}
