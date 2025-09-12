<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

  {{-- Styles --}}
  @include('includes.styles')
  @stack('addon-styles')

</head>
<body class="bg-white text-black min-h-screen flex flex-col">

  <!-- Header -->
  @include('includes.header')

  <!-- Content: Centered -->
  <main class="flex-1 flex items-center justify-center">
    @if(session('success'))
        <div id="toast"
            class="fixed top-4 left-1/2 -translate-x-1/2 p-3 bg-gray-100 text-sm rounded-lg border border-gray-200 shadow 
                opacity-0 -translate-y-4 transition-all duration-500 ease-out flex items-center gap-2">

            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" 
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293A1 1 0 006.293 10.707l2 2a1 1 0 001.414 0l4-4z" 
                    clip-rule="evenodd" />
            </svg>

            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if ($errors->has('all'))
        <div id="toast"
            class="fixed top-4 left-1/2 -translate-x-1/2 p-3 bg-gray-100 text-sm rounded-lg border border-gray-200 shadow 
                opacity-0 -translate-y-4 transition-all duration-500 ease-out flex items-center gap-2">
                
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 0a12 12 0 1012 12A12.014 12.014 0 0012 0zm.75 17.25h-1.5v-1.5h1.5zm0-3h-1.5v-6h1.5z"/>
            </svg>

            <span>{{ $errors->first('all') }}</span>
        </div>
    @elseif ($errors->any())
        <div id="toast"
            class="fixed top-4 left-1/2 -translate-x-1/2 p-3 bg-gray-100 text-sm rounded-lg border border-gray-200 shadow 
                opacity-0 -translate-y-4 transition-all duration-500 ease-out flex items-center gap-2">
                
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 0a12 12 0 1012 12A12.014 12.014 0 0012 0zm.75 17.25h-1.5v-1.5h1.5zm0-3h-1.5v-6h1.5z"/>
            </svg>

            <span>{{ $errors->first() }}</span>
        </div>
    @endif
    @yield('main-content')
  </main>

  <!-- Footer -->
  @include('includes.footer')

  {{-- Scripts --}}
  @include('includes.script')
  @stack('addon-script')

</body>
</html>