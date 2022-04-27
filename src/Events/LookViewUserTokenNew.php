<?php

namespace Package\Kennofizet\Lookview\Events;

use Package\Kennofizet\Lookview\Model\LookView;
use Package\Kennofizet\Lookview\Model\LookViewUserToken;
use Package\Kennofizet\Lookview\Model\LookViewByUser;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;

class LookViewUserTokenNew
{
    use SerializesModels;

    /** @var User|Model **/
    public $user;

    /** @var json */
    public $secret_id;

    /** @var json */
    public $secret_token;

    /**
     * Create a new event instance.
     *
     * @param Taggable|Model $model
     * @param string $user
     */
    public function __construct($user,string $secret_id ,string $secret_token)
    {
        $this->user = $user;
        $this->secret_id = $secret_id;
        $this->secret_token = $secret_token;
    }
}
