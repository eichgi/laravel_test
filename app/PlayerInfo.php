<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerInfo extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'alias','player_id','number'
  ];

  /* RELATIONSHIPS */


  /**
   * Get the player of the PlayerInfo
   */
  public function player()
  {
      return $this->belongsTo('App\Player','player_id');
  }
}
