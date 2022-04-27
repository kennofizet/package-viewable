<?php

namespace Package\Kennofizet\Lookview\Traits;

use Package\Kennofizet\Lookview\Events\LookViewUserTokenNew;
use Package\Kennofizet\Lookview\Events\LookViewAdded;
use Package\Kennofizet\Lookview\Events\LookViewRemoved;
// use Package\Kennofizet\Lookview\Events\LookViewUserAdded;
// use Package\Kennofizet\Lookview\Events\LookViewUserRemoved;
// use Package\Kennofizet\Lookview\Events\LookViewUserTokenRemoved;
use Package\Kennofizet\Lookview\Model\LookView;
use Package\Kennofizet\Lookview\Model\LookViewByUser;
use Package\Kennofizet\Lookview\Model\LookViewUserToken;
use Package\Kennofizet\Lookview\Utility;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;


trait LookViewAble
{
    public function viewd_data_all()
    {
        $name_model = (string)get_class($this);
        $post_viewd = $this->hasMany(Utility::lookViewModelString(), 'model_id', 'id')
        ->orderBy('id','DESC')
        ->where('model',$name_model)
        ->get();

        $data_view = [];

        for ($i=0; $i < count($post_viewd); $i++) { 
            $data_view[$i] = $post_viewd[$i]->total_view;
        }
        return json_decode(json_encode($data_view));
    }

    public function viewd_data($time = "all")
    {
        if ($time == "all" or $time == "a") {
            $name_model = (string)get_class($this);
            $post_viewd = $this->hasMany(Utility::lookViewModelString(), 'model_id', 'id')
            ->orderBy('id','DESC')
            ->where('model',$name_model)
            ->where('time_current',1)
            ->get();

            $data_view = [];

            for ($i=0; $i < count($post_viewd); $i++) { 
                $data_view[$i] = $post_viewd[$i]->total_view;
            }
            return json_decode(json_encode($data_view));
        }else{
            if ($time == "hour" or $time == "h") {
                $time_int = 1;
            }else if ($time == "day" or $time == "d") {
                $time_int = 2;
            }else if ($time == "month" or $time == "m") {
                $time_int = 3;
            }else if ($time == "year" or $time == "y") {
                $time_int = 4;
            }else{
                $time_int = 5;
            }
            $name_model = (string)get_class($this);
            $post_viewd = $this->hasMany(Utility::lookViewModelString(), 'model_id', 'id')
            ->orderBy('id','DESC')
            ->where('model',$name_model)
            ->where('time_current',1)
            ->where('time_view',$time_int)
            ->first();

            return json_decode($post_viewd->total_view);
        }
    }

    public function viewd_hour($time='')
    {
        $model_id = $this->id;
        $time_view = 1;
        $name_model = (string)get_class($this);
        if ($time) {

        }else{
            $time = Carbon::now()->format('H d m Y');
        }
        $time_parse = Carbon::createFromFormat('H d m Y',$time);
        $data_try = $this
        ->belongsTo(Utility::lookViewModelString(), 'id', 'model_id')
        ->where('model',$name_model)
        ->where('time_view',$time_view)
        ->where('time_show',(string)$time_parse->format('d m Y'))
        ->first();

        $try_get_time = 0;

        // dd($time);

        if (!empty($data_try)) {
            foreach (json_decode($data_try->total_view) as $key => $value) {
                if ($key == $time) {
                    $try_get_time = $value;
                }
            }
        }

        return $try_get_time;
    }


    public function viewd_day($time='')
    {
        $model_id = $this->id;
        $time_view = 2;
        $name_model = (string)get_class($this);
        if ($time) {

        }else{
            $time = Carbon::now()->format('d m Y');
        }
        $time_parse = Carbon::createFromFormat('d m Y',$time);
        $data_try = $this
        ->belongsTo(Utility::lookViewModelString(), 'id', 'model_id')
        ->where('model',$name_model)
        ->where('time_view',$time_view)
        ->where('time_show',(string)$time_parse->format('m Y'))
        ->first();

        $try_get_time = 0;

        if (!empty($data_try)) {
            foreach (json_decode($data_try->total_view) as $key => $value) {
                if ($key == $time) {
                    $try_get_time = $value;
                }
            }
        }

        return $try_get_time;
    }

    public function viewd_month($time='')
    {
        $model_id = $this->id;
        $time_view = 3;
        $name_model = (string)get_class($this);
        if ($time) {

        }else{
            $time = Carbon::now()->format('m Y');
        }
        $time_parse = Carbon::createFromFormat('m Y',$time);
        $data_try = $this
        ->belongsTo(Utility::lookViewModelString(), 'id', 'model_id')
        ->where('model',$name_model)
        ->where('time_view',$time_view)
        ->where('time_show',(string)$time_parse->format('Y'))
        ->first();


        $try_get_time = 0;

        if (!empty($data_try)) {
            foreach (json_decode($data_try->total_view) as $key => $value) {
                if ($key == $time) {

                    $try_get_time = $value;
                }
            }
        }

        return $try_get_time;
    }

    public function viewd_year($time='')
    {
        $model_id = $this->id;
        $time_view = 4;
        $name_model = (string)get_class($this);
        if ($time) {

        }else{
            $time = Carbon::now()->format('Y');
        }
        $time_parse = Carbon::createFromFormat('Y',$time);
        $data_try = $this
        ->belongsTo(Utility::lookViewModelString(), 'id', 'model_id')
        ->where('model',$name_model)
        ->where('time_view',$time_view)
        ->first();

        $try_get_time = 0;

        if (!empty($data_try)) {
            foreach (json_decode($data_try->total_view) as $key => $value) {
                if ($key == $time) {
                    $try_get_time = $value;
                }
            }
        }

        return $try_get_time;
    }

    public function viewd_total()
    {
        $model_id = $this->id;
        $time_view = 5;
        $name_model = (string)get_class($this);

        $data_try = $this
        ->belongsTo(Utility::lookViewModelString(), 'id', 'model_id')
        ->where('model',$name_model)
        ->where('time_view',$time_view)
        ->first();

        if (!empty($data_try)) {
            $try_get_time = (int)$data_try->total_view;
        }else{
            $try_get_time = 0;
        }

        return $try_get_time;
    }



    public function viewd($check_time_value = '')
    {
        $this->addSingleLookView($check_time_value);
        return;
    }

    public function addSingleLookView($check_time_value)
    {
        $current = Carbon::now();
        $name_model = (string)get_class($this);
        $model_id = $this->id;

        if ($this->checkTimeoutLookView($check_time_value,$current,$name_model,1,1,$model_id)) {
            // time_view 1 = hour
            // time_view 2 = day
            // time_view 3 = month
            // time_view 4 = year
            // time_view 5 = total
            // time_current 1 = current
            $this->hourLookView($current,$name_model,1,1,$model_id);
            $this->dayLookView($current,$name_model,2,1,$model_id);
            $this->monthLookView($current,$name_model,3,1,$model_id);
            $this->yearLookView($current,$name_model,4,1,$model_id);
            $this->totalLookView($current,$name_model,5,1,$model_id);
        }
    }

    public function modelCheckFirstCurrentLookView($model_id,$name_model,$time_current,$time_view)
    {
        return $this
        ->belongsTo(Utility::lookViewModelString(), 'id', 'model_id')
        ->where('model',$name_model)
        ->where('time_current',$time_current)
        ->where('time_view',$time_view)
        ->first();
    }

    public function checkTimeoutLookView($check_time_value,$current,$name_model,$time_view,$time_current,$model_id)
    {
        if (!empty($check_time_value)) {

            if ($check_time_value == "true") {
                $check_try = true;
            }else{
                if (!empty($this->modelCheckFirstCurrentLookView($model_id,$name_model,$time_current,$time_view))) {
                    $data_check_updated_at = $this->modelCheckFirstCurrentLookView($model_id,$name_model,$time_current,$time_view)->updated_at;
                }else{
                    return true;
                }
                
                $format_time_updated = Carbon::parse($data_check_updated_at);
                if ($format_time_updated->year == Carbon::now()->year and $format_time_updated->month == Carbon::now()->month and $format_time_updated->day == Carbon::now()->day) {
                    if ($format_time_updated->secondsSinceMidnight() < Carbon::now()->subSecond((int)$check_time_value)->secondsSinceMidnight()) {
                        $check_try = true;
                    }else{
                        $check_try = false;
                    }
                }else{
                    $check_try = true;
                }
            }
        }else{
            $check_try = true;
        }

        return $check_try;
    }

    public function hourLookView($current,$name_model,$time_view,$time_current,$model_id)
    {
        // reset per day
        $check = $this->modelCheckFirstCurrentLookView($model_id,$name_model,$time_current,$time_view);
        if (!empty($check)) {
            $check_time = json_decode($check->total_view);
            $i = 0;
            foreach ($check_time as $time => $view_in_time) {
                if ($i == 0) {
                    $one_time = $time;
                }
                $i++;
            }
            $time_check_format = Carbon::createFromFormat('H d m Y', $one_time);

            if ($current->day ==  $time_check_format->day and $current->month == $time_check_format->month and $time_check_format->year == $current->year) {

                $update_array_time_view = [];

                $new_time_hour = true;
                
                foreach ($check_time as $time_data => $view_in_time_data) {
                    $update_array_time_view[$time_data] = $view_in_time_data;
                    if ($time_data == (string)$current->format('H d m Y')) {
                        $new_time_hour = false;
                    }
                }

                if ($new_time_hour) {
                    $update_array_time_view[$current->format('H d m Y')] = 1;
                }else{
                    $update_array_time_view[$current->format('H d m Y')] = $update_array_time_view[$current->format('H d m Y')] + 1;
                }

                $json_end = json_encode($update_array_time_view);
                $check->total_view = $json_end;
                $check->update();
            }else{
                $check->time_current = 0;
                $check->update();
            }

        }
        $check_ag = $this->modelCheckFirstCurrentLookView($model_id,$name_model,$time_current,$time_view);
        if (!empty($check_ag)) {}else{
            $model_post_view = Utility::lookViewModelString();
            $new_array_time_view = [];
            $new_array_time_view[$current->format('H d m Y')] = 1;
            $new_total_view = json_encode($new_array_time_view);
            $chart_check = 0;
            $new_view_post = new $model_post_view([
                'total_view' => $new_total_view,
                'time_view' => $time_view,
                'time_current' => $time_current,
                'time_show' => $current->format('d m Y'),
                'chart_check' => $chart_check,
                'model' => $name_model,
                'model_id' => $model_id
            ]);
            $new_view_post->save();
        }
    }

    public function dayLookView($current,$name_model,$time_view,$time_current,$model_id)
    {
        // reset per month
        $check = $this->modelCheckFirstCurrentLookView($model_id,$name_model,$time_current,$time_view);
        if (!empty($check)) {
            $check_time = json_decode($check->total_view);
            $i = 0;
            foreach ($check_time as $time => $view_in_time) {
                if ($i == 0) {
                    $one_time = $time;
                }
                $i++;
            }
            $time_check_format = Carbon::createFromFormat('d m Y', $one_time);

            if ($current->month == $time_check_format->month and $time_check_format->year == $current->year) {

                $update_array_time_view = [];

                $new_time_month = true;
                
                foreach ($check_time as $time_data => $view_in_time_data) {
                    $update_array_time_view[$time_data] = $view_in_time_data;
                    if ($time_data == (string)$current->format('d m Y')) {
                        $new_time_month = false;
                    }
                }

                if ($new_time_month) {
                    $update_array_time_view[$current->format('d m Y')] = 1;
                }else{
                    $update_array_time_view[$current->format('d m Y')] = $update_array_time_view[$current->format('d m Y')] + 1;
                }

                $json_end = json_encode($update_array_time_view);
                $check->total_view = $json_end;
                $check->update();
            }else{
                $check->time_current = 0;
                $check->update();
            }

        }
        $check_ag = $this->modelCheckFirstCurrentLookView($model_id,$name_model,$time_current,$time_view);
        if (!empty($check_ag)) {}else{
            $model_post_view = Utility::lookViewModelString();
            $new_array_time_view = [];
            $new_array_time_view[$current->format('d m Y')] = 1;
            $new_total_view = json_encode($new_array_time_view);
            $chart_check = 0;
            $new_view_post = new $model_post_view([
                'total_view' => $new_total_view,
                'time_view' => $time_view,
                'time_current' => $time_current,
                'time_show' => $current->format('m Y'),
                'chart_check' => $chart_check,
                'model' => $name_model,
                'model_id' => $model_id
            ]);
            $new_view_post->save();
        }
    }

    public function monthLookView($current,$name_model,$time_view,$time_current,$model_id)
    {
        // reset per year
        $check = $this->modelCheckFirstCurrentLookView($model_id,$name_model,$time_current,$time_view);
        if (!empty($check)) {
            $check_time = json_decode($check->total_view);
            $i = 0;
            foreach ($check_time as $time => $view_in_time) {
                if ($i == 0) {
                    $one_time = $time;
                }
                $i++;
            }
            $time_check_format = Carbon::createFromFormat('m Y', $one_time);

            if ($time_check_format->year == $current->year) {

                $update_array_time_view = [];

                $new_time_month = true;
                
                foreach ($check_time as $time_data => $view_in_time_data) {
                    $update_array_time_view[$time_data] = $view_in_time_data;
                    if ($time_data == (string)$current->format('m Y')) {
                        $new_time_month = false;
                    }
                }

                if ($new_time_month) {
                    $update_array_time_view[$current->format('m Y')] = 1;
                }else{
                    $update_array_time_view[$current->format('m Y')] = $update_array_time_view[$current->format('m Y')] + 1;
                }

                $json_end = json_encode($update_array_time_view);
                $check->total_view = $json_end;
                $check->update();
            }else{
                $check->time_current = 0;
                $check->update();
            }

        }
        $check_ag = $this->modelCheckFirstCurrentLookView($model_id,$name_model,$time_current,$time_view);
        if (!empty($check_ag)) {}else{
            $model_post_view = Utility::lookViewModelString();
            $new_array_time_view = [];
            $new_array_time_view[$current->format('m Y')] = 1;
            $new_total_view = json_encode($new_array_time_view);
            $chart_check = 0;
            $new_view_post = new $model_post_view([
                'total_view' => $new_total_view,
                'time_view' => $time_view,
                'time_current' => $time_current,
                'time_show' => $current->year,
                'chart_check' => $chart_check,
                'model' => $name_model,
                'model_id' => $model_id
            ]);
            $new_view_post->save();
        }
    }

    public function yearLookView($current,$name_model,$time_view,$time_current,$model_id)
    {
        // reset per year
        $check = $this->modelCheckFirstCurrentLookView($model_id,$name_model,$time_current,$time_view);
        if (!empty($check)) {
            $check_time = json_decode($check->total_view);
            $i = 0;
            foreach ($check_time as $time => $view_in_time) {
                if ($i == 0) {
                    $one_time = $time;
                }
                $i++;
            }
            $time_check_format = Carbon::createFromFormat('Y', $one_time);

            if (true) {

                $update_array_time_view = [];

                $new_time_month = true;
                
                foreach ($check_time as $time_data => $view_in_time_data) {
                    $update_array_time_view[$time_data] = $view_in_time_data;
                    if ($time_data == (string)$current->format('Y')) {
                        $new_time_month = false;
                    }
                }

                if ($new_time_month) {
                    $update_array_time_view[$current->format('Y')] = 1;
                }else{
                    $update_array_time_view[$current->format('Y')] = $update_array_time_view[$current->format('Y')] + 1;
                }

                $json_end = json_encode($update_array_time_view);
                $check->total_view = $json_end;
                $check->update();
            }else{
                $check->time_current = 0;
                $check->update();
            }

        }
        $check_ag = $this->modelCheckFirstCurrentLookView($model_id,$name_model,$time_current,$time_view);
        if (!empty($check_ag)) {}else{
            $model_post_view = Utility::lookViewModelString();
            $new_array_time_view = [];
            $new_array_time_view[$current->format('Y')] = 1;
            $new_total_view = json_encode($new_array_time_view);
            $chart_check = 0;
            $new_view_post = new $model_post_view([
                'total_view' => $new_total_view,
                'time_view' => $time_view,
                'time_current' => $time_current,
                'time_show' => $current->year,
                'chart_check' => $chart_check,
                'model' => $name_model,
                'model_id' => $model_id
            ]);
            $new_view_post->save();
        }
    }

    public function totalLookView($current,$name_model,$time_view,$time_current,$model_id)
    {
        // disable reset
        $check = $this->modelCheckFirstCurrentLookView($model_id,$name_model,$time_current,$time_view);
        if (!empty($check)) {
            $check->total_view = $check->total_view + 1;
            $check->update();
        }else{
            $model_post_view = Utility::lookViewModelString();
            $chart_check = 0;
            $new_view_post = new $model_post_view([
                'total_view' => 1,
                'time_view' => $time_view,
                'time_current' => $time_current,
                'time_show' => $current->year,
                'chart_check' => $chart_check,
                'model' => $name_model,
                'model_id' => $model_id
            ]);
            $new_view_post->save();
        }
    }

}
