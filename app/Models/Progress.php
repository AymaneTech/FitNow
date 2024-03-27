<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $fillable = [
        "height",
        "weight",
        "performance",
        "measurements",
        "user_id",
        "status"
    ];

    public function ScopeUserProgress()
    {
        return $this->where("user_id", auth("sanctum")->id())->get();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
