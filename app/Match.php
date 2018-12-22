<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'team_b_id','team_a_id','tournament_id','set_id'
    ];


    /* RELATIONSHIPS */


    /**
     * Get the teamA of the Match
     */
    public function teamA()
    {
        return $this->belongsTo('App\Team','team_a_id');
    }


    /**
     * Get the teamB of the Match
     */
    public function teamB()
    {
        return $this->belongsTo('App\Team','team_b_id');
    }

    /**
     * Get the Tournament of the Match
     */
    public function tournament()
    {
        return $this->belongsTo('App\Tournament','tournament_id');
    }

    /**
     * Get the Set of the Match
     */
    public function set()
    {
        return $this->belongsTo('App\Set','set_id');
    }


    /**
     * Get the Result of the Match
     */
    public function result()
    {
        return $this->hasOne('App\Result');
    }
}
