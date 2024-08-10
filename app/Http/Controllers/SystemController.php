<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\LoginActivity;

class SystemController extends Controller
{
    public function index()
    {

        $logFilePath = storage_path('logs/laravel.log');
        $logContents = File::get($logFilePath);
       
        $logLines = explode("\n", $logContents);

        $logEntries = [];

         // Iterate over each log line
         foreach ($logLines as $logLine) {
            // Parse each log line to extract date, error type, and error message
            if (preg_match('/^\[([^]]+)\].*?\(([^)]+)\): (.*)$/', $logLine, $matches)) {
                // Extract date, error type, and error message
                $date = $matches[1];
                $errorType = $matches[2];
                $errorMessage = $matches[3];

                // Extract error code (e.g., 500 or 200)
                preg_match('/([45]\d{2})/', $errorMessage, $errorCodeMatches);
                $errorCode = $errorCodeMatches[1] ?? 'N/A';

                // Add parsed log entry to the logEntries array
                $logEntries[] = [
                    'date' => $date,
                    'errorType' => $errorType,
                    'errorCode' => $errorCode,
                    'errorMessage' => implode(' ', array_slice(str_word_count($errorMessage, 2), 0, 10)),
                ];
            }
        }
        $perPage = 10; // Number of log entries per page
        $currentPage = Paginator::resolveCurrentPage('page');
        $logEntriesCollection = collect($logEntries);
        $currentPageItems = $logEntriesCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $paginatedLogEntries = new LengthAwarePaginator($currentPageItems, count($logEntries), $perPage);

        $sessions = LoginActivity::orderBy('login_time', 'desc')->paginate(10);

        return view('pages.system.logs', ['logEntries' => $paginatedLogEntries, 'sessions' => $sessions]);
    }
}
