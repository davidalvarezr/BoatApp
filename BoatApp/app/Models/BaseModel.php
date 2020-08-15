<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

abstract class BaseModel extends Model
{
    public function __construct()
    {
        if (App::environment() === 'testing') {
            $this->setConnection(env('TEST_DB_CONNECTION_NAME', null));
        }
        parent::__construct();
    }

}

