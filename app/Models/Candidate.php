<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'profile_image'
    ];


    public function elections() {
        return $this->hasMany(ElectionCandidate::class, 'candidate_id');
    }

    public function scopeElection() {
        return $this->elections()->first()->election;
    }

    public function scopeVotes($query, $election_id = 1) {
        return $this->elections()
            ->where('election_id', $election_id)
            ->first()
            ->election
            ->candidateVotes($this->id)
            ->count();
    }
}
