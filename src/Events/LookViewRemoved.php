<?php

namespace Package\Kennofizet\Lookview\Events;

use Package\Kennofizet\Lookview\Model\LookView;
use Package\Kennofizet\Lookview\Model\LookViewUserToken;
use Package\Kennofizet\Lookview\Model\LookViewByUser;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;

class LookViewAddedRemoved
{
    use SerializesModels;

    /** @var LookView|Model **/
    public $model;

    /** @var json */
    public $user;

    /**
     * Create a new event instance.
     *
     * @param Taggable|Model $model
     * @param string $user
     */
    public function __construct($model, $user)
    {
        $this->model = $model;
        $this->user = $user;
    }
}
