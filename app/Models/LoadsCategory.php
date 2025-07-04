<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoadsCategory extends Model
{
    use HasFactory;
    protected $table = 'loads_category';
    protected $primaryKey = 'load_category_id';
    protected $fillable = ['load_name'];
}
