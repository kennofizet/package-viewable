<?php

namespace Package\Kennofizet\Lookview\Model;

use Illuminate\Database\Eloquent\Model;

class LookViewByUser extends Model
{
    protected $table = "look_view_by_user";
    public $timestamps = true;
    protected $fillable = ['total_view', 'time_view', 'time_current', 'chart_check', 'model', 'model_id', 'user_id', 'time_show'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->connection = config('look_view.connection');
    }
}
