<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date'
    ];

    protected $dates = ['start_date', 'end_date'];

    public function voters() {
        return $this->hasMany(Voter::class, 'election_id', 'id');
    }

    public function scopeHasVoted() {
        return $this->voters->where('has_elected', 1)->count();
    }

    public function scopeYetVoted() {
        return $this->voters->where('has_elected', 0)->count();
    }
}
