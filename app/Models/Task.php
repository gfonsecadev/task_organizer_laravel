<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable=['user_id','name_task','date_limit_task','description_task'];

    use HasFactory;
}
