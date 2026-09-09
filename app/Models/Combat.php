<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Combat extends Model
{
  //
  protected $fillable = ['fighter_1', 'fighter_2', 'winner'];


  public function fighter1()
  {
    return $this->belongsTo(Monster::class, 'fighter_1');
  }

  public function fighter2()
  {
    return $this->belongsTo(Monster::class, 'fighter_2');
  }

  public function winnerMonster()
  {
    return $this->belongsTo(Monster::class, 'winner');
  }
}
