<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name'
  ];


  /* RELATIONSHIPS */

  /**
   * Get the players of the Team
   */
  public function players()
  {
    return $this->hasMany('App\Player');
  }

  /**
   * Get the tournaments of the Team
   */
  public function tournaments()
  {
    return $this->belongsToMany('App\Tournament', 'tournament_team');
  }


  /**
   * Get matches of the Team as team A
   */
  public function matchesAsA()
  {
    return $this->hasMany('App\Match','team_a_id');
  }


  /**
   * Get matches of the Team as team B
   */
  public function matchesAsB()
  {
    return $this->hasMany('App\Match','team_b_id');
  }



}
