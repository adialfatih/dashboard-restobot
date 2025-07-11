<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'login/halaman_utama';
$route['dashboard'] = 'beranda';
$route['today'] = 'beranda/today';
$route['selesai'] = 'beranda/selesai';
//$route['manager-dashboard'] = 'beranda/dsbmng';
$route['operator-dashboard'] = 'beranda/dsbopt';
$route['404_override'] = 'Notfounde';
$route['translate_uri_dashes'] = FALSE;
$route['upload-image'] = 'Upload_image';
$route['store-image'] = 'Upload_image/produk_upload';
$route['daftar'] = 'beranda/daftar';
/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/

$route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8
