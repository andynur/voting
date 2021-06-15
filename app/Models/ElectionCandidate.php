<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionCandidate extends Model
{
    use HasFactory;
    protected $fillable = [
        'number',
        'election_id',
        'candidate_id'
    ];
    protected $table = 'election_has_candidates';

    public function election() {
        return $this->belongsTo(Election::class, 'election_id');
    }

    public function candidate() {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }
}
