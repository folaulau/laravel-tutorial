<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ArticleService extends ServiceProvider
{

    function __construct() {
    }

    public function validate(){
        echo "validate from service";
    }
}
