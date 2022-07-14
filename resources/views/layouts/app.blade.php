<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Books Store</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="https://kit.fontawesome.com/195c2f0acd.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    </head>
    <body class="bg-gray-400 w-screen overflow-x-hidden">
        <nav class="py-5 px-10 bg-slate-800 flex justify-between mb-6 fixed top-0 w-screen z-30">
            <div class="w-14 object-cover">
                <a href="/">
                    <img src="{{ URL('/images/logo.png') }}" alt="">
                </a>
            </div>
            <ul class="flex items-center">
                <li>
                    <a href="/nova" target="_blank" class="bg-emerald-600 text-white p-3 rounded-lg text-lg hover:bg-emerald-700 transition-colors">Dashboard</a>
                </li>
            </ul>
        </nav>

        <form action="{{ URL('/search') }}" method="GET" class="flex justify-evenly items-center mb-6 mt-32 flex-wrap gap-5 mobile:flex-col-reverse">
            <div class="flex items-center gap-4">
                <select name="genre" id="genre" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block h-16 px-4">
                    <option value="">Select a genre</option>
                    @foreach ($genres as $genre)
                        <option value={{ $genre->title }}>{{ $genre->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center">
                <input type="text" name="query" placeholder="Search here ..." onfocus="this.placeholder=''" onblur="this.placeholder='Search here ...'" class="h-16 px-4 w-64 rounded-l-lg outline-blue-400 focus:outline-0" autocomplete="off" value="{{ isset($query) ? $query : ''}}">
                <button type="submit" class="bg-blue-500 text-white h-16 px-4 rounded-r-lg hover:bg-blue-600 transition-colors">Search</button>
            </div>
        </form>

        <div class="flex justify-center flex-col items-center min-h-screen">
            @yield('content')
        </div>

        <footer class="text-center bg-slate-800 text-white p-6 mt-10">
            <div class="flex justify-evenly items-center gap-4 flex-wrap">
                <ul class="flex flex-col gap-3">
                    <li><i class="fa fa-envelope mr-3"></i><span>test@gmail.com</span></li>
                    <li><i class="fa fa-phone mr-3"></i><span>+963 111 222 333</span></li>
                </ul>
                <ul class="flex flex-col gap-3">
                    <li><i class="fa fa-location mr-3"></i><span>Test road, City, Country.</span></li>
                </ul>
            </div>
            <h1 class="border-t mt-4 pt-4">book store 2022 &copy;</h1>
        </footer>

        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
          AOS.init();
        </script>

        <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        
        <script src="{{ asset('js/like.js') }}"></script>
        <script src="{{ asset('js/dislike.js') }}"></script>
    </body>
</html>