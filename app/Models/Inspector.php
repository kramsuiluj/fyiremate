<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inspector extends Model
{
    use HasFactory, SoftDeletes;

    public function fullname()
    {
        return $this->firstname . ' ' . $this->middlename[0] . '. ' . $this->lastname;
    }
}
