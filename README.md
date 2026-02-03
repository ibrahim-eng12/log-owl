# Laravel Log Viewer

A Laravel package to view, navigate, and filter application logs with intelligent error descriptions and suggested solutions.

## Features

- 📋 View and navigate Laravel log files
- 🔍 Filter logs by level, date range, and search terms
- 📊 Statistics dashboard showing error counts by level and type
- 💡 Intelligent error analysis with descriptions and solutions
- 🌍 Multi-language support (English & Arabic)
- 🔄 RTL (Right-to-Left) layout support for Arabic
- 🎨 Clean, responsive UI
- 🔐 Protected with authentication middleware
- 📥 Download and clear log files
- 📱 Mobile-friendly interface

## Installation

### 1. Install via Composer

```bash
composer require ibrahim-eng12/laravel-log-viewer
```

Or add to your `composer.json`:

```json
{
    "repositories": [
        {
            "type": "path",
            "url": "./packages/laravel-log-viewer"
        }
    ],
    "require": {
        "yourvendor/laravel-log-viewer": "*"
    }
}
```

### 2. Publish Configuration (Optional)

```bash
php artisan vendor:publish --tag=log-viewer-config
```

### 3. Publish Views (Optional)

```bash
php artisan vendor:publish --tag=log-viewer-views
```

### 4. Publish Translations (Optional)

```bash
php artisan vendor:publish --tag=log-viewer-lang
```

## Configuration

After publishing the configuration, you can modify `config/log-viewer.php`:

```php
return [
    // URL prefix for log viewer routes
    'route_prefix' => 'logs',

    // Middleware applied to all routes
    'middleware' => ['web', 'auth'],

    // Path to log files
    'log_path' => storage_path('logs'),

    // Logs per page
    'per_page' => 25,

    // Restrict to specific users (empty = all authenticated)
    'allowed_users' => [],

    // Allow clearing log files
    'allow_clear' => true,

    // Allow downloading log files
    'allow_download' => true,

    // Default locale (null = use app locale)
    'locale' => null,

    // Available locales for the language switcher
    'available_locales' => [
        'en' => 'English',
        'ar' => 'Arabic',
    ],
];
```

## Usage

After installation, navigate to `/logs` in your browser (while authenticated) to access the log viewer.

### Routes

| Route | Method | Description |
|-------|--------|-------------|
| `/logs` | GET | View logs dashboard |
| `/logs/show/{id}` | GET | Get log entry details (JSON) |
| `/logs/clear` | POST | Clear current log file |
| `/logs/download` | GET | Download current log file |
| `/logs/set-locale` | POST | Change language (stored in session) |

### Filtering Logs

- **By Level**: Filter by emergency, alert, critical, error, warning, notice, info, debug
- **By Search**: Search within log messages and error types
- **By Date**: Filter by date range

## Supported Error Types

The package recognizes and provides solutions for common Laravel errors:

- **Database Errors**: Connection issues, missing tables/columns, duplicates
- **Authentication Errors**: Unauthenticated access, CSRF mismatches
- **File Errors**: Permission denied, file not found
- **View Errors**: Missing Blade templates
- **Class/Method Errors**: Class not found, undefined methods
- **Route Errors**: Route not defined, method not allowed, 404
- **Memory/Timeout Errors**: Memory exhausted, execution timeout
- **Queue Errors**: Failed jobs, max attempts exceeded
- **Cache/Session Errors**: Store not configured
- **Mail Errors**: Transport failures
- And many more...

## Multi-Language Support

The package supports multiple languages with a built-in language switcher. Currently supported languages:

- **English** (en) - Default
- **Arabic** (ar) - With full RTL support

### Changing the Default Language

Set the default locale in your configuration:

```php
'locale' => 'ar', // Set Arabic as default
```

Or leave it as `null` to use your application's current locale.

### Adding a New Language

1. Publish the translation files:

```bash
php artisan vendor:publish --tag=log-viewer-lang
```

2. Copy one of the existing language files (e.g., `en/log-viewer.php`) to a new folder with your language code (e.g., `fr/log-viewer.php`)

3. Translate all strings in the new file

4. Add the new locale to your configuration:

```php
'available_locales' => [
    'en' => 'English',
    'ar' => 'Arabic',
    'fr' => 'French',
],
```

### RTL Support

The interface automatically switches to RTL (Right-to-Left) layout when Arabic is selected. The RTL detection is based on the current locale.

## Customization

### Adding Custom Error Patterns

Extend the `LogParser` service to add custom error patterns:

```php
use Ibrah\LaravelLogViewer\Services\LogParser;

class CustomLogParser extends LogParser
{
    protected array $errorPatterns = [
        // Add your custom patterns (pattern => translation_key)
        'MyCustomException' => 'my_custom_error',
        // ... parent patterns will be inherited
    ];
}
```

Then add the translation key to your language files:

```php
// resources/lang/vendor/log-viewer/en/log-viewer.php
'error_types' => [
    'my_custom_error' => [
        'type' => 'Custom Error',
        'description' => 'Description of the error.',
        'solutions' => [
            'Solution 1',
            'Solution 2',
        ],
    ],
    // ... other error types
],
```

Register in a service provider:

```php
$this->app->singleton(LogParser::class, CustomLogParser::class);
```

### Custom Views

Publish and modify the views:

```bash
php artisan vendor:publish --tag=log-viewer-views
```

Views will be published to `resources/views/vendor/log-viewer/`.

## Security

- All routes are protected by the `auth` middleware by default
- Configure `allowed_users` to restrict access to specific users
- Disable `allow_clear` and `allow_download` in production if needed

## Requirements

- PHP 8.1+
- Laravel 10.0, 11.0, or 12.0

## License

MIT License
