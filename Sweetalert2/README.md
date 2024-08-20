Usando Sweetalert2 em aplicativos com Laravel 11

Aqui estão três maneiras de instalar o SweetAlert2 no seu projeto Laravel. Vamos dar uma olhada em cada exemplo, um por um.

Example 1: Laravel Add Sweetalert2 using CDN
We can use CDN to get SweetAlert2. Just add this script tag in the head section of your HTML file. This way, you don't need to download anything. Here is an example of the simple Blade file code.

resources/views/welcome.blade.php

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div id="app">
        <main class="container">
            <h1> How To Install Sweetalert2 in Laravel? - ItSolutionstuiff.com</h1>
            <button class="btn btn-success">Click Me!</button>
        </main>
    </div>
</body>
<script>
  $('button').click(function(){
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        }
      });
  });
</script>
</html>

Example 2: Laravel Vite Add Sweetalert2 using NPM

Here, we will add Sweetalert2 using an npm command. So, let's run this command:

npm install jquery
npm install sweetalert2

Next, we need to add jQuery to our app.js. So, let's put the following lines in your app.js file.

resources/js/app.js
import jQuery from 'jquery';
window.$ = jQuery;
  
import swal from 'sweetalert2';
window.Swal = swal;

Next, we need to add $ in your vite config file. so, let's add it.

vite.config.js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
  
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '$': 'jQuery'
        },
    },
});

Next, create the npm JS and CSS files with this command:

npm run dev

Now, we are ready to use jQuery with Vite. You can see the simple Blade file code below.

resources/views/welcome.blade.php

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <title>{{ config('app.name', 'Laravel') }}</title>
  
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
  
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  
    <script type="module">
  
        $('button').click(function(){
              Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.isConfirmed) {
                  Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                  )
                }
              });
        });
  
    </script>
  
</head>
<body>
    <div id="app">
  
        <main class="container">
            <h1> How To Install Sweetalert2 in Laravel? - ItSolutionstuiff.com</h1>
              
            <button class="btn btn-success">Click Me</button>
        </main>
    </div>
  
</body>
</html>

Run Laravel App:

All the required steps have been done, now you have to type the given below command and hit enter to run the Laravel app:

php artisan serve

Now, Go to your web browser, type the given URL and view the app output:

http://localhost:8000/

Output:
I hope it can help you…
https://www.itsolutionstuff.com/post/how-to-install-sweetalert2-in-laravel-11-viteexample.html


