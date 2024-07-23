<?php

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Maatwebsite\Excel\ExcelServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    ExcelServiceProvider::class,
    CloudinaryLabs\CloudinaryLaravel\CloudinaryServiceProvider::class,

];
