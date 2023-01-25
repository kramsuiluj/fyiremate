<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Establishment extends Model
{
    use HasFactory, SoftDeletes;

    protected $with = ['payments'];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->where(fn($query) =>
                $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('owner', 'like', '%' . $search . '%')
                ->orWhere('fsic', 'like', '%' . $search . '%')
            )
        );

        $query->when($filters['from'] ?? false, fn($query, $from) =>
            $query->when($filters['to'] ?? false, fn ($query, $to) =>
                $query->whereBetween('date', [$from, $to])
            )
        );
    }
}
