<!DOCTYPE html>
<html lang="{{ $currentLocale }}" dir="{{ $currentLocale === 'ar' ? 'rtl' : 'ltr' }}" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('log-viewer::log-viewer.title') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Orbitron:wght@400;500;600;700;800;900&family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        cyber: {
                            dark: '#0a0e17',
                            darker: '#060912',
                            card: '#0d1321',
                            border: '#1a2744',
                            cyan: '#00f0ff',
                            green: '#00ff9d',
                            pink: '#ff00ff',
                            orange: '#ff6b00',
                            red: '#ff3366',
                            yellow: '#ffd700',
                            purple: '#9d4edd',
                        }
                    },
                    fontFamily: {
                        mono: ['JetBrains Mono', 'monospace'],
                        cyber: ['Orbitron', 'sans-serif'],
                        arabic: ['Cairo', 'sans-serif'],
                    },
                    boxShadow: {
                        'cyber': '0 0 20px rgba(0, 240, 255, 0.3)',
                        'cyber-sm': '0 0 10px rgba(0, 240, 255, 0.2)',
                        'cyber-green': '0 0 20px rgba(0, 255, 157, 0.3)',
                        'cyber-red': '0 0 20px rgba(255, 51, 102, 0.3)',
                        'cyber-orange': '0 0 20px rgba(255, 107, 0, 0.3)',
                    },
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                        'scan': 'scan 2s linear infinite',
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes glow {
            from { text-shadow: 0 0 10px currentColor, 0 0 20px currentColor; }
            to { text-shadow: 0 0 20px currentColor, 0 0 30px currentColor, 0 0 40px currentColor; }
        }
        @keyframes scan {
            0% { background-position: 0 0; }
            100% { background-position: 0 100%; }
        }
        @keyframes borderGlow {
            0%, 100% { border-color: rgba(0, 240, 255, 0.5); }
            50% { border-color: rgba(0, 240, 255, 1); }
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #0a0e17; }
        ::-webkit-scrollbar-thumb { background: #1a2744; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #00f0ff; }

        .dark ::-webkit-scrollbar-track { background: #0a0e17; }
        .dark ::-webkit-scrollbar-thumb { background: #1a2744; }

        /* Light mode scrollbar */
        html:not(.dark) ::-webkit-scrollbar-track { background: #e5e7eb; }
        html:not(.dark) ::-webkit-scrollbar-thumb { background: #9ca3af; }
        html:not(.dark) ::-webkit-scrollbar-thumb:hover { background: #6366f1; }

        /* Cyber Grid Background */
        .cyber-grid {
            background-image:
                linear-gradient(rgba(0, 240, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 240, 255, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        .light-grid {
            background-image:
                linear-gradient(rgba(99, 102, 241, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(99, 102, 241, 0.05) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        /* Glowing Border Animation */
        .glow-border {
            animation: borderGlow 2s ease-in-out infinite;
        }

        /* Neon Text */
        .neon-text {
            text-shadow: 0 0 10px currentColor, 0 0 20px currentColor;
        }

        /* Corner Brackets */
        .cyber-corners {
            position: relative;
        }
        .cyber-corners::before,
        .cyber-corners::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            border: 2px solid;
        }
        .cyber-corners::before {
            top: -2px;
            left: -2px;
            border-right: none;
            border-bottom: none;
        }
        .cyber-corners::after {
            bottom: -2px;
            right: -2px;
            border-left: none;
            border-top: none;
        }
        .dark .cyber-corners::before,
        .dark .cyber-corners::after {
            border-color: #00f0ff;
        }
        html:not(.dark) .cyber-corners::before,
        html:not(.dark) .cyber-corners::after {
            border-color: #6366f1;
        }

        /* Status Indicator */
        .status-dot {
            animation: pulse 2s infinite;
        }

        /* Scan Line Effect */
        .scan-line::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 100%;
            background: linear-gradient(
                transparent 0%,
                rgba(0, 240, 255, 0.03) 50%,
                transparent 100%
            );
            background-size: 100% 10px;
            animation: scan 4s linear infinite;
            pointer-events: none;
        }

        /* RTL Support */
        [dir="rtl"] { font-family: 'Cairo', 'Segoe UI', Tahoma, Arial, sans-serif; }
        [dir="rtl"] * { font-family: inherit; }
        [dir="rtl"] .font-mono { font-family: 'Cairo', 'Segoe UI', Tahoma, Arial, sans-serif; }
        [dir="rtl"] .font-cyber { font-family: 'Cairo', 'Segoe UI', Tahoma, Arial, sans-serif; }
        [dir="rtl"] .rtl\:flex-row-reverse { flex-direction: row-reverse; }
        [dir="rtl"] .rtl\:text-right { text-align: right; }
        [dir="rtl"] .rtl\:space-x-reverse > :not([hidden]) ~ :not([hidden]) {
            --tw-space-x-reverse: 1;
        }
    </style>
</head>
<body class="font-mono transition-colors duration-300 dark:bg-cyber-darker dark:text-gray-100 bg-gray-100 text-gray-900">
    <div class="min-h-screen cyber-grid dark:cyber-grid light-grid relative">
        <!-- Scan Line Overlay (Dark Mode Only) -->
        <div class="dark:scan-line absolute inset-0 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 relative z-10">
            <!-- Header -->
            <header class="mb-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 rtl:flex-row-reverse">
                    <!-- Logo & Title -->
                    <div class="flex items-center gap-4">
                        <div class="relative">
                            <div class="w-12 h-12 rounded-lg dark:bg-cyber-card bg-white border-2 dark:border-cyber-cyan border-indigo-500 flex items-center justify-center shadow-cyber">
                                <svg class="w-7 h-7 dark:text-cyber-cyan text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <div class="absolute -top-1 -right-1 w-3 h-3 rounded-full dark:bg-cyber-green bg-green-500 status-dot"></div>
                        </div>
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-cyber font-bold tracking-wider dark:text-cyber-cyan text-indigo-600 neon-text">
                                {{ __('log-viewer::log-viewer.title') }}
                            </h1>
                            <p class="text-xs dark:text-gray-500 text-gray-500 font-mono tracking-widest uppercase mt-1">
                                // SYSTEM MONITOR v2.0
                            </p>
                        </div>
                    </div>

                    <!-- Header Actions -->
                    <div class="flex items-center gap-3 flex-wrap rtl:flex-row-reverse">
                        <!-- Theme Toggle -->
                        <button onclick="toggleTheme()" class="group relative p-3 rounded-lg dark:bg-cyber-card bg-white border dark:border-cyber-border border-gray-200 dark:hover:border-cyber-cyan hover:border-indigo-500 transition-all duration-300 dark:hover:shadow-cyber hover:shadow-lg">
                            <svg class="w-5 h-5 dark:hidden text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"/>
                            </svg>
                            <svg class="w-5 h-5 hidden dark:block text-cyber-cyan" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                            </svg>
                        </button>

                        <!-- Language Switcher -->
                        <form action="{{ route('log-viewer.set-locale') }}" method="POST" class="relative">
                            @csrf
                            <select name="locale" onchange="this.form.submit()" class="appearance-none px-4 py-2.5 pr-10 rounded-lg dark:bg-cyber-card bg-white border dark:border-cyber-border border-gray-200 dark:text-gray-100 text-gray-900 text-sm font-medium dark:focus:border-cyber-cyan focus:border-indigo-500 focus:ring-2 dark:focus:ring-cyber-cyan/20 focus:ring-indigo-500/20 outline-none transition-all cursor-pointer">
                                @foreach($availableLocales as $code => $name)
                                <option value="{{ $code }}" {{ $currentLocale === $code ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            <svg class="w-4 h-4 absolute right-3 top-1/2 -translate-y-1/2 dark:text-gray-400 text-gray-500 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </form>

                        @if(config('log-viewer.allow_download', true))
                        <a href="{{ route('log-viewer.download', ['file' => $selectedFile]) }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg dark:bg-cyber-card bg-white border dark:border-cyber-border border-gray-200 dark:text-cyber-cyan text-indigo-600 text-sm font-medium dark:hover:border-cyber-cyan hover:border-indigo-500 dark:hover:shadow-cyber hover:shadow-lg transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            {{ __('log-viewer::log-viewer.download') }}
                        </a>
                        @endif

                        @if(config('log-viewer.allow_clear', true))
                        <form action="{{ route('log-viewer.clear') }}" method="POST" class="inline" onsubmit="return confirm('{{ __('log-viewer::log-viewer.confirm_clear') }}')">
                            @csrf
                            <input type="hidden" name="file" value="{{ $selectedFile }}">
                            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg dark:bg-cyber-red/10 bg-red-50 border dark:border-cyber-red/50 border-red-200 dark:text-cyber-red text-red-600 text-sm font-medium dark:hover:bg-cyber-red/20 hover:bg-red-100 dark:hover:border-cyber-red hover:border-red-400 dark:hover:shadow-cyber-red hover:shadow-lg transition-all duration-300">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                {{ __('log-viewer::log-viewer.clear_log') }}
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </header>

            <!-- Alerts -->
            @if(session('success'))
            <div class="mb-6 p-4 rounded-lg dark:bg-cyber-green/10 bg-green-50 border dark:border-cyber-green/50 border-green-200 flex items-center gap-3">
                <div class="w-8 h-8 rounded-full dark:bg-cyber-green/20 bg-green-100 flex items-center justify-center">
                    <svg class="w-5 h-5 dark:text-cyber-green text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <span class="dark:text-cyber-green text-green-700 font-medium">{{ session('success') }}</span>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 p-4 rounded-lg dark:bg-cyber-red/10 bg-red-50 border dark:border-cyber-red/50 border-red-200 flex items-center gap-3">
                <div class="w-8 h-8 rounded-full dark:bg-cyber-red/20 bg-red-100 flex items-center justify-center">
                    <svg class="w-5 h-5 dark:text-cyber-red text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
                <span class="dark:text-cyber-red text-red-700 font-medium">{{ session('error') }}</span>
            </div>
            @endif

            <!-- Statistics Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <!-- Total Logs -->
                <div class="group relative dark:bg-cyber-card bg-white rounded-xl border dark:border-cyber-border border-gray-200 p-5 dark:hover:border-cyber-cyan hover:border-indigo-500 transition-all duration-300 dark:hover:shadow-cyber hover:shadow-lg overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full dark:bg-cyber-cyan bg-indigo-500"></div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-semibold uppercase tracking-wider dark:text-gray-500 text-gray-400">{{ __('log-viewer::log-viewer.total_logs') }}</span>
                        <div class="w-8 h-8 rounded-lg dark:bg-cyber-cyan/10 bg-indigo-50 flex items-center justify-center">
                            <svg class="w-4 h-4 dark:text-cyber-cyan text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-cyber font-bold dark:text-cyber-cyan text-indigo-600">{{ number_format($statistics['total']) }}</div>
                    <div class="mt-2 h-1 rounded-full dark:bg-cyber-border bg-gray-200 overflow-hidden">
                        <div class="h-full dark:bg-cyber-cyan bg-indigo-500 rounded-full" style="width: 100%"></div>
                    </div>
                </div>

                <!-- Errors -->
                <div class="group relative dark:bg-cyber-card bg-white rounded-xl border dark:border-cyber-border border-gray-200 p-5 dark:hover:border-cyber-red hover:border-red-500 transition-all duration-300 dark:hover:shadow-cyber-red hover:shadow-lg overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full dark:bg-cyber-red bg-red-500"></div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-semibold uppercase tracking-wider dark:text-gray-500 text-gray-400">{{ __('log-viewer::log-viewer.errors') }}</span>
                        <div class="w-8 h-8 rounded-lg dark:bg-cyber-red/10 bg-red-50 flex items-center justify-center">
                            <svg class="w-4 h-4 dark:text-cyber-red text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-cyber font-bold dark:text-cyber-red text-red-600">{{ number_format($statistics['by_level']['error'] ?? 0) }}</div>
                    <div class="mt-2 h-1 rounded-full dark:bg-cyber-border bg-gray-200 overflow-hidden">
                        @php $errorPercent = $statistics['total'] > 0 ? (($statistics['by_level']['error'] ?? 0) / $statistics['total']) * 100 : 0; @endphp
                        <div class="h-full dark:bg-cyber-red bg-red-500 rounded-full transition-all duration-500" style="width: {{ $errorPercent }}%"></div>
                    </div>
                </div>

                <!-- Warnings -->
                <div class="group relative dark:bg-cyber-card bg-white rounded-xl border dark:border-cyber-border border-gray-200 p-5 dark:hover:border-cyber-orange hover:border-orange-500 transition-all duration-300 dark:hover:shadow-cyber-orange hover:shadow-lg overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full dark:bg-cyber-orange bg-orange-500"></div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-semibold uppercase tracking-wider dark:text-gray-500 text-gray-400">{{ __('log-viewer::log-viewer.warnings') }}</span>
                        <div class="w-8 h-8 rounded-lg dark:bg-cyber-orange/10 bg-orange-50 flex items-center justify-center">
                            <svg class="w-4 h-4 dark:text-cyber-orange text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-cyber font-bold dark:text-cyber-orange text-orange-600">{{ number_format($statistics['by_level']['warning'] ?? 0) }}</div>
                    <div class="mt-2 h-1 rounded-full dark:bg-cyber-border bg-gray-200 overflow-hidden">
                        @php $warningPercent = $statistics['total'] > 0 ? (($statistics['by_level']['warning'] ?? 0) / $statistics['total']) * 100 : 0; @endphp
                        <div class="h-full dark:bg-cyber-orange bg-orange-500 rounded-full transition-all duration-500" style="width: {{ $warningPercent }}%"></div>
                    </div>
                </div>

                <!-- Info -->
                <div class="group relative dark:bg-cyber-card bg-white rounded-xl border dark:border-cyber-border border-gray-200 p-5 dark:hover:border-cyber-green hover:border-emerald-500 transition-all duration-300 dark:hover:shadow-cyber-green hover:shadow-lg overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full dark:bg-cyber-green bg-emerald-500"></div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-semibold uppercase tracking-wider dark:text-gray-500 text-gray-400">{{ __('log-viewer::log-viewer.info') }}</span>
                        <div class="w-8 h-8 rounded-lg dark:bg-cyber-green/10 bg-emerald-50 flex items-center justify-center">
                            <svg class="w-4 h-4 dark:text-cyber-green text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-cyber font-bold dark:text-cyber-green text-emerald-600">{{ number_format($statistics['by_level']['info'] ?? 0) }}</div>
                    <div class="mt-2 h-1 rounded-full dark:bg-cyber-border bg-gray-200 overflow-hidden">
                        @php $infoPercent = $statistics['total'] > 0 ? (($statistics['by_level']['info'] ?? 0) / $statistics['total']) * 100 : 0; @endphp
                        <div class="h-full dark:bg-cyber-green bg-emerald-500 rounded-full transition-all duration-500" style="width: {{ $infoPercent }}%"></div>
                    </div>
                </div>
            </div>

            <!-- Filters Panel -->
            <div class="dark:bg-cyber-card bg-white rounded-xl border dark:border-cyber-border border-gray-200 p-6 mb-8 dark:shadow-cyber-sm shadow-lg">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-8 h-8 rounded-lg dark:bg-cyber-purple/20 bg-purple-100 flex items-center justify-center">
                        <svg class="w-4 h-4 dark:text-cyber-purple text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-cyber font-semibold dark:text-gray-100 text-gray-900 tracking-wide">// FILTERS</h2>
                </div>

                <form method="GET" action="{{ route('log-viewer.index') }}">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4">
                        <!-- Log File -->
                        <div class="lg:col-span-1">
                            <label class="block text-xs font-semibold uppercase tracking-wider dark:text-gray-500 text-gray-400 mb-2">{{ __('log-viewer::log-viewer.log_file') }}</label>
                            <select name="file" onchange="this.form.submit()" class="w-full px-4 py-2.5 rounded-lg dark:bg-cyber-dark bg-gray-50 border dark:border-cyber-border border-gray-200 dark:text-gray-100 text-gray-900 text-sm dark:focus:border-cyber-cyan focus:border-indigo-500 focus:ring-2 dark:focus:ring-cyber-cyan/20 focus:ring-indigo-500/20 outline-none transition-all">
                                @foreach($logFiles as $file)
                                <option value="{{ $file['name'] }}" {{ $selectedFile === $file['name'] ? 'selected' : '' }}>{{ $file['name'] }} ({{ $file['size'] }})</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Level -->
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider dark:text-gray-500 text-gray-400 mb-2">{{ __('log-viewer::log-viewer.level') }}</label>
                            <select name="level" class="w-full px-4 py-2.5 rounded-lg dark:bg-cyber-dark bg-gray-50 border dark:border-cyber-border border-gray-200 dark:text-gray-100 text-gray-900 text-sm dark:focus:border-cyber-cyan focus:border-indigo-500 focus:ring-2 dark:focus:ring-cyber-cyan/20 focus:ring-indigo-500/20 outline-none transition-all">
                                <option value="">{{ __('log-viewer::log-viewer.all_levels') }}</option>
                                @foreach($logLevels as $level)
                                <option value="{{ $level }}" {{ ($filters['level'] ?? '') === $level ? 'selected' : '' }}>{{ __('log-viewer::log-viewer.levels.' . $level) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Search -->
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider dark:text-gray-500 text-gray-400 mb-2">{{ __('log-viewer::log-viewer.search') }}</label>
                            <div class="relative">
                                <input type="text" name="search" placeholder="{{ __('log-viewer::log-viewer.search_placeholder') }}" value="{{ $filters['search'] ?? '' }}" class="w-full px-4 py-2.5 pl-10 rounded-lg dark:bg-cyber-dark bg-gray-50 border dark:border-cyber-border border-gray-200 dark:text-gray-100 text-gray-900 text-sm dark:placeholder-gray-600 placeholder-gray-400 dark:focus:border-cyber-cyan focus:border-indigo-500 focus:ring-2 dark:focus:ring-cyber-cyan/20 focus:ring-indigo-500/20 outline-none transition-all">
                                <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 dark:text-gray-600 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                        </div>

                        <!-- From Date -->
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider dark:text-gray-500 text-gray-400 mb-2">{{ __('log-viewer::log-viewer.from_date') }}</label>
                            <input type="date" name="date_from" value="{{ $filters['date_from'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg dark:bg-cyber-dark bg-gray-50 border dark:border-cyber-border border-gray-200 dark:text-gray-100 text-gray-900 text-sm dark:focus:border-cyber-cyan focus:border-indigo-500 focus:ring-2 dark:focus:ring-cyber-cyan/20 focus:ring-indigo-500/20 outline-none transition-all dark:[color-scheme:dark]">
                        </div>

                        <!-- To Date -->
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider dark:text-gray-500 text-gray-400 mb-2">{{ __('log-viewer::log-viewer.to_date') }}</label>
                            <input type="date" name="date_to" value="{{ $filters['date_to'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg dark:bg-cyber-dark bg-gray-50 border dark:border-cyber-border border-gray-200 dark:text-gray-100 text-gray-900 text-sm dark:focus:border-cyber-cyan focus:border-indigo-500 focus:ring-2 dark:focus:ring-cyber-cyan/20 focus:ring-indigo-500/20 outline-none transition-all dark:[color-scheme:dark]">
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-end gap-2">
                            <button type="submit" class="flex-1 px-4 py-2.5 rounded-lg dark:bg-cyber-cyan/20 bg-indigo-600 border dark:border-cyber-cyan border-transparent dark:text-cyber-cyan text-white text-sm font-semibold dark:hover:bg-cyber-cyan/30 hover:bg-indigo-700 transition-all duration-300 dark:shadow-cyber-sm">
                                {{ __('log-viewer::log-viewer.filter') }}
                            </button>
                            <a href="{{ route('log-viewer.index', ['file' => $selectedFile]) }}" class="px-4 py-2.5 rounded-lg dark:bg-cyber-border bg-gray-200 dark:text-gray-400 text-gray-600 text-sm font-medium dark:hover:bg-gray-700 hover:bg-gray-300 transition-all duration-300">
                                {{ __('log-viewer::log-viewer.reset') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Log Entries Table -->
            <div class="dark:bg-cyber-card bg-white rounded-xl border dark:border-cyber-border border-gray-200 overflow-hidden dark:shadow-cyber-sm shadow-lg mb-8">
                <!-- Table Header -->
                <div class="px-6 py-4 border-b dark:border-cyber-border border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg dark:bg-cyber-cyan/20 bg-indigo-100 flex items-center justify-center">
                            <svg class="w-4 h-4 dark:text-cyber-cyan text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                            </svg>
                        </div>
                        <h2 class="text-lg font-cyber font-semibold dark:text-gray-100 text-gray-900 tracking-wide">// {{ __('log-viewer::log-viewer.log_entries') }}</h2>
                    </div>
                    <div class="flex items-center gap-2 text-sm">
                        <span class="px-3 py-1 rounded-full dark:bg-cyber-border bg-gray-100 dark:text-gray-400 text-gray-500 font-mono text-xs">
                            {{ $selectedFile }}
                        </span>
                    </div>
                </div>

                @if($logs->isEmpty())
                <!-- Empty State -->
                <div class="py-20 text-center">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-2xl dark:bg-cyber-border bg-gray-100 flex items-center justify-center">
                        <svg class="w-10 h-10 dark:text-gray-600 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-cyber font-semibold dark:text-gray-400 text-gray-500 mb-2">{{ __('log-viewer::log-viewer.no_entries') }}</h3>
                    <p class="dark:text-gray-600 text-gray-400 max-w-md mx-auto">{{ __('log-viewer::log-viewer.no_entries_hint') }}</p>
                </div>
                @else
                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="dark:bg-cyber-dark bg-gray-50 border-b dark:border-cyber-border border-gray-200">
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider dark:text-gray-500 text-gray-400">{{ __('log-viewer::log-viewer.level') }}</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider dark:text-gray-500 text-gray-400">{{ __('log-viewer::log-viewer.error_type') }}</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider dark:text-gray-500 text-gray-400">{{ __('log-viewer::log-viewer.message') }}</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider dark:text-gray-500 text-gray-400">{{ __('log-viewer::log-viewer.time') }}</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider dark:text-gray-500 text-gray-400">{{ __('log-viewer::log-viewer.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y dark:divide-cyber-border divide-gray-100">
                            @foreach($logs as $log)
                            <tr class="dark:hover:bg-cyber-dark/50 hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4">
                                    @php
                                        $levelColors = [
                                            'error' => 'dark:bg-cyber-red/20 bg-red-100 dark:text-cyber-red text-red-700 dark:border-cyber-red/50 border-red-200',
                                            'critical' => 'dark:bg-cyber-red/20 bg-red-100 dark:text-cyber-red text-red-700 dark:border-cyber-red/50 border-red-200',
                                            'alert' => 'dark:bg-cyber-red/20 bg-red-100 dark:text-cyber-red text-red-700 dark:border-cyber-red/50 border-red-200',
                                            'emergency' => 'dark:bg-cyber-red/20 bg-red-100 dark:text-cyber-red text-red-700 dark:border-cyber-red/50 border-red-200',
                                            'warning' => 'dark:bg-cyber-orange/20 bg-orange-100 dark:text-cyber-orange text-orange-700 dark:border-cyber-orange/50 border-orange-200',
                                            'notice' => 'dark:bg-cyber-yellow/20 bg-yellow-100 dark:text-cyber-yellow text-yellow-700 dark:border-cyber-yellow/50 border-yellow-200',
                                            'info' => 'dark:bg-cyber-green/20 bg-emerald-100 dark:text-cyber-green text-emerald-700 dark:border-cyber-green/50 border-emerald-200',
                                            'debug' => 'dark:bg-gray-700/50 bg-gray-100 dark:text-gray-400 text-gray-600 dark:border-gray-600 border-gray-200',
                                        ];
                                        $levelColor = $levelColors[$log['level']] ?? $levelColors['debug'];
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold uppercase tracking-wider border {{ $levelColor }}">
                                        {{ __('log-viewer::log-viewer.levels.' . $log['level']) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm dark:text-gray-400 text-gray-500 font-mono">{{ $log['error_type'] }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="max-w-md truncate text-sm dark:text-gray-300 text-gray-700 font-mono" title="{{ $log['message'] }}">
                                        {{ Str::limit($log['message'], 80) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm dark:text-gray-500 text-gray-400 font-mono whitespace-nowrap">{{ $log['datetime']->format('M d, Y H:i:s') }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <button onclick="showLogDetail({{ json_encode($log) }})" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg dark:bg-cyber-cyan/10 bg-indigo-50 border dark:border-cyber-cyan/30 border-indigo-200 dark:text-cyber-cyan text-indigo-600 text-xs font-medium dark:hover:bg-cyber-cyan/20 hover:bg-indigo-100 dark:hover:border-cyber-cyan hover:border-indigo-400 transition-all duration-300">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        {{ __('log-viewer::log-viewer.view_details') }}
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($pagination['last_page'] > 1)
                <div class="px-6 py-4 border-t dark:border-cyber-border border-gray-200 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <p class="text-sm dark:text-gray-500 text-gray-400">
                        {{ __('log-viewer::log-viewer.showing', ['from' => $pagination['from'], 'to' => $pagination['to'], 'total' => $pagination['total']]) }}
                    </p>
                    <div class="flex items-center gap-1">
                        @if($pagination['current_page'] > 1)
                        <a href="{{ request()->fullUrlWithQuery(['page' => $pagination['current_page'] - 1]) }}" class="px-3 py-2 rounded-lg dark:bg-cyber-dark bg-gray-100 dark:text-gray-400 text-gray-600 text-sm font-medium dark:hover:bg-cyber-border hover:bg-gray-200 dark:hover:text-cyber-cyan hover:text-indigo-600 transition-all">
                            {{ $currentLocale === 'ar' ? '→' : '←' }} {{ __('log-viewer::log-viewer.previous') }}
                        </a>
                        @else
                        <span class="px-3 py-2 rounded-lg dark:bg-cyber-dark/50 bg-gray-50 dark:text-gray-600 text-gray-400 text-sm font-medium cursor-not-allowed">
                            {{ $currentLocale === 'ar' ? '→' : '←' }} {{ __('log-viewer::log-viewer.previous') }}
                        </span>
                        @endif

                        @for($i = max(1, $pagination['current_page'] - 2); $i <= min($pagination['last_page'], $pagination['current_page'] + 2); $i++)
                        <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-all {{ $i === $pagination['current_page'] ? 'dark:bg-cyber-cyan/20 bg-indigo-100 dark:text-cyber-cyan text-indigo-600 dark:border-cyber-cyan border-indigo-500 border' : 'dark:text-gray-400 text-gray-600 dark:hover:bg-cyber-dark hover:bg-gray-100' }}">
                            {{ $i }}
                        </a>
                        @endfor

                        @if($pagination['current_page'] < $pagination['last_page'])
                        <a href="{{ request()->fullUrlWithQuery(['page' => $pagination['current_page'] + 1]) }}" class="px-3 py-2 rounded-lg dark:bg-cyber-dark bg-gray-100 dark:text-gray-400 text-gray-600 text-sm font-medium dark:hover:bg-cyber-border hover:bg-gray-200 dark:hover:text-cyber-cyan hover:text-indigo-600 transition-all">
                            {{ __('log-viewer::log-viewer.next') }} {{ $currentLocale === 'ar' ? '←' : '→' }}
                        </a>
                        @else
                        <span class="px-3 py-2 rounded-lg dark:bg-cyber-dark/50 bg-gray-50 dark:text-gray-600 text-gray-400 text-sm font-medium cursor-not-allowed">
                            {{ __('log-viewer::log-viewer.next') }} {{ $currentLocale === 'ar' ? '←' : '→' }}
                        </span>
                        @endif
                    </div>
                </div>
                @endif
                @endif
            </div>

            <!-- Top Error Types -->
            @if(!empty($statistics['by_type']) && $statistics['by_type']->isNotEmpty())
            <div class="dark:bg-cyber-card bg-white rounded-xl border dark:border-cyber-border border-gray-200 overflow-hidden dark:shadow-cyber-sm shadow-lg">
                <div class="px-6 py-4 border-b dark:border-cyber-border border-gray-200">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg dark:bg-cyber-red/20 bg-red-100 flex items-center justify-center">
                            <svg class="w-4 h-4 dark:text-cyber-red text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <h2 class="text-lg font-cyber font-semibold dark:text-gray-100 text-gray-900 tracking-wide">// {{ __('log-viewer::log-viewer.top_errors') }}</h2>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="dark:bg-cyber-dark bg-gray-50 border-b dark:border-cyber-border border-gray-200">
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider dark:text-gray-500 text-gray-400">{{ __('log-viewer::log-viewer.error_type') }}</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider dark:text-gray-500 text-gray-400">{{ __('log-viewer::log-viewer.count') }}</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider dark:text-gray-500 text-gray-400">FREQUENCY</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y dark:divide-cyber-border divide-gray-100">
                            @foreach($statistics['by_type'] as $type => $count)
                            <tr class="dark:hover:bg-cyber-dark/50 hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4">
                                    <span class="text-sm dark:text-gray-300 text-gray-700 font-mono">{{ $type }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold dark:bg-cyber-red/20 bg-red-100 dark:text-cyber-red text-red-700 border dark:border-cyber-red/50 border-red-200">
                                        {{ number_format($count) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 w-64">
                                    @php $typePercent = $statistics['total'] > 0 ? ($count / $statistics['total']) * 100 : 0; @endphp
                                    <div class="flex items-center gap-3">
                                        <div class="flex-1 h-2 rounded-full dark:bg-cyber-border bg-gray-200 overflow-hidden">
                                            <div class="h-full dark:bg-cyber-red bg-red-500 rounded-full transition-all duration-500" style="width: {{ $typePercent }}%"></div>
                                        </div>
                                        <span class="text-xs dark:text-gray-500 text-gray-400 font-mono w-12 text-right">{{ number_format($typePercent, 1) }}%</span>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            <!-- Footer -->
            <footer class="mt-8 pb-6 text-center">
                <p class="text-xs dark:text-gray-600 text-gray-400 font-mono tracking-wider">
                    // SYSTEM_MONITOR :: SECURED_CONNECTION :: v2.0
                </p>
            </footer>
        </div>
    </div>

    <!-- Log Detail Modal -->
    <div id="logModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 dark:bg-black/80 bg-black/50 backdrop-blur-sm" onclick="closeModal()"></div>
        <div class="absolute inset-4 sm:inset-8 lg:inset-16 flex items-center justify-center">
            <div class="relative w-full max-w-4xl max-h-full dark:bg-cyber-card bg-white rounded-2xl border dark:border-cyber-border border-gray-200 overflow-hidden dark:shadow-cyber shadow-2xl flex flex-col">
                <!-- Modal Header -->
                <div class="px-6 py-4 border-b dark:border-cyber-border border-gray-200 flex justify-between items-center flex-shrink-0">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg dark:bg-cyber-cyan/20 bg-indigo-100 flex items-center justify-center">
                            <svg class="w-4 h-4 dark:text-cyber-cyan text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-cyber font-semibold dark:text-gray-100 text-gray-900 tracking-wide">// {{ __('log-viewer::log-viewer.log_details') }}</h3>
                    </div>
                    <button onclick="closeModal()" class="w-8 h-8 rounded-lg dark:bg-cyber-dark bg-gray-100 dark:hover:bg-cyber-red/20 hover:bg-red-100 dark:text-gray-400 text-gray-500 dark:hover:text-cyber-red hover:text-red-600 flex items-center justify-center transition-all">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <div id="modalContent" class="p-6 overflow-y-auto flex-1">
                    <!-- Content injected by JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // Theme Management
        function toggleTheme() {
            const html = document.documentElement;
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        }

        // Load saved theme
        (function() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'light') {
                document.documentElement.classList.remove('dark');
            } else {
                document.documentElement.classList.add('dark');
            }
        })();

        // Translation strings for JavaScript
        const translations = {
            suggested_solutions: "{{ __('log-viewer::log-viewer.suggested_solutions') }}",
            stack_trace: "{{ __('log-viewer::log-viewer.stack_trace') }}",
            error_info: "{{ __('log-viewer::log-viewer.error_info') }}",
            level: "{{ __('log-viewer::log-viewer.level') }}",
            type: "{{ __('log-viewer::log-viewer.type') }}",
            time: "{{ __('log-viewer::log-viewer.time') }}",
            environment: "{{ __('log-viewer::log-viewer.environment') }}",
            description: "{{ __('log-viewer::log-viewer.description') }}",
            error_message: "{{ __('log-viewer::log-viewer.error_message') }}"
        };

        // Level colors mapping
        const levelColors = {
            error: 'dark:bg-cyber-red/20 bg-red-100 dark:text-cyber-red text-red-700 dark:border-cyber-red/50 border-red-200',
            critical: 'dark:bg-cyber-red/20 bg-red-100 dark:text-cyber-red text-red-700 dark:border-cyber-red/50 border-red-200',
            alert: 'dark:bg-cyber-red/20 bg-red-100 dark:text-cyber-red text-red-700 dark:border-cyber-red/50 border-red-200',
            emergency: 'dark:bg-cyber-red/20 bg-red-100 dark:text-cyber-red text-red-700 dark:border-cyber-red/50 border-red-200',
            warning: 'dark:bg-cyber-orange/20 bg-orange-100 dark:text-cyber-orange text-orange-700 dark:border-cyber-orange/50 border-orange-200',
            notice: 'dark:bg-cyber-yellow/20 bg-yellow-100 dark:text-cyber-yellow text-yellow-700 dark:border-cyber-yellow/50 border-yellow-200',
            info: 'dark:bg-cyber-green/20 bg-emerald-100 dark:text-cyber-green text-emerald-700 dark:border-cyber-green/50 border-emerald-200',
            debug: 'dark:bg-gray-700/50 bg-gray-100 dark:text-gray-400 text-gray-600 dark:border-gray-600 border-gray-200',
        };

        function showLogDetail(log) {
            const modal = document.getElementById('logModal');
            const content = document.getElementById('modalContent');
            const levelColor = levelColors[log.level] || levelColors.debug;

            let solutionsHtml = '';
            if (log.solutions && log.solutions.length > 0) {
                solutionsHtml = `
                    <div class="mb-6">
                        <h4 class="text-xs font-semibold uppercase tracking-wider dark:text-gray-500 text-gray-400 mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4 dark:text-cyber-green text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                            ${translations.suggested_solutions}
                        </h4>
                        <div class="space-y-2">
                            ${log.solutions.map(solution => `
                                <div class="flex items-start gap-3 p-3 rounded-lg dark:bg-cyber-green/10 bg-emerald-50 border dark:border-cyber-green/30 border-emerald-200">
                                    <div class="w-5 h-5 rounded-full dark:bg-cyber-green bg-emerald-500 flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <span class="dark:text-cyber-green text-emerald-700 text-sm">${escapeHtml(solution)}</span>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                `;
            }

            let stackTraceHtml = '';
            if (log.stack_trace) {
                stackTraceHtml = `
                    <div>
                        <h4 class="text-xs font-semibold uppercase tracking-wider dark:text-gray-500 text-gray-400 mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4 dark:text-cyber-purple text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>
                            </svg>
                            ${translations.stack_trace}
                        </h4>
                        <div class="p-4 rounded-lg dark:bg-cyber-dark bg-gray-50 border dark:border-cyber-border border-gray-200 font-mono text-xs dark:text-gray-300 text-gray-700 whitespace-pre-wrap break-words max-h-64 overflow-y-auto">${escapeHtml(log.stack_trace)}</div>
                    </div>
                `;
            }

            content.innerHTML = `
                <!-- Error Info Grid -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <div class="p-4 rounded-lg dark:bg-cyber-dark bg-gray-50 border dark:border-cyber-border border-gray-200">
                        <div class="text-xs font-semibold uppercase tracking-wider dark:text-gray-500 text-gray-400 mb-2">${translations.level}</div>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold uppercase tracking-wider border ${levelColor}">
                            ${escapeHtml(log.level)}
                        </span>
                    </div>
                    <div class="p-4 rounded-lg dark:bg-cyber-dark bg-gray-50 border dark:border-cyber-border border-gray-200">
                        <div class="text-xs font-semibold uppercase tracking-wider dark:text-gray-500 text-gray-400 mb-2">${translations.type}</div>
                        <span class="dark:text-gray-300 text-gray-700 text-sm font-mono">${escapeHtml(log.error_type)}</span>
                    </div>
                    <div class="p-4 rounded-lg dark:bg-cyber-dark bg-gray-50 border dark:border-cyber-border border-gray-200">
                        <div class="text-xs font-semibold uppercase tracking-wider dark:text-gray-500 text-gray-400 mb-2">${translations.time}</div>
                        <span class="dark:text-gray-300 text-gray-700 text-sm font-mono">${escapeHtml(log.datetime)}</span>
                    </div>
                    <div class="p-4 rounded-lg dark:bg-cyber-dark bg-gray-50 border dark:border-cyber-border border-gray-200">
                        <div class="text-xs font-semibold uppercase tracking-wider dark:text-gray-500 text-gray-400 mb-2">${translations.environment}</div>
                        <span class="dark:text-gray-300 text-gray-700 text-sm font-mono">${escapeHtml(log.environment)}</span>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <h4 class="text-xs font-semibold uppercase tracking-wider dark:text-gray-500 text-gray-400 mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4 dark:text-cyber-cyan text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        ${translations.description}
                    </h4>
                    <div class="p-4 rounded-lg dark:bg-cyber-dark bg-gray-50 border dark:border-cyber-border border-gray-200 dark:text-gray-300 text-gray-700 text-sm">${escapeHtml(log.description)}</div>
                </div>

                ${solutionsHtml}

                <!-- Error Message -->
                <div class="mb-6">
                    <h4 class="text-xs font-semibold uppercase tracking-wider dark:text-gray-500 text-gray-400 mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4 dark:text-cyber-red text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        ${translations.error_message}
                    </h4>
                    <div class="p-4 rounded-lg dark:bg-cyber-red/10 bg-red-50 border dark:border-cyber-red/30 border-red-200 font-mono text-xs dark:text-cyber-red text-red-700 whitespace-pre-wrap break-words max-h-48 overflow-y-auto">${escapeHtml(log.message)}</div>
                </div>

                ${stackTraceHtml}
            `;

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('logModal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        function escapeHtml(text) {
            if (!text) return '';
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        // Close modal on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModal();
        });
    </script>
</body>
</html>
