<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="./logo1.png" type="image/x-icon">
    <title>Rahman Corporation</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Vite Assets -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries">
    </script>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Flowbite CDN -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.5/dist/flowbite.min.css" rel="stylesheet">

    <!-- Flowbite React CDN -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite-react@1.6.5/dist/flowbite-react.min.js"></script>

   
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#F3F3F3]">


        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-2xl shadow-slate-800 z-50 overflow-hidden sm:rounded-lg">
            <div class="flex justify-center items-center">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>
            <div>
                <div class="lg:w-[65%] md:w-[30%] w-[80%] text-gray-400 pt-5 pb-5 mx-auto font-bold">
                    <p>------------Welcome Back-----------</p>
                </div>
            </div>

            {{ $slot }}
        </div>
    </div>
</body>

</html>