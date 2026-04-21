<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AI Sales Generator') }} - {{ $title ?? 'Welcome' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .geometric-pattern {
            background-color: #f0f4ff;
            position: relative;
            overflow: hidden;
        }
        
        .geometric-pattern::before,
        .geometric-pattern::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
        }
        
        .shape {
            position: absolute;
            pointer-events: none;
            opacity: 0.15;
        }
        
        @keyframes float1 {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        
        @keyframes float2 {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(20px) rotate(-5deg); }
        }
        
        @keyframes float3 {
            0%, 100% { transform: translateX(0) rotate(0deg); }
            50% { transform: translateX(-15px) rotate(8deg); }
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 0.1; transform: scale(1); }
            50% { opacity: 0.2; transform: scale(1.05); }
        }
        
        .float-1 { animation: float1 8s ease-in-out infinite; }
        .float-2 { animation: float2 10s ease-in-out infinite; }
        .float-3 { animation: float3 7s ease-in-out infinite; }
        .pulse { animation: pulse 6s ease-in-out infinite; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased geometric-pattern">
    <div class="fixed inset-0 overflow-hidden pointer-events-none" style="z-index: 0;">
        <div class="shape float-1" style="top: 5%; left: 5%;">
            <div class="w-32 h-32 bg-indigo-400 rounded-lg rotate-12"></div>
        </div>
        
        <div class="shape float-2" style="top: 60%; right: 8%;">
            <div class="w-24 h-24 bg-purple-400 rounded-md rotate-45"></div>
        </div>
        
        <div class="shape float-3" style="bottom: 15%; left: 15%;">
            <div class="w-20 h-20 bg-blue-400 rounded border-2 border-indigo-300"></div>
        </div>
        
        <div class="shape pulse" style="top: 20%; right: 15%;">
            <div class="w-40 h-40 bg-pink-400 rounded-full"></div>
        </div>
        
        <div class="shape float-2" style="bottom: 30%; right: 25%;">
            <div class="w-16 h-16 bg-orange-400 rounded-full"></div>
        </div>
        
        <div class="shape float-1" style="top: 45%; left: 20%;">
            <div class="w-12 h-12 bg-yellow-400 rounded-full"></div>
        </div>
        
        <div class="shape float-3" style="top: 70%; left: 5%;">
            <div style="width: 0; height: 0; border-left: 40px solid transparent; border-right: 40px solid transparent; border-bottom: 70px solid #34d399; opacity: 0.6;"></div>
        </div>
        
        <div class="shape float-2" style="top: 15%; left: 25%;">
            <div style="width: 0; height: 0; border-left: 30px solid transparent; border-right: 30px solid transparent; border-bottom: 52px solid #60a5fa; opacity: 0.5;"></div>
        </div>
        
        <div class="shape float-1" style="bottom: 20%; right: 18%;">
            <div style="width: 0; height: 0; border-left: 35px solid transparent; border-right: 35px solid transparent; border-bottom: 60px solid #a78bfa; opacity: 0.5;"></div>
        </div>
        
        <div class="shape pulse" style="top: 50%; right: 5%;">
            <div class="w-48 h-16 bg-emerald-400 rounded-lg rotate-12"></div>
        </div>
        
        <div class="shape float-1" style="top: 85%; right: 35%;">
            <div class="w-20 h-20 bg-rose-400 transform rotate-45 skew-x-12 skew-y-12" style="clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);"></div>
        </div>
        
        <div class="shape float-3" style="top: 10%; left: 60%;">
            <div class="w-24 h-24 bg-indigo-500" style="clip-path: polygon(25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%, 0% 50%); opacity: 0.4;"></div>
        </div>
        
        <div class="shape float-2" style="bottom: 45%; left: 8%;">
            <div class="w-12 h-12 bg-amber-400" style="clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%); opacity: 0.5;"></div>
        </div>
        
        <div class="shape float-1" style="top: 30%; left: 45%;">
            <div class="w-28 h-28 bg-cyan-400" style="clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%); opacity: 0.3;"></div>
        </div>
    </div>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative">
        <div class="absolute inset-0 bg-white/40 backdrop-blur-[1px] pointer-events-none"></div>
        
        <div class="mb-6 relative z-10">
            <a href="{{ route('landing') }}">
                <div class="flex items-center gap-2">
                    <div class="w-12 h-12 gradient-bg rounded-xl flex items-center justify-center shadow-lg">
                        <span class="text-white text-xl font-bold">AI</span>
                    </div>
                    <span class="font-bold text-2xl text-gray-800">Sales<span class="gradient-text">Generator</span></span>
                </div>
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white/90 backdrop-blur-sm shadow-xl overflow-hidden sm:rounded-lg relative z-10 border border-white/20">
            {{ $slot }}
        </div>
        
        <div class="text-center text-gray-600 text-sm mt-8 relative z-10">
            &copy; {{ date('Y') }} AI Sales Generator. All rights reserved.
        </div>
    </div>
</body>
</html>