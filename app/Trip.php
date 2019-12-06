<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Jenssegers\Mongodb\Eloquent\Model as MongoElocuent;

class Trip extends MongoElocuent
{
    protected $connection = "mongodb";

    protected $guarded = [];
}
