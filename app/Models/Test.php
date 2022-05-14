<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    const COLUMN_ID = 'id';
    const COLUMN_NAME = 'name';
    const COLUMN_DESCRIPTION = 'description';

    protected $guarded = [self::COLUMN_ID];
}
