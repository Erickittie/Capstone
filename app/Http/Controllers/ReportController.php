<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function index()
    {
        $reports = collect(Storage::disk('public')->files('reports'))
            ->map(function ($file) {

                return [
                    'filename' => basename($file),
                    'date' => date(
                        'M d, Y',
                        Storage::disk('public')->lastModified($file)
                    ),
                    'size' => $this->formatSize(
                        Storage::disk('public')->size($file)
                    ),
                ];

            })
            ->sortByDesc('date');

        return view('admin.reports.index', compact('reports'));
    }

    public function enrollment()
    {

        return redirect()
            ->route('reports.index')
            ->with('success', 'Enrollment report generated successfully.');
    }

    public function contribution()
    {
     
        return redirect()
            ->route('reports.index')
            ->with('success', 'Contribution fairness report generated successfully.');
    }

    public function completion()
    {
        
        return redirect()
            ->route('reports.index')
            ->with('success', 'Completion trends report generated successfully.');
    }

    public function download($filename)
    {
        $path = 'reports/' . $filename;

        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }

        return Storage::disk('public')->download($path);
    }

    private function formatSize($bytes)
    {
        if ($bytes >= 1024 * 1024) {
            return round($bytes / (1024 * 1024), 1) . ' MB';
        }

        if ($bytes >= 1024) {
            return round($bytes / 1024, 1) . ' KB';
        }

        return $bytes . ' B';
    }
}