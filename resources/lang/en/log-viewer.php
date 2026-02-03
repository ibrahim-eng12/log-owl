<?php

return [

    /*
    |--------------------------------------------------------------------------
    | UI Labels
    |--------------------------------------------------------------------------
    */

    'title' => 'Laravel Log Viewer',
    'download' => 'Download',
    'clear_log' => 'Clear Log',
    'confirm_clear' => 'Are you sure you want to clear this log file?',

    /*
    |--------------------------------------------------------------------------
    | Statistics
    |--------------------------------------------------------------------------
    */

    'total_logs' => 'Total Logs',
    'errors' => 'Errors',
    'warnings' => 'Warnings',
    'info' => 'Info',

    /*
    |--------------------------------------------------------------------------
    | Filters
    |--------------------------------------------------------------------------
    */

    'log_file' => 'Log File',
    'level' => 'Level',
    'all_levels' => 'All Levels',
    'search' => 'Search',
    'search_placeholder' => 'Search logs...',
    'from_date' => 'From Date',
    'to_date' => 'To Date',
    'filter' => 'Filter',
    'reset' => 'Reset',

    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    */

    'log_entries' => 'Log Entries',
    'no_entries' => 'No log entries found',
    'no_entries_hint' => 'Try adjusting your filters or check a different log file.',
    'error_type' => 'Error Type',
    'message' => 'Message',
    'time' => 'Time',
    'actions' => 'Actions',
    'view_details' => 'View Details',

    /*
    |--------------------------------------------------------------------------
    | Pagination
    |--------------------------------------------------------------------------
    */

    'showing' => 'Showing :from to :to of :total entries',
    'previous' => 'Previous',
    'next' => 'Next',

    /*
    |--------------------------------------------------------------------------
    | Error Analysis
    |--------------------------------------------------------------------------
    */

    'top_errors' => 'Top Error Types',
    'count' => 'Count',

    /*
    |--------------------------------------------------------------------------
    | Modal
    |--------------------------------------------------------------------------
    */

    'log_details' => 'Log Details',
    'suggested_solutions' => 'Suggested Solutions',
    'stack_trace' => 'Stack Trace',
    'error_info' => 'Error Information',
    'environment' => 'Environment',
    'description' => 'Description',
    'error_message' => 'Error Message',
    'type' => 'Type',

    /*
    |--------------------------------------------------------------------------
    | Messages
    |--------------------------------------------------------------------------
    */

    'cleared_success' => 'Log file cleared successfully.',
    'cleared_failed' => 'Failed to clear log file.',
    'file_not_found' => 'Log file not found.',
    'unauthorized' => 'Unauthorized access to log viewer.',
    'not_authorized' => 'You are not authorized to access the log viewer.',
    'log_not_found' => 'Log entry not found',

    /*
    |--------------------------------------------------------------------------
    | Language Switcher
    |--------------------------------------------------------------------------
    */

    'language' => 'Language',
    'english' => 'English',
    'arabic' => 'Arabic',

    /*
    |--------------------------------------------------------------------------
    | Log Levels
    |--------------------------------------------------------------------------
    */

    'levels' => [
        'emergency' => 'Emergency',
        'alert' => 'Alert',
        'critical' => 'Critical',
        'error' => 'Error',
        'warning' => 'Warning',
        'notice' => 'Notice',
        'info' => 'Info',
        'debug' => 'Debug',
    ],

    /*
    |--------------------------------------------------------------------------
    | Error Types and Solutions
    |--------------------------------------------------------------------------
    */

    'error_types' => [
        // =====================================
        // SMTP/Mail Errors
        // =====================================
        'smtp_rate_limit' => [
            'type' => 'SMTP Rate Limit Exceeded',
            'description' => 'The mail server has rejected the email due to rate limiting. You are sending too many emails too quickly.',
            'solutions' => [
                'Reduce the frequency of emails being sent',
                'Implement email queuing with delays between sends',
                'Contact your hosting provider to increase rate limits',
                'Consider using a dedicated email service (SendGrid, Mailgun, Amazon SES)',
                'Batch emails and send them over time using Laravel queues',
            ],
        ],
        'smtp_rejected' => [
            'type' => 'SMTP Server Rejected Request',
            'description' => 'The mail server temporarily rejected the request. This is usually a temporary issue.',
            'solutions' => [
                'Wait a few minutes and try again',
                'Check if the mail server is experiencing issues',
                'Verify your SMTP credentials are correct',
                'Contact your email provider for more details',
            ],
        ],
        'smtp_service_unavailable' => [
            'type' => 'SMTP Service Unavailable',
            'description' => 'The SMTP server is temporarily unavailable or closing the connection.',
            'solutions' => [
                'Wait and retry the email sending later',
                'Check if the SMTP server is under maintenance',
                'Implement retry logic in your queue jobs',
                'Consider a backup mail server configuration',
            ],
        ],
        'smtp_blocked' => [
            'type' => 'SMTP Sender Blocked',
            'description' => 'The mail server has blocked your sender address or IP.',
            'solutions' => [
                'Check if your IP or domain is blacklisted',
                'Verify SPF, DKIM, and DMARC records are configured',
                'Contact your hosting provider about the block',
                'Use a reputable email service provider',
            ],
        ],
        'smtp_rejected_recipient' => [
            'type' => 'SMTP Recipient Rejected',
            'description' => 'The recipient email address was rejected by the mail server.',
            'solutions' => [
                'Verify the recipient email address is valid',
                'Check if the recipient mailbox exists',
                'Remove invalid emails from your mailing list',
                'Implement email validation before sending',
            ],
        ],
        'smtp_auth_failed' => [
            'type' => 'SMTP Authentication Failed',
            'description' => 'The SMTP credentials provided are incorrect or the authentication method is not supported.',
            'solutions' => [
                'Verify MAIL_USERNAME and MAIL_PASSWORD in .env',
                'Check if app-specific password is required (Gmail, etc.)',
                'Ensure MAIL_ENCRYPTION setting matches server requirements',
                'Try different authentication methods (LOGIN, PLAIN)',
            ],
        ],
        'smtp_auth_required' => [
            'type' => 'SMTP Authentication Required',
            'description' => 'The SMTP server requires authentication but none was provided.',
            'solutions' => [
                'Add MAIL_USERNAME and MAIL_PASSWORD to .env',
                'Enable authentication in your mail configuration',
                'Check if your mail driver is properly configured',
            ],
        ],
        'smtp_temp_auth_failure' => [
            'type' => 'SMTP Temporary Authentication Failure',
            'description' => 'The mail server experienced a temporary authentication failure.',
            'solutions' => [
                'Wait a moment and retry',
                'Check if the mail server is experiencing high load',
                'Verify your credentials are still valid',
            ],
        ],
        'smtp_connection_failed' => [
            'type' => 'SMTP Connection Failed',
            'description' => 'Unable to establish a connection to the SMTP server.',
            'solutions' => [
                'Verify MAIL_HOST and MAIL_PORT in .env',
                'Check if firewall is blocking the SMTP port',
                'Ensure the mail server is running and accessible',
                'Try different ports (587, 465, 25)',
            ],
        ],
        'smtp_connection_refused' => [
            'type' => 'SMTP Connection Refused',
            'description' => 'The SMTP server refused the connection.',
            'solutions' => [
                'Check if the SMTP service is running',
                'Verify the correct MAIL_PORT is configured',
                'Check firewall and network settings',
                'Confirm MAIL_HOST is correct',
            ],
        ],
        'smtp_connection_timeout' => [
            'type' => 'SMTP Connection Timeout',
            'description' => 'The connection to the SMTP server timed out.',
            'solutions' => [
                'Check network connectivity to the mail server',
                'Increase timeout values in mail configuration',
                'Verify no firewall is blocking the connection',
                'Try using a different SMTP port',
            ],
        ],
        'mail_transport' => [
            'type' => 'Mail Transport Error',
            'description' => 'Failed to send email through the mail server.',
            'solutions' => [
                'Check MAIL_* configuration in .env',
                'Verify SMTP credentials are correct',
                'Ensure mail server is accessible',
                'Check if SSL/TLS settings are correct',
            ],
        ],

        // =====================================
        // Database Errors - Data Issues
        // =====================================
        'data_truncated' => [
            'type' => 'Data Truncated Error',
            'description' => 'The data being inserted is too long for the column or does not match the expected format. This often happens with ENUM fields or when data exceeds column size.',
            'solutions' => [
                'Check the column definition in your migration (e.g., ENUM values, VARCHAR length)',
                'Verify the value being inserted matches the column type',
                'For ENUM columns, ensure the value is one of the allowed options',
                'Increase the column size if storing larger data: $table->string(\'column\', 500)',
                'Validate input data before inserting into the database',
            ],
        ],
        'data_too_long' => [
            'type' => 'Data Too Long',
            'description' => 'The value being inserted exceeds the maximum length allowed for the column.',
            'solutions' => [
                'Increase the column size in a migration',
                'Truncate or validate input data before saving',
                'Use TEXT type instead of VARCHAR for longer content',
                'Add max length validation to your form requests',
            ],
        ],
        'numeric_out_of_range' => [
            'type' => 'Numeric Value Out of Range',
            'description' => 'The numeric value exceeds the range of the column type.',
            'solutions' => [
                'Use a larger numeric type (BIGINT instead of INT)',
                'Validate numeric ranges before inserting',
                'Check for integer overflow in calculations',
            ],
        ],
        'incorrect_value_format' => [
            'type' => 'Incorrect Value Format',
            'description' => 'The value format does not match the column type (e.g., invalid date format).',
            'solutions' => [
                'Ensure dates are in Y-m-d H:i:s format for MySQL',
                'Use Carbon for date manipulation: Carbon::parse($date)',
                'Validate input format before saving',
            ],
        ],
        'incorrect_string_value' => [
            'type' => 'Incorrect String Value',
            'description' => 'The string contains characters that cannot be stored (usually encoding issues).',
            'solutions' => [
                'Ensure database charset is utf8mb4',
                'Run: ALTER DATABASE dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci',
                'Clean or encode special characters before inserting',
            ],
        ],
        'foreign_key_constraint' => [
            'type' => 'Foreign Key Constraint Violation',
            'description' => 'The operation violates a foreign key constraint. The referenced record does not exist or cannot be deleted.',
            'solutions' => [
                'Ensure the referenced record exists before inserting',
                'Delete or update child records before deleting parent',
                'Use onDelete(\'cascade\') in your migrations',
                'Set the foreign key to nullable if the relationship is optional',
            ],
        ],
        'null_constraint_violation' => [
            'type' => 'NULL Constraint Violation',
            'description' => 'Attempting to insert NULL into a column that does not allow NULL values.',
            'solutions' => [
                'Provide a value for the required column',
                'Set a default value in the migration: ->default(\'value\')',
                'Make the column nullable: ->nullable()',
                'Check if the form field is being submitted correctly',
            ],
        ],
        'integrity_constraint' => [
            'type' => 'Integrity Constraint Violation',
            'description' => 'A database integrity constraint was violated.',
            'solutions' => [
                'Check unique constraints on the table',
                'Verify foreign key references exist',
                'Ensure required fields have values',
            ],
        ],
        'database_connection' => [
            'type' => 'Database Connection Error',
            'description' => 'The application cannot connect to the database server.',
            'solutions' => [
                'Check if the database server is running',
                'Verify DB_HOST, DB_PORT in your .env file',
                'Ensure the database service is accessible from your server',
                'Check firewall settings blocking the database port',
            ],
        ],
        'database_access_denied' => [
            'type' => 'Database Access Denied',
            'description' => 'The database credentials are invalid or the user lacks permissions.',
            'solutions' => [
                'Verify DB_USERNAME and DB_PASSWORD in .env',
                'Check if the user has access to the database',
                'Run GRANT ALL ON database.* TO user@host',
                'Ensure the user can connect from your server IP',
            ],
        ],
        'too_many_connections' => [
            'type' => 'Too Many Database Connections',
            'description' => 'The maximum number of database connections has been reached.',
            'solutions' => [
                'Increase max_connections in MySQL configuration',
                'Close unused connections properly',
                'Use connection pooling',
                'Optimize queries to run faster',
            ],
        ],
        'mysql_gone_away' => [
            'type' => 'MySQL Server Has Gone Away',
            'description' => 'The connection to MySQL was lost, usually due to timeout or server restart.',
            'solutions' => [
                'Increase wait_timeout in MySQL configuration',
                'Add retry logic for long-running operations',
                'Use persistent connections carefully',
                'Check if MySQL is restarting unexpectedly',
            ],
        ],
        'database_deadlock' => [
            'type' => 'Database Deadlock',
            'description' => 'Two or more transactions are waiting for each other to release locks.',
            'solutions' => [
                'Retry the transaction automatically',
                'Keep transactions short and simple',
                'Access tables in a consistent order',
                'Use lower isolation levels if appropriate',
            ],
        ],
        'lock_wait_timeout' => [
            'type' => 'Lock Wait Timeout',
            'description' => 'A transaction waited too long for a lock to be released.',
            'solutions' => [
                'Optimize long-running queries',
                'Break large transactions into smaller ones',
                'Increase innodb_lock_wait_timeout',
                'Check for blocking transactions',
            ],
        ],
        'missing_table' => [
            'type' => 'Missing Database Table',
            'description' => 'A database table referenced in the query does not exist.',
            'solutions' => [
                'Run php artisan migrate to create missing tables',
                'Check if the table name is correct in your model',
                'Verify the database connection is using the correct database',
            ],
        ],
        'duplicate_entry' => [
            'type' => 'Duplicate Entry Error',
            'description' => 'Attempting to insert a record with a duplicate unique key.',
            'solutions' => [
                'Check for unique constraints on the table',
                'Use updateOrCreate() instead of create()',
                'Validate data before inserting to prevent duplicates',
            ],
        ],
        'missing_column' => [
            'type' => 'Missing Column Error',
            'description' => 'A database column referenced does not exist.',
            'solutions' => [
                'Run php artisan migrate to apply pending migrations',
                'Check if the column name is spelled correctly',
                'Create a migration to add the missing column',
            ],
        ],
        'sql_syntax_error' => [
            'type' => 'SQL Syntax Error',
            'description' => 'The SQL query contains a syntax error.',
            'solutions' => [
                'Check the raw SQL query for syntax issues',
                'Escape reserved keywords with backticks',
                'Verify column and table names are correct',
            ],
        ],
        'duplicate_column' => [
            'type' => 'Duplicate Column Error',
            'description' => 'Attempting to add a column that already exists.',
            'solutions' => [
                'Check if the migration was already run',
                'Use Schema::hasColumn() to check before adding',
                'Remove duplicate column definitions',
            ],
        ],

        // =====================================
        // Laravel Model Errors
        // =====================================
        'model_not_found' => [
            'type' => 'Model Not Found',
            'description' => 'The requested model record does not exist in the database.',
            'solutions' => [
                'Use findOrFail() only when the record must exist',
                'Use find() with null check for optional records',
                'Return 404 response for missing resources',
                'Check if the ID being passed is correct',
            ],
        ],
        'mass_assignment' => [
            'type' => 'Mass Assignment Violation',
            'description' => 'Attempting to fill a model attribute that is not in the fillable array.',
            'solutions' => [
                'Add the field to the $fillable array in the model',
                'Remove the field from the $guarded array',
                'Use $model->field = value for individual assignment',
            ],
        ],
        'relation_not_found' => [
            'type' => 'Relation Not Found',
            'description' => 'The specified relationship does not exist on the model.',
            'solutions' => [
                'Check if the relationship method exists on the model',
                'Verify the relationship name spelling',
                'Define the missing relationship method',
            ],
        ],
        'json_encoding_error' => [
            'type' => 'JSON Encoding Error',
            'description' => 'Failed to encode model data to JSON.',
            'solutions' => [
                'Check for non-UTF8 characters in the data',
                'Verify all model attributes can be serialized',
                'Add problematic fields to $hidden array',
            ],
        ],

        // =====================================
        // Authentication & Authorization
        // =====================================
        'authentication' => [
            'type' => 'Authentication Error',
            'description' => 'User is not authenticated or session has expired.',
            'solutions' => [
                'Ensure the user is logged in before accessing this route',
                'Check if the auth middleware is properly configured',
                'Verify session configuration in config/session.php',
                'Check if CSRF token is valid',
            ],
        ],
        'authorization' => [
            'type' => 'Authorization Error',
            'description' => 'The authenticated user does not have permission to perform this action.',
            'solutions' => [
                'Check Gate and Policy definitions',
                'Verify user roles and permissions',
                'Update authorization logic to grant access',
            ],
        ],
        'access_denied' => [
            'type' => 'Access Denied',
            'description' => 'The user is not authorized to access this resource.',
            'solutions' => [
                'Check user permissions and roles',
                'Verify middleware configuration',
                'Update authorization policies',
            ],
        ],
        'csrf_mismatch' => [
            'type' => 'CSRF Token Mismatch',
            'description' => 'The CSRF token in the request does not match the session token.',
            'solutions' => [
                'Add @csrf directive in your forms',
                'Check if session is properly configured',
                'Clear browser cookies and try again',
                'Ensure meta csrf-token tag is in your layout',
            ],
        ],
        'invalid_signature' => [
            'type' => 'Invalid Signature',
            'description' => 'The signed URL signature is invalid.',
            'solutions' => [
                'Generate a new signed URL',
                'Ensure APP_KEY has not changed',
                'Check if URL was modified after signing',
            ],
        ],
        'expired_signature' => [
            'type' => 'Expired Signature',
            'description' => 'The signed URL has expired.',
            'solutions' => [
                'Generate a new signed URL',
                'Increase the expiration time when creating the URL',
            ],
        ],
        'too_many_requests' => [
            'type' => 'Too Many Requests (Rate Limited)',
            'description' => 'The user has exceeded the rate limit for this action.',
            'solutions' => [
                'Wait before making more requests',
                'Implement request queuing on the client side',
                'Increase rate limits in RouteServiceProvider or middleware',
            ],
        ],

        // =====================================
        // File/Storage Errors
        // =====================================
        'file_permission' => [
            'type' => 'File Permission Error',
            'description' => 'The application does not have permission to write to a file or directory.',
            'solutions' => [
                'Run chmod -R 775 storage bootstrap/cache',
                'Run chown -R www-data:www-data storage',
                'Check SELinux settings on the server',
            ],
        ],
        'directory_permission' => [
            'type' => 'Directory Permission Error',
            'description' => 'Cannot create or write to a directory.',
            'solutions' => [
                'Check parent directory permissions',
                'Run mkdir with appropriate permissions',
                'Ensure web server user has write access',
            ],
        ],
        'file_delete_permission' => [
            'type' => 'File Delete Permission Error',
            'description' => 'Cannot delete a file due to permission restrictions.',
            'solutions' => [
                'Check file ownership and permissions',
                'Ensure web server user can modify the file',
            ],
        ],
        'file_not_found' => [
            'type' => 'File Not Found',
            'description' => 'The specified file does not exist or cannot be accessed.',
            'solutions' => [
                'Check if the file path is correct',
                'Verify file permissions',
                'Ensure the directory exists',
            ],
        ],
        'disk_not_configured' => [
            'type' => 'Disk Not Configured',
            'description' => 'The specified filesystem disk is not configured.',
            'solutions' => [
                'Add the disk configuration in config/filesystems.php',
                'Check FILESYSTEM_DISK in .env',
                'Verify the disk name spelling',
            ],
        ],
        'file_lock_failed' => [
            'type' => 'File Lock Failed',
            'description' => 'Unable to acquire a lock on the file.',
            'solutions' => [
                'Check file permissions',
                'Ensure no other process is locking the file',
                'Verify the storage directory is writable',
            ],
        ],
        'upload_failed' => [
            'type' => 'File Upload Failed',
            'description' => 'The file upload failed due to an error.',
            'solutions' => [
                'Check upload_max_filesize in php.ini',
                'Verify post_max_size is large enough',
                'Ensure storage directory has write permissions',
            ],
        ],
        'upload_too_large' => [
            'type' => 'File Upload Too Large',
            'description' => 'The uploaded file exceeds the maximum allowed size.',
            'solutions' => [
                'Increase upload_max_filesize in php.ini',
                'Increase post_max_size in php.ini',
                'Add file size validation in your form request',
            ],
        ],

        // =====================================
        // View/Blade Errors
        // =====================================
        'view_not_found' => [
            'type' => 'View Not Found',
            'description' => 'The specified Blade view template does not exist.',
            'solutions' => [
                'Check if the view file exists in resources/views',
                'Verify the view name spelling and path',
                'Run php artisan view:clear to clear cached views',
            ],
        ],
        'undefined_view_variable' => [
            'type' => 'Undefined Variable in View',
            'description' => 'A variable used in the view was not passed from the controller.',
            'solutions' => [
                'Pass the variable from the controller: view(\'name\', compact(\'var\'))',
                'Check the variable name spelling',
                'Use optional() helper for nullable objects',
            ],
        ],
        'component_not_found' => [
            'type' => 'Component Not Found',
            'description' => 'The specified Blade component does not exist.',
            'solutions' => [
                'Check if the component class/view exists',
                'Verify the component name spelling',
                'Run php artisan view:clear',
            ],
        ],

        // =====================================
        // Class/Method Errors
        // =====================================
        'class_not_found' => [
            'type' => 'Class Not Found',
            'description' => 'PHP cannot find the specified class.',
            'solutions' => [
                'Run composer dump-autoload',
                'Check if the namespace is correct',
                'Verify the class file exists and is properly named',
                'Check composer.json autoload configuration',
            ],
        ],
        'interface_not_found' => [
            'type' => 'Interface Not Found',
            'description' => 'The specified interface does not exist.',
            'solutions' => [
                'Run composer dump-autoload',
                'Check the interface namespace',
                'Verify the interface file exists',
            ],
        ],
        'trait_not_found' => [
            'type' => 'Trait Not Found',
            'description' => 'The specified trait does not exist.',
            'solutions' => [
                'Run composer dump-autoload',
                'Check the trait namespace',
                'Verify the trait file exists',
            ],
        ],
        'undefined_method' => [
            'type' => 'Undefined Method',
            'description' => 'Calling a method that does not exist on the object.',
            'solutions' => [
                'Check if the method name is spelled correctly',
                'Verify you are calling the method on the correct object type',
                'Check if a trait or parent class provides the method',
            ],
        ],
        'undefined_function' => [
            'type' => 'Undefined Function',
            'description' => 'Calling a function that does not exist.',
            'solutions' => [
                'Check if the function name is spelled correctly',
                'Ensure required PHP extensions are installed',
                'Import the function if it\'s in a namespace',
            ],
        ],
        'null_method_call' => [
            'type' => 'Method Call on Null',
            'description' => 'Attempting to call a method on a null value.',
            'solutions' => [
                'Check if the object exists before calling methods',
                'Use optional() helper: optional($object)->method()',
                'Add null checks before method calls',
            ],
        ],
        'bool_method_call' => [
            'type' => 'Method Call on Boolean',
            'description' => 'Attempting to call a method on a boolean value.',
            'solutions' => [
                'Check what the variable actually contains',
                'A function might be returning false instead of an object',
                'Add proper error handling for failed operations',
            ],
        ],
        'array_method_call' => [
            'type' => 'Method Call on Array',
            'description' => 'Attempting to call a method on an array.',
            'solutions' => [
                'Convert array to collection: collect($array)->method()',
                'Check if you expected an object but got an array',
            ],
        ],
        'null_property_access' => [
            'type' => 'Property Access on Null',
            'description' => 'Attempting to access a property on a null value.',
            'solutions' => [
                'Check if the object exists before accessing properties',
                'Use optional() helper: optional($object)->property',
                'Use null coalescing: $object?->property',
            ],
        ],
        'non_object_property' => [
            'type' => 'Property Access on Non-Object',
            'description' => 'Attempting to access a property on a non-object value.',
            'solutions' => [
                'Verify the variable contains an object',
                'Check the data type before accessing properties',
            ],
        ],
        'missing_arguments' => [
            'type' => 'Missing Function Arguments',
            'description' => 'A function was called with fewer arguments than required.',
            'solutions' => [
                'Check the function signature for required parameters',
                'Provide all required arguments',
                'Add default values to optional parameters',
            ],
        ],
        'type_mismatch' => [
            'type' => 'Argument Type Mismatch',
            'description' => 'An argument of the wrong type was passed to a function.',
            'solutions' => [
                'Check the expected parameter types',
                'Cast the value to the correct type',
                'Validate input data before passing to functions',
            ],
        ],

        // =====================================
        // Route Errors
        // =====================================
        'route_not_found' => [
            'type' => 'Route Not Found',
            'description' => 'The named route does not exist.',
            'solutions' => [
                'Check if the route name is correct',
                'Run php artisan route:list to see all routes',
                'Run php artisan route:clear to clear cached routes',
                'Verify the route is registered in routes/web.php or routes/api.php',
            ],
        ],
        'method_not_allowed' => [
            'type' => 'HTTP Method Not Allowed',
            'description' => 'The HTTP method used is not allowed for this route.',
            'solutions' => [
                'Check if you\'re using GET instead of POST or vice versa',
                'Verify the form method matches the route definition',
                'Use @method directive for PUT, PATCH, DELETE in forms',
            ],
        ],
        'not_found_404' => [
            'type' => '404 Not Found',
            'description' => 'The requested URL was not found.',
            'solutions' => [
                'Check if the URL is correct',
                'Verify the route is defined',
                'Run php artisan route:clear',
                'Check for typos in the URL',
            ],
        ],
        'missing_route_parameter' => [
            'type' => 'Missing Route Parameter',
            'description' => 'A required route parameter was not provided.',
            'solutions' => [
                'Provide the required parameter: route(\'name\', [\'id\' => 1])',
                'Check the route definition for required parameters',
            ],
        ],
        'controller_method_not_found' => [
            'type' => 'Controller Method Not Found',
            'description' => 'The controller method specified in the route does not exist.',
            'solutions' => [
                'Create the missing method in the controller',
                'Check the method name spelling',
                'Verify the route points to the correct controller',
            ],
        ],

        // =====================================
        // Validation Errors
        // =====================================
        'validation' => [
            'type' => 'Validation Failed',
            'description' => 'Form validation failed.',
            'solutions' => [
                'Check validation rules in your controller or form request',
                'Display validation errors to the user',
                'Verify input field names match validation rules',
            ],
        ],
        'invalid_argument' => [
            'type' => 'Invalid Argument',
            'description' => 'An invalid argument was provided to a function.',
            'solutions' => [
                'Check the expected argument format',
                'Validate input before passing to functions',
            ],
        ],

        // =====================================
        // Memory/Timeout Errors
        // =====================================
        'memory_limit' => [
            'type' => 'Memory Limit Exceeded',
            'description' => 'The script exceeded the maximum allowed memory.',
            'solutions' => [
                'Increase memory_limit in php.ini',
                'Optimize queries to fetch less data',
                'Use chunking for large datasets: Model::chunk()',
                'Check for memory leaks in loops',
            ],
        ],
        'execution_timeout' => [
            'type' => 'Execution Timeout',
            'description' => 'The script took too long to execute.',
            'solutions' => [
                'Increase max_execution_time in php.ini',
                'Move long-running tasks to queues',
                'Optimize slow database queries',
                'Use pagination for large datasets',
            ],
        ],
        'recursion_limit' => [
            'type' => 'Recursion Limit Exceeded',
            'description' => 'The maximum function nesting level was exceeded.',
            'solutions' => [
                'Check for infinite recursion in your code',
                'Increase xdebug.max_nesting_level if using Xdebug',
                'Convert recursion to iteration where possible',
            ],
        ],

        // =====================================
        // Queue Errors
        // =====================================
        'queue_failed' => [
            'type' => 'Queue Job Failed',
            'description' => 'A queued job exceeded its maximum retry attempts.',
            'solutions' => [
                'Check the failed_jobs table for error details',
                'Increase the number of tries in the job class',
                'Fix the underlying error causing the job to fail',
                'Run php artisan queue:retry all to retry failed jobs',
            ],
        ],
        'queue_invalid_payload' => [
            'type' => 'Invalid Queue Payload',
            'description' => 'The queue job payload is invalid or corrupted.',
            'solutions' => [
                'Check if job data is serializable',
                'Avoid passing closures or resources to jobs',
                'Clear the queue and redispatch jobs',
            ],
        ],
        'queue_max_attempts' => [
            'type' => 'Queue Max Attempts Exceeded',
            'description' => 'The job has been attempted too many times.',
            'solutions' => [
                'Check failed_jobs table for the error',
                'Fix the underlying issue causing failures',
                'Increase $tries property in the job class',
            ],
        ],
        'queue_not_configured' => [
            'type' => 'Queue Not Configured',
            'description' => 'The specified queue connection is not configured.',
            'solutions' => [
                'Check QUEUE_CONNECTION in .env',
                'Verify queue configuration in config/queue.php',
                'Ensure the queue driver is properly set up',
            ],
        ],

        // =====================================
        // Cache & Session Errors
        // =====================================
        'cache_not_configured' => [
            'type' => 'Cache Store Not Configured',
            'description' => 'The specified cache driver is not configured.',
            'solutions' => [
                'Check CACHE_DRIVER in your .env file',
                'Verify cache configuration in config/cache.php',
                'Ensure Redis/Memcached is running if using those drivers',
            ],
        ],
        'session_not_configured' => [
            'type' => 'Session Not Configured',
            'description' => 'The session middleware is not applied to the route.',
            'solutions' => [
                'Add web middleware group to your routes',
                'Check middleware configuration in kernel.php',
                'Verify session driver in .env file',
            ],
        ],
        'lock_acquisition_failed' => [
            'type' => 'Lock Acquisition Failed',
            'description' => 'Unable to acquire a cache lock.',
            'solutions' => [
                'Wait and retry the operation',
                'Increase lock timeout',
                'Check cache driver configuration',
            ],
        ],

        // =====================================
        // Redis Errors
        // =====================================
        'redis_connection' => [
            'type' => 'Redis Connection Error',
            'description' => 'Unable to connect to the Redis server.',
            'solutions' => [
                'Check if Redis server is running',
                'Verify REDIS_HOST and REDIS_PORT in .env',
                'Check firewall settings',
            ],
        ],
        'redis_connection_refused' => [
            'type' => 'Redis Connection Refused',
            'description' => 'The Redis server refused the connection.',
            'solutions' => [
                'Start the Redis service',
                'Check Redis configuration',
                'Verify Redis is listening on the correct port',
            ],
        ],
        'redis_auth_required' => [
            'type' => 'Redis Authentication Required',
            'description' => 'Redis requires authentication but no password was provided.',
            'solutions' => [
                'Set REDIS_PASSWORD in .env',
                'Configure Redis password in config/database.php',
            ],
        ],
        'redis_max_clients' => [
            'type' => 'Redis Max Clients Reached',
            'description' => 'The maximum number of Redis clients has been reached.',
            'solutions' => [
                'Increase maxclients in Redis configuration',
                'Close unused connections',
                'Use connection pooling',
            ],
        ],

        // =====================================
        // HTTP/API Errors
        // =====================================
        'http_timeout' => [
            'type' => 'HTTP Request Timeout',
            'description' => 'The HTTP request timed out.',
            'solutions' => [
                'Increase request timeout',
                'Check if the remote server is responding',
                'Implement retry logic',
            ],
        ],
        'http_dns_failed' => [
            'type' => 'DNS Resolution Failed',
            'description' => 'Unable to resolve the hostname.',
            'solutions' => [
                'Check if the hostname is correct',
                'Verify DNS settings on your server',
                'Check network connectivity',
            ],
        ],
        'http_connection_refused' => [
            'type' => 'HTTP Connection Refused',
            'description' => 'The remote server refused the connection.',
            'solutions' => [
                'Check if the remote service is running',
                'Verify the URL and port are correct',
                'Check firewall settings',
            ],
        ],
        'http_ssl_error' => [
            'type' => 'SSL/TLS Error',
            'description' => 'An SSL/TLS error occurred during the request.',
            'solutions' => [
                'Update CA certificates',
                'Check SSL certificate validity',
                'Set verify option to false for testing (not production)',
            ],
        ],
        'http_ssl_certificate' => [
            'type' => 'SSL Certificate Error',
            'description' => 'The SSL certificate could not be verified.',
            'solutions' => [
                'Update CA certificates bundle',
                'Check the remote server\'s SSL certificate',
                'Use the latest version of curl',
            ],
        ],
        'http_connection_failed' => [
            'type' => 'HTTP Connection Failed',
            'description' => 'Unable to establish a connection to the remote server.',
            'solutions' => [
                'Check network connectivity',
                'Verify the URL is correct',
                'Check if a proxy is required',
            ],
        ],
        'http_request_failed' => [
            'type' => 'HTTP Request Failed',
            'description' => 'The HTTP request failed.',
            'solutions' => [
                'Check the response status code',
                'Verify request parameters',
                'Check the API documentation',
            ],
        ],
        'http_bad_request' => [
            'type' => 'HTTP 400 Bad Request',
            'description' => 'The server could not understand the request.',
            'solutions' => [
                'Check the request payload format',
                'Verify all required parameters are provided',
                'Check the API documentation',
            ],
        ],
        'http_unauthorized' => [
            'type' => 'HTTP 401 Unauthorized',
            'description' => 'Authentication is required or has failed.',
            'solutions' => [
                'Check API key or token',
                'Refresh expired tokens',
                'Verify authentication headers',
            ],
        ],
        'http_forbidden' => [
            'type' => 'HTTP 403 Forbidden',
            'description' => 'Access to the resource is forbidden.',
            'solutions' => [
                'Check if you have permission to access this resource',
                'Verify API permissions and scopes',
            ],
        ],
        'http_not_found' => [
            'type' => 'HTTP 404 Not Found',
            'description' => 'The requested resource was not found.',
            'solutions' => [
                'Check if the URL is correct',
                'Verify the resource exists',
            ],
        ],
        'http_unprocessable' => [
            'type' => 'HTTP 422 Unprocessable Entity',
            'description' => 'The request was well-formed but contained validation errors.',
            'solutions' => [
                'Check the validation error messages in the response',
                'Verify the request data meets all requirements',
            ],
        ],
        'http_rate_limited' => [
            'type' => 'HTTP 429 Rate Limited',
            'description' => 'Too many requests have been made to the API.',
            'solutions' => [
                'Implement request throttling',
                'Add delays between requests',
                'Cache responses where possible',
            ],
        ],
        'http_server_error' => [
            'type' => 'HTTP 500 Server Error',
            'description' => 'The remote server encountered an internal error.',
            'solutions' => [
                'The issue is on the remote server',
                'Retry the request later',
                'Contact the API provider if the issue persists',
            ],
        ],
        'http_bad_gateway' => [
            'type' => 'HTTP 502 Bad Gateway',
            'description' => 'The server received an invalid response from an upstream server.',
            'solutions' => [
                'Retry the request',
                'The upstream server may be down',
            ],
        ],
        'http_service_unavailable' => [
            'type' => 'HTTP 503 Service Unavailable',
            'description' => 'The server is temporarily unavailable.',
            'solutions' => [
                'Wait and retry the request',
                'Check if the service is under maintenance',
            ],
        ],
        'http_gateway_timeout' => [
            'type' => 'HTTP 504 Gateway Timeout',
            'description' => 'The upstream server did not respond in time.',
            'solutions' => [
                'Increase timeout settings',
                'Retry the request',
            ],
        ],

        // =====================================
        // JSON Errors
        // =====================================
        'invalid_json' => [
            'type' => 'Invalid JSON',
            'description' => 'The JSON data is malformed.',
            'solutions' => [
                'Validate the JSON structure',
                'Check for trailing commas or missing quotes',
                'Use a JSON validator tool',
            ],
        ],

        // =====================================
        // Encryption Errors
        // =====================================
        'decryption_failed' => [
            'type' => 'Decryption Failed',
            'description' => 'Unable to decrypt the data.',
            'solutions' => [
                'Check if APP_KEY has changed',
                'Verify the data was encrypted with the same key',
                'The data may have been corrupted',
            ],
        ],
        'encryption_failed' => [
            'type' => 'Encryption Failed',
            'description' => 'Unable to encrypt the data.',
            'solutions' => [
                'Check if APP_KEY is set',
                'Verify PHP OpenSSL extension is installed',
            ],
        ],
        'mac_invalid' => [
            'type' => 'Invalid MAC',
            'description' => 'The message authentication code is invalid.',
            'solutions' => [
                'The encrypted data was tampered with or corrupted',
                'Re-encrypt the data with the current key',
            ],
        ],
        'invalid_payload' => [
            'type' => 'Invalid Payload',
            'description' => 'The encrypted payload is invalid.',
            'solutions' => [
                'Re-encrypt the data',
                'Check if APP_KEY has changed',
            ],
        ],
        'missing_app_key' => [
            'type' => 'Missing Application Key',
            'description' => 'No application encryption key has been specified.',
            'solutions' => [
                'Run php artisan key:generate',
                'Set APP_KEY in your .env file',
            ],
        ],

        // =====================================
        // Container Errors
        // =====================================
        'binding_resolution' => [
            'type' => 'Binding Resolution Error',
            'description' => 'The container could not resolve a binding.',
            'solutions' => [
                'Check if the class or interface is bound in a service provider',
                'Verify all constructor dependencies can be resolved',
                'Run composer dump-autoload',
            ],
        ],
        'target_class_not_found' => [
            'type' => 'Target Class Not Found',
            'description' => 'The class the container is trying to instantiate does not exist.',
            'solutions' => [
                'Check the class name and namespace',
                'Run composer dump-autoload',
                'Verify the class file exists',
            ],
        ],
        'not_instantiable' => [
            'type' => 'Class Not Instantiable',
            'description' => 'The container cannot instantiate the class (abstract class or interface).',
            'solutions' => [
                'Bind the interface to a concrete implementation',
                'Create a service provider to register the binding',
            ],
        ],
        'container_recursion' => [
            'type' => 'Container Recursion Detected',
            'description' => 'A circular dependency was detected in the container.',
            'solutions' => [
                'Check for circular dependencies in your classes',
                'Use lazy loading or setter injection',
            ],
        ],

        // =====================================
        // Broadcast Errors
        // =====================================
        'broadcast_failed' => [
            'type' => 'Broadcast Failed',
            'description' => 'Failed to broadcast an event.',
            'solutions' => [
                'Check broadcast driver configuration',
                'Verify Pusher/Redis credentials',
                'Ensure broadcasting service is running',
            ],
        ],
        'pusher_error' => [
            'type' => 'Pusher Error',
            'description' => 'An error occurred with the Pusher service.',
            'solutions' => [
                'Verify PUSHER_* credentials in .env',
                'Check Pusher dashboard for issues',
                'Ensure cluster setting is correct',
            ],
        ],

        // =====================================
        // Listener/Event Errors
        // =====================================
        'listener_not_found' => [
            'type' => 'Listener Not Found',
            'description' => 'The event listener could not be found.',
            'solutions' => [
                'Check if the listener class exists',
                'Run composer dump-autoload',
                'Verify listener is registered in EventServiceProvider',
            ],
        ],

        // =====================================
        // Artisan Errors
        // =====================================
        'artisan_command_not_found' => [
            'type' => 'Artisan Command Not Found',
            'description' => 'The specified Artisan command does not exist.',
            'solutions' => [
                'Check the command name spelling',
                'Run php artisan list to see available commands',
                'Verify the command is registered',
            ],
        ],
        'artisan_command_not_defined' => [
            'type' => 'Artisan Command Not Defined',
            'description' => 'The command is not defined in the application.',
            'solutions' => [
                'Register the command in Kernel.php',
                'Check if the command class exists',
            ],
        ],

        // =====================================
        // PHP Type Errors
        // =====================================
        'type_error' => [
            'type' => 'Type Error',
            'description' => 'A value of the wrong type was passed to a function.',
            'solutions' => [
                'Check the expected parameter types',
                'Validate data types before passing to functions',
                'Use type casting if appropriate',
            ],
        ],
        'return_type_error' => [
            'type' => 'Return Type Error',
            'description' => 'A function returned a value of the wrong type.',
            'solutions' => [
                'Check what the function is returning',
                'Ensure the return type matches the declaration',
            ],
        ],

        // =====================================
        // PHP General Errors
        // =====================================
        'undefined_variable' => [
            'type' => 'Undefined Variable',
            'description' => 'Accessing a variable that has not been defined.',
            'solutions' => [
                'Initialize the variable before using it',
                'Check if the variable is passed to the view',
                'Use the null coalescing operator: $var ?? default',
            ],
        ],
        'undefined_array_key' => [
            'type' => 'Undefined Array Key',
            'description' => 'Accessing an array key that does not exist.',
            'solutions' => [
                'Check if the key exists using isset() or array_key_exists()',
                'Use the null coalescing operator: $array[\'key\'] ?? default',
                'Verify the data structure before accessing',
            ],
        ],
        'undefined_offset' => [
            'type' => 'Undefined Array Offset',
            'description' => 'Accessing an array index that does not exist.',
            'solutions' => [
                'Check array length before accessing index',
                'Use isset() to check if index exists',
            ],
        ],
        'undefined_property' => [
            'type' => 'Undefined Property',
            'description' => 'Accessing a property that does not exist on the object.',
            'solutions' => [
                'Check property name spelling',
                'Verify the property exists on the class',
                'Use isset() to check before accessing',
            ],
        ],
        'division_by_zero' => [
            'type' => 'Division by Zero',
            'description' => 'Attempting to divide by zero.',
            'solutions' => [
                'Check if the divisor is zero before dividing',
                'Add validation for zero values',
            ],
        ],
        'object_as_array' => [
            'type' => 'Object Used as Array',
            'description' => 'Attempting to use an object as an array.',
            'solutions' => [
                'Use object property access: $obj->property',
                'Convert object to array: (array) $obj',
                'Implement ArrayAccess interface on the class',
            ],
        ],
        'array_to_string' => [
            'type' => 'Array to String Conversion',
            'description' => 'Attempting to use an array in a string context.',
            'solutions' => [
                'Use implode() to join array elements',
                'Use json_encode() to convert to JSON string',
                'Access specific array elements',
            ],
        ],
        'object_to_string' => [
            'type' => 'Object to String Conversion',
            'description' => 'Attempting to convert an object to a string without __toString method.',
            'solutions' => [
                'Implement __toString() method on the class',
                'Access specific object properties',
                'Use json_encode() for objects',
            ],
        ],

        // =====================================
        // SSL/TLS Errors
        // =====================================
        'ssl_certificate_error' => [
            'type' => 'SSL Certificate Error',
            'description' => 'There is a problem with the SSL certificate.',
            'solutions' => [
                'Update CA certificates',
                'Check certificate expiration',
                'Verify certificate chain is complete',
            ],
        ],
        'ssl_connection_reset' => [
            'type' => 'SSL Connection Reset',
            'description' => 'The SSL connection was reset by the peer.',
            'solutions' => [
                'Check SSL/TLS version compatibility',
                'Verify cipher suite support',
                'Retry the connection',
            ],
        ],
        'ssl_verify_failed' => [
            'type' => 'SSL Verification Failed',
            'description' => 'The SSL certificate could not be verified.',
            'solutions' => [
                'Update CA certificates bundle',
                'Check the certificate is valid and trusted',
            ],
        ],

        // =====================================
        // Regex Errors
        // =====================================
        'regex_compilation_error' => [
            'type' => 'Regex Compilation Error',
            'description' => 'The regular expression pattern is invalid.',
            'solutions' => [
                'Check the regex syntax',
                'Escape special characters properly',
                'Test the pattern in a regex tester',
            ],
        ],
        'regex_modifier_error' => [
            'type' => 'Unknown Regex Modifier',
            'description' => 'The regex pattern contains an unknown modifier.',
            'solutions' => [
                'Check for unescaped special characters',
                'Verify the delimiter is not in the pattern',
                'Use a different delimiter if needed',
            ],
        ],

        // =====================================
        // Serialization Errors
        // =====================================
        'serialization_not_allowed' => [
            'type' => 'Serialization Not Allowed',
            'description' => 'The object cannot be serialized (e.g., closures, resources).',
            'solutions' => [
                'Remove non-serializable properties before serializing',
                'Use __sleep() to specify serializable properties',
                'Convert closures to serializable alternatives',
            ],
        ],
        'unserialize_error' => [
            'type' => 'Unserialize Error',
            'description' => 'The serialized data is corrupted or invalid.',
            'solutions' => [
                'Check if the data was serialized correctly',
                'Verify no data corruption during storage/transfer',
                'The serialized format may have changed',
            ],
        ],

        // =====================================
        // General Error
        // =====================================
        'general' => [
            'type' => 'General Error',
            'description' => 'An error occurred in the application.',
            'solutions' => [
                'Review the error message and stack trace',
                'Check the Laravel documentation',
                'Search for the error message online',
                'Review recent code changes',
            ],
        ],
    ],

];
