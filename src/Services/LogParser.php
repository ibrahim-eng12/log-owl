<?php

namespace Ibrah\LaravelLogViewer\Services;

use Illuminate\Support\Collection;
use Carbon\Carbon;

class LogParser
{
    /**
     * Common Laravel error patterns mapped to translation keys
     */
    protected array $errorPatterns = [
        // =====================================
        // SMTP/Mail Errors
        // =====================================
        'Expected response code.*but got code.*451.*[Rr]atelimit' => 'smtp_rate_limit',
        'Expected response code.*but got code.*451' => 'smtp_rejected',
        'Expected response code.*but got code.*421' => 'smtp_service_unavailable',
        'Expected response code.*but got code.*550.*[Bb]locked' => 'smtp_blocked',
        'Expected response code.*but got code.*550' => 'smtp_rejected_recipient',
        'Expected response code.*but got code.*535' => 'smtp_auth_failed',
        'Expected response code.*but got code.*530' => 'smtp_auth_required',
        'Expected response code.*but got code.*454' => 'smtp_temp_auth_failure',
        'Swift_TransportException' => 'mail_transport',
        'SymfonyMailer.*TransportException' => 'mail_transport',
        'Failed to authenticate on SMTP server' => 'smtp_auth_failed',
        'Connection could not be established with host' => 'smtp_connection_failed',
        'stream_socket_client.*Connection refused' => 'smtp_connection_refused',
        'stream_socket_client.*Connection timed out' => 'smtp_connection_timeout',

        // =====================================
        // Database Errors - Data Issues
        // =====================================
        'SQLSTATE\[01000\].*Data truncated' => 'data_truncated',
        'SQLSTATE\[22001\].*Data too long' => 'data_too_long',
        'SQLSTATE\[22003\].*Out of range' => 'numeric_out_of_range',
        'SQLSTATE\[22007\].*Incorrect.*value' => 'incorrect_value_format',
        'SQLSTATE\[HY000\].*Incorrect string value' => 'incorrect_string_value',

        // Database Errors - Constraints
        'SQLSTATE\[23000\].*Duplicate entry' => 'duplicate_entry',
        'SQLSTATE\[23000\].*foreign key constraint fails' => 'foreign_key_constraint',
        'SQLSTATE\[23000\].*cannot be null' => 'null_constraint_violation',
        'SQLSTATE\[23000\].*Integrity constraint violation' => 'integrity_constraint',

        // Database Errors - Structure
        'SQLSTATE\[42S02\].*Table.*doesn\'t exist' => 'missing_table',
        'SQLSTATE\[42S22\].*Column not found' => 'missing_column',
        'SQLSTATE\[42000\].*Syntax error' => 'sql_syntax_error',
        'SQLSTATE\[42S21\].*Duplicate column' => 'duplicate_column',

        // Database Errors - Connection
        'SQLSTATE\[HY000\].*Connection refused' => 'database_connection',
        'SQLSTATE\[HY000\].*Access denied' => 'database_access_denied',
        'SQLSTATE\[HY000\].*Too many connections' => 'too_many_connections',
        'SQLSTATE\[HY000\].*MySQL server has gone away' => 'mysql_gone_away',
        'SQLSTATE\[08006\]' => 'database_connection',
        'SQLSTATE\[08001\]' => 'database_connection',

        // Database Errors - Performance/Locks
        'SQLSTATE\[40001\].*Deadlock' => 'database_deadlock',
        'SQLSTATE\[HY000\].*Lock wait timeout exceeded' => 'lock_wait_timeout',

        // =====================================
        // Laravel Model Errors
        // =====================================
        'ModelNotFoundException' => 'model_not_found',
        'MassAssignmentException' => 'mass_assignment',
        'RelationNotFoundException' => 'relation_not_found',
        'JsonEncodingException' => 'json_encoding_error',

        // =====================================
        // Authentication & Authorization
        // =====================================
        'Unauthenticated' => 'authentication',
        'AuthenticationException' => 'authentication',
        'AuthorizationException' => 'authorization',
        'AccessDeniedHttpException' => 'access_denied',
        'TokenMismatchException' => 'csrf_mismatch',
        'InvalidSignatureException' => 'invalid_signature',
        'ExpiredSignatureException' => 'expired_signature',
        'ThrottleRequestsException' => 'too_many_requests',
        'TooManyRequestsHttpException' => 'too_many_requests',

        // =====================================
        // File/Storage Errors
        // =====================================
        'file_put_contents.*Permission denied' => 'file_permission',
        'fopen.*failed to open stream' => 'file_not_found',
        'chmod.*Operation not permitted' => 'file_permission',
        'mkdir.*Permission denied' => 'directory_permission',
        'unlink.*Permission denied' => 'file_delete_permission',
        'FileNotFoundException' => 'file_not_found',
        'Disk \[.*\] does not have a configured driver' => 'disk_not_configured',
        'Unable to create lockable file' => 'file_lock_failed',
        'The file.*was not uploaded due to an unknown error' => 'upload_failed',
        'The file failed to upload' => 'upload_failed',
        'The file.*exceeds your upload_max_filesize' => 'upload_too_large',

        // =====================================
        // View/Blade Errors
        // =====================================
        'View \[.*\] not found' => 'view_not_found',
        'Undefined variable.*\(View:' => 'undefined_view_variable',
        'ErrorException.*Undefined variable' => 'undefined_variable',
        'Component \[.*\] not found' => 'component_not_found',

        // =====================================
        // Class/Method/Function Errors
        // =====================================
        'Class.*not found' => 'class_not_found',
        'Interface.*not found' => 'interface_not_found',
        'Trait.*not found' => 'trait_not_found',
        'Call to undefined method' => 'undefined_method',
        'Call to undefined function' => 'undefined_function',
        'Call to a member function.*on null' => 'null_method_call',
        'Call to a member function.*on bool' => 'bool_method_call',
        'Call to a member function.*on array' => 'array_method_call',
        'Cannot access property.*on null' => 'null_property_access',
        'Trying to get property.*of non-object' => 'non_object_property',
        'Too few arguments to function' => 'missing_arguments',
        'Argument.*must be of type' => 'type_mismatch',

        // =====================================
        // Route Errors
        // =====================================
        'Route \[.*\] not defined' => 'route_not_found',
        'MethodNotAllowedHttpException' => 'method_not_allowed',
        'NotFoundHttpException' => 'not_found_404',
        'Missing required parameter' => 'missing_route_parameter',
        'Controller method.*not found' => 'controller_method_not_found',

        // =====================================
        // Validation Errors
        // =====================================
        'ValidationException' => 'validation',
        'The given data was invalid' => 'validation',
        'UnexpectedValueException.*Expected argument' => 'invalid_argument',

        // =====================================
        // Memory/Timeout Errors
        // =====================================
        'Allowed memory size.*exhausted' => 'memory_limit',
        'Maximum execution time.*exceeded' => 'execution_timeout',
        'Maximum function nesting level' => 'recursion_limit',

        // =====================================
        // Queue Errors
        // =====================================
        'MaxAttemptsExceededException' => 'queue_failed',
        'InvalidPayloadException' => 'queue_invalid_payload',
        'Job has been attempted too many times' => 'queue_max_attempts',
        'Queue connection \[.*\] is not defined' => 'queue_not_configured',

        // =====================================
        // Cache & Session Errors
        // =====================================
        'Cache store \[.*\] is not defined' => 'cache_not_configured',
        'Session store has not been set on request' => 'session_not_configured',
        'Unable to acquire lock' => 'lock_acquisition_failed',

        // =====================================
        // Redis Errors
        // =====================================
        'RedisException' => 'redis_connection',
        'Redis connection refused' => 'redis_connection_refused',
        'NOAUTH Authentication required' => 'redis_auth_required',
        'ERR max number of clients reached' => 'redis_max_clients',

        // =====================================
        // API/HTTP Errors
        // =====================================
        'cURL error 28' => 'http_timeout',
        'cURL error 6' => 'http_dns_failed',
        'cURL error 7' => 'http_connection_refused',
        'cURL error 35' => 'http_ssl_error',
        'cURL error 60' => 'http_ssl_certificate',
        'GuzzleHttp.*ConnectException' => 'http_connection_failed',
        'GuzzleHttp.*RequestException' => 'http_request_failed',
        'Client error:.*400' => 'http_bad_request',
        'Client error:.*401' => 'http_unauthorized',
        'Client error:.*403' => 'http_forbidden',
        'Client error:.*404' => 'http_not_found',
        'Client error:.*422' => 'http_unprocessable',
        'Client error:.*429' => 'http_rate_limited',
        'Server error:.*500' => 'http_server_error',
        'Server error:.*502' => 'http_bad_gateway',
        'Server error:.*503' => 'http_service_unavailable',
        'Server error:.*504' => 'http_gateway_timeout',

        // =====================================
        // JSON Errors
        // =====================================
        'JSON_ERROR_SYNTAX' => 'invalid_json',
        'Malformed JSON' => 'invalid_json',
        'json_decode.*Syntax error' => 'invalid_json',

        // =====================================
        // Encryption/Decryption Errors
        // =====================================
        'DecryptException' => 'decryption_failed',
        'EncryptException' => 'encryption_failed',
        'The MAC is invalid' => 'mac_invalid',
        'The payload is invalid' => 'invalid_payload',
        'No application encryption key has been specified' => 'missing_app_key',

        // =====================================
        // Service Provider/Container Errors
        // =====================================
        'BindingResolutionException' => 'binding_resolution',
        'Target class \[.*\] does not exist' => 'target_class_not_found',
        'Target \[.*\] is not instantiable' => 'not_instantiable',
        'Container recursion detected' => 'container_recursion',

        // =====================================
        // Broadcast Errors
        // =====================================
        'BroadcastException' => 'broadcast_failed',
        'Pusher error' => 'pusher_error',

        // =====================================
        // Event/Listener Errors
        // =====================================
        'Listener.*not found' => 'listener_not_found',

        // =====================================
        // Scheduler/Artisan Errors
        // =====================================
        'Command.*not found' => 'artisan_command_not_found',
        'The command.*is not defined' => 'artisan_command_not_defined',

        // =====================================
        // PHP Type Errors
        // =====================================
        'TypeError' => 'type_error',
        'Argument.*passed to.*must be.*given' => 'type_mismatch',
        'Return value.*must be of type' => 'return_type_error',

        // =====================================
        // PHP General Errors
        // =====================================
        'Undefined variable' => 'undefined_variable',
        'Undefined array key' => 'undefined_array_key',
        'Undefined offset' => 'undefined_offset',
        'Undefined property' => 'undefined_property',
        'Division by zero' => 'division_by_zero',
        'Cannot use object of type.*as array' => 'object_as_array',
        'Array to string conversion' => 'array_to_string',
        'Object of class.*could not be converted to string' => 'object_to_string',

        // =====================================
        // SSL/TLS Errors
        // =====================================
        'SSL certificate problem' => 'ssl_certificate_error',
        'SSL: Connection reset by peer' => 'ssl_connection_reset',
        'SSL routines.*certificate verify failed' => 'ssl_verify_failed',

        // =====================================
        // Regex Errors
        // =====================================
        'preg_match.*Compilation failed' => 'regex_compilation_error',
        'preg_match.*Unknown modifier' => 'regex_modifier_error',

        // =====================================
        // Serialization Errors
        // =====================================
        'Serialization of.*is not allowed' => 'serialization_not_allowed',
        'unserialize.*Error at offset' => 'unserialize_error',
    ];

    /**
     * Parse the Laravel log file
     */
    public function parse(string $logPath, array $filters = []): Collection
    {
        if (!file_exists($logPath)) {
            return collect();
        }

        $content = file_get_contents($logPath);
        $logs = $this->parseLogContent($content);

        return $this->filterLogs($logs, $filters);
    }

    /**
     * Parse log content into structured entries
     */
    protected function parseLogContent(string $content): Collection
    {
        $pattern = '/\[(\d{4}-\d{2}-\d{2}[T ]\d{2}:\d{2}:\d{2}\.?\d*[\+\-]?\d*:?\d*)\]\s+(\w+)\.(\w+):\s+(.*?)(?=\[\d{4}-\d{2}-\d{2}|\z)/s';

        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

        $logs = collect();

        foreach ($matches as $index => $match) {
            $datetime = $this->parseDateTime($match[1]);
            $environment = $match[2];
            $level = strtolower($match[3]);
            $message = trim($match[4]);

            // Extract stack trace if present
            $stackTrace = '';
            $mainMessage = $message;
            if (preg_match('/^(.*?)(#\d+\s+|Stack trace:)/s', $message, $msgMatch)) {
                $mainMessage = trim($msgMatch[1]);
                $stackTrace = trim(substr($message, strlen($msgMatch[1])));
            }

            // Get error analysis
            $analysis = $this->analyzeError($message);

            $logs->push([
                'id' => $index + 1,
                'datetime' => $datetime,
                'environment' => $environment,
                'level' => $level,
                'level_class' => $this->getLevelClass($level),
                'message' => $mainMessage,
                'stack_trace' => $stackTrace,
                'full_message' => $message,
                'error_type' => $analysis['type'],
                'description' => $analysis['description'],
                'solutions' => $analysis['solutions'],
            ]);
        }

        return $logs->reverse()->values();
    }

    /**
     * Parse datetime string
     */
    protected function parseDateTime(string $datetime): Carbon
    {
        try {
            return Carbon::parse($datetime);
        } catch (\Exception $e) {
            return Carbon::now();
        }
    }

    /**
     * Analyze error and provide description and solutions
     */
    protected function analyzeError(string $message): array
    {
        foreach ($this->errorPatterns as $pattern => $translationKey) {
            if (preg_match('/' . $pattern . '/i', $message)) {
                return $this->getTranslatedError($translationKey);
            }
        }

        return $this->getTranslatedError('general');
    }

    /**
     * Get translated error information
     */
    protected function getTranslatedError(string $key): array
    {
        $errorTypes = __('log-viewer::log-viewer.error_types');

        if (isset($errorTypes[$key])) {
            return $errorTypes[$key];
        }

        // Fallback if translation is missing
        return [
            'type' => __('log-viewer::log-viewer.error_types.general.type'),
            'description' => __('log-viewer::log-viewer.error_types.general.description'),
            'solutions' => __('log-viewer::log-viewer.error_types.general.solutions'),
        ];
    }

    /**
     * Get CSS class for log level
     */
    protected function getLevelClass(string $level): string
    {
        return match ($level) {
            'emergency', 'alert', 'critical' => 'danger',
            'error' => 'error',
            'warning' => 'warning',
            'notice', 'info' => 'info',
            'debug' => 'debug',
            default => 'secondary',
        };
    }

    /**
     * Filter logs based on criteria
     */
    protected function filterLogs(Collection $logs, array $filters): Collection
    {
        if (!empty($filters['level'])) {
            $logs = $logs->filter(fn($log) => $log['level'] === $filters['level']);
        }

        if (!empty($filters['search'])) {
            $search = strtolower($filters['search']);
            $logs = $logs->filter(fn($log) =>
                str_contains(strtolower($log['message']), $search) ||
                str_contains(strtolower($log['error_type']), $search)
            );
        }

        if (!empty($filters['date_from'])) {
            $dateFrom = Carbon::parse($filters['date_from'])->startOfDay();
            $logs = $logs->filter(fn($log) => $log['datetime']->gte($dateFrom));
        }

        if (!empty($filters['date_to'])) {
            $dateTo = Carbon::parse($filters['date_to'])->endOfDay();
            $logs = $logs->filter(fn($log) => $log['datetime']->lte($dateTo));
        }

        return $logs->values();
    }

    /**
     * Get available log files
     */
    public function getLogFiles(string $logDirectory): Collection
    {
        if (!is_dir($logDirectory)) {
            return collect();
        }

        $files = glob($logDirectory . '/*.log');

        return collect($files)->map(function ($file) {
            return [
                'name' => basename($file),
                'path' => $file,
                'size' => $this->formatFileSize(filesize($file)),
                'modified' => Carbon::createFromTimestamp(filemtime($file)),
            ];
        })->sortByDesc('modified')->values();
    }

    /**
     * Format file size
     */
    protected function formatFileSize(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $power = $bytes > 0 ? floor(log($bytes, 1024)) : 0;
        return number_format($bytes / pow(1024, $power), 2) . ' ' . $units[$power];
    }

    /**
     * Get log statistics
     */
    public function getStatistics(Collection $logs): array
    {
        return [
            'total' => $logs->count(),
            'by_level' => $logs->groupBy('level')->map->count(),
            'by_type' => $logs->groupBy('error_type')->map->count()->sortDesc()->take(10),
            'by_date' => $logs->groupBy(fn($log) => $log['datetime']->format('Y-m-d'))->map->count(),
        ];
    }

    /**
     * Clear log file
     */
    public function clearLog(string $logPath): bool
    {
        if (file_exists($logPath)) {
            return file_put_contents($logPath, '') !== false;
        }
        return false;
    }

    /**
     * Download log file content
     */
    public function downloadLog(string $logPath): ?string
    {
        if (file_exists($logPath)) {
            return file_get_contents($logPath);
        }
        return null;
    }
}
