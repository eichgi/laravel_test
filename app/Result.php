<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'match_id','team_a_goals','team_b_goals'
  ];

  /* RELATIONSHIPS */


  /**
   * Get the match of the Result
   */
  public function match()
  {
      return $this->belongsTo('App\Match','match_id');
  }

  /**
  * Get players of the Result
  */
  public function players()
    {
        return $this->belongsToMany('App\Player',"players_results")
            ->withPivot("gol", "red_cards", "yellow_cards");
    }
}
