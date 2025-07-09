<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Ini adalah route untuk web. Di bawah ini kita arahkan "/" ke "/admin"
| agar saat buka root domain langsung masuk ke halaman login/admin panel.
|
*/

Route::redirect('/', '/admin');