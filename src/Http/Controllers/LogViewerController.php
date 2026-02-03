<?php

namespace Ibrah\LaravelLogViewer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
use Ibrah\LaravelLogViewer\Services\LogParser;

class LogViewerController extends Controller
{
    protected LogParser $logParser;

    public function __construct(LogParser $logParser)
    {
        $this->logParser = $logParser;
    }

    /**
     * Display the log viewer dashboard
     */
    public function index(Request $request)
    {
        $logDirectory = config('log-viewer.log_path', storage_path('logs'));
        $logFiles = $this->logParser->getLogFiles($logDirectory);

        // Get selected log file
        $selectedFile = $request->get('file', 'laravel.log');
        $logPath = $logDirectory . '/' . $selectedFile;

        // Get filters
        $filters = [
            'level' => $request->get('level'),
            'search' => $request->get('search'),
            'date_from' => $request->get('date_from'),
            'date_to' => $request->get('date_to'),
        ];

        // Parse logs
        $logs = $this->logParser->parse($logPath, $filters);

        // Pagination
        $perPage = config('log-viewer.per_page', 25);
        $page = $request->get('page', 1);
        $paginatedLogs = $this->paginateLogs($logs, $perPage, $page);

        // Get statistics
        $allLogs = $this->logParser->parse($logPath);
        $statistics = $this->logParser->getStatistics($allLogs);

        // Log levels for filter
        $logLevels = ['emergency', 'alert', 'critical', 'error', 'warning', 'notice', 'info', 'debug'];

        return view('log-viewer::index', [
            'logs' => $paginatedLogs['data'],
            'pagination' => $paginatedLogs['pagination'],
            'logFiles' => $logFiles,
            'selectedFile' => $selectedFile,
            'filters' => $filters,
            'statistics' => $statistics,
            'logLevels' => $logLevels,
            'currentLocale' => app()->getLocale(),
            'availableLocales' => config('log-viewer.available_locales', ['en' => 'English', 'ar' => 'Arabic']),
        ]);
    }

    /**
     * Show a single log entry details
     */
    public function show(Request $request, int $id)
    {
        $logDirectory = config('log-viewer.log_path', storage_path('logs'));
        $selectedFile = $request->get('file', 'laravel.log');
        $logPath = $logDirectory . '/' . $selectedFile;

        $logs = $this->logParser->parse($logPath);
        $log = $logs->firstWhere('id', $id);

        if (!$log) {
            return response()->json(['error' => __('log-viewer::log-viewer.log_not_found')], 404);
        }

        return response()->json($log);
    }

    /**
     * Clear the log file
     */
    public function clear(Request $request)
    {
        $logDirectory = config('log-viewer.log_path', storage_path('logs'));
        $selectedFile = $request->get('file', 'laravel.log');
        $logPath = $logDirectory . '/' . $selectedFile;

        if ($this->logParser->clearLog($logPath)) {
            return redirect()->back()->with('success', __('log-viewer::log-viewer.cleared_success'));
        }

        return redirect()->back()->with('error', __('log-viewer::log-viewer.cleared_failed'));
    }

    /**
     * Download the log file
     */
    public function download(Request $request)
    {
        $logDirectory = config('log-viewer.log_path', storage_path('logs'));
        $selectedFile = $request->get('file', 'laravel.log');
        $logPath = $logDirectory . '/' . $selectedFile;

        if (!file_exists($logPath)) {
            return redirect()->back()->with('error', __('log-viewer::log-viewer.file_not_found'));
        }

        return Response::download($logPath, $selectedFile);
    }

    /**
     * Set the locale for the log viewer
     */
    public function setLocale(Request $request)
    {
        $locale = $request->input('locale');
        $availableLocales = array_keys(config('log-viewer.available_locales', ['en' => 'English', 'ar' => 'Arabic']));

        if (in_array($locale, $availableLocales)) {
            session(['log-viewer-locale' => $locale]);
        }

        return redirect()->back();
    }

    /**
     * Paginate logs collection
     */
    protected function paginateLogs($logs, int $perPage, int $page): array
    {
        $total = $logs->count();
        $lastPage = (int) ceil($total / $perPage);
        $page = max(1, min($page, $lastPage));

        $data = $logs->slice(($page - 1) * $perPage, $perPage)->values();

        return [
            'data' => $data,
            'pagination' => [
                'total' => $total,
                'per_page' => $perPage,
                'current_page' => $page,
                'last_page' => $lastPage,
                'from' => ($page - 1) * $perPage + 1,
                'to' => min($page * $perPage, $total),
            ],
        ];
    }
}
