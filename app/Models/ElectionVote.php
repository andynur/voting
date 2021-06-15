<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionVote extends Model
{
    use HasFactory;
    protected $fillable = [
        'election_id',
        'candidate_id',
        'voter_id'
    ];
}
