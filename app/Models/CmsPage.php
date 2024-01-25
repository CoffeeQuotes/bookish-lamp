<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsPage extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        "description",
        "url",
        "meta_title",
        "meta_description",
        "meta_keywords",
        "status"
    ];
}
