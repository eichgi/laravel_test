<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
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
   * Get  teams of the Tournament
   */
  public function teams()
  {
    return $this->belongsToMany('App\Team','tournament_team');
  }


  /**
   * Get  sets of the Tournament
   */
  public function sets()
  {
    return $this->hasMany('App\Set');
  }


  /**
   * Get  matches of the Tournament
   */
  public function matches()
  {
    return $this->hasMany('App\Match');
  }



}
