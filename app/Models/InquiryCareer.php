<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryCareer extends Model
{
    use HasFactory;

    protected $table = 'inquiry_careers';

    protected $fillable = [
        'full_name',
        'email',
        'position',
        'message',
        'resume_file'
    ];
}
