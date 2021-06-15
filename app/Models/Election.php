<?php

namespace App\Models;

use App\Domains\Auth\Models\User;
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

    public function candidates() {
        return $this->belongsToMany(Candidate::class, 'election_has_candidates');
    }

    public function scopeHasVoted() {
        return $this->voters->where('has_elected', 1)->count();
    }

    public function scopeYetVoted() {
        return $this->voters->where('has_elected', 0)->count();
    }

    public function scopeAvailableCandidates() {
        $candidates = $this->candidates->pluck('id')->toArray();
        return Candidate::whereNotIn('id', $candidates)->get();
    }

    public function scopeAvailableVoters() {
        $voters = $this->voters->pluck('user_id')->toArray();
        return User::whereNotIn('id', $voters)->get();
    }
}
