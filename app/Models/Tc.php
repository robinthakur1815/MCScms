<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tc extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'from_class', 'resion', 'behaviour','from_session', 'meta'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function fc()
    {
        return $this->belongsTo(MyClass::class, 'from_class');
    }
}
