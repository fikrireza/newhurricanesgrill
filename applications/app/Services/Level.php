<?php

namespace App\Services;

class Level
{
  /**
   * Set login user level
   *
   * @param Illuminate\Auth\Events\Login $login
   * @return void
   */
  public function setLoginLevel($login)
  {
    session()->put('level', $login->user->level);
  }

  /**
   * Set visitor user level
   * 5 is for visitor level
   * @return void
   */
  public function setVisitorLevel()
  {
    session()->put('level', 7);
  }

  /**
   * Set Level
   *
   * @return void
   */
  public function setLevel()
  {
    if(!session()->has('level'))
    {
      session()->put('level', auth()->check() ? auth()->user()->level : 7);
    }
  }
}
