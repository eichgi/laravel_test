<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'tournament_id','number','type'
  ];

  /* RELATIONSHIPS */

  /**
   * Get the tournament of the Set
   */
  public function tournament()
  {
      return $this->belongsTo('App\Tournament','tournament_id');
  }

  /**
   * Get all matches of the Set
   */
  public function matches()
  {
    return $this->hasMany('App\Match');
  }
}
