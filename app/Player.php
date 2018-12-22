<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name','team_id'
  ];


  /* RELATIONSHIPS */


  /**
   * Get the player of the PlayerInfo
   */
  public function playerInfo()
  {
      return $this->hasOne('App\PlayerInfo');
  }

  /**
   * Get the team of the Player
   */
  public function team()
  {
      return $this->belongsTo('App\Team','team_id');
  }


  /**
  * Get results of the Player
  */
  public function results()
    {
        return $this->belongsToMany('App\Result',"players_results")
            ->withPivot("gol", "red_cards", "yellow_cards");
    }

}
