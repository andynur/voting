<?php

namespace App\Models;

use App\Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{
    use HasFactory;
    protected $fillable = [
        'election_id',
        'user_id',
        'has_elected',
        'selected_date'
    ];

    protected $dates = ['selected_date'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function election() {
        return $this->belongsTo(Election::class, 'election_id');
    }

    public function scopeVote() {
        return ElectionVote::where('election_id', $this->election_id)->where('user_id', $this->user_id)->first();
    }
}
