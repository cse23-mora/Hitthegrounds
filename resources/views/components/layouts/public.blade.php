<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-base-100 text-base-content font-['Poppins'] antialiased overflow-x-hidden">
    <!-- Navigation Header -->
    <x-Navbar />

    <!-- Main Content -->
    <main class="min-h-screen">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-FooterSection />
    @livewireScripts
</body>

</html>
