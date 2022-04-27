<?php

namespace Package\Kennofizet\Lookview\Model;

use Illuminate\Database\Eloquent\Model;

class LookViewUserToken extends Model
{
    protected $table = "look_view_user_token";

    public $timestamps = true;
    protected $fillable = ['secret_id', 'secret_token', 'user_id'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->connection = config('look_view.connection');
    }
}
