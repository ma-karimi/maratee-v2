<?php

Route::view('dashboard', 'admin.dashboard');

Route::resource('manager', 'ManagerController');
Route::resource('category', 'CategoryController');
