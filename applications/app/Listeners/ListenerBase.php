<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\Level;

class ListenerBase
{
    /**
     * The Level instance.
     *
     * @var App\Services\Level
     */
    protected $level;

    /**
     * Create the event listener.
     *
     * @param App\Services\Level $level
     * @return void
     */
    public function __construct(Level $level)
    {
      $this->level = $level;
    }
}
