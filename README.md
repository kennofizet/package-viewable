# package-viewable
Install : ```composer require kennofizet/lookview```

+ model :
  - user : 
       ```
       namespace App;
        .............
       use Package\Kennofizet\Lookview\Traits\LookViewUserAble;
       class User extends Authenticatable
       {
         use LookViewUserAble;
         ...............
       }
       ```
   - post ... : 
       ```
       namespace App;
        .............
       use Package\Kennofizet\Lookview\Traits\LookViewAble;
       class Post extends Authenticatable
       {
         use LookViewAble;
         ...............
       }
       ```
+ config/app.php :
  ```
  'providers' => [
    ..................
    Package\Kennofizet\Lookview\Providers\PackageServiceProvider::class
    ..................
  ],
  ```
+ function : 
  - ```$user = User::find($id_user);```
  - ```$model = Post::find($id_post);```
  - ```$user->viewd($model);``` // user viewd model + 1
  - ```$user->viewd($model,second_time);``` // limit viewd by second time
  - ```$user->viewd_data_all($model);``` // list all viewd model by user
  - ```$user->viewd_data($model);``` // list data viewd lastest (hour day month year) model by user
  - ```$user->viewd_data($model,$string_time);``` // data viewd lastest ($string_time = hour day month year) model by user 
  - ```$user->viewd_hour($model);``` //count viewd model by user current hour
  - ```$user->viewd_hour($model,$format_H_d_m_Y_time);``` // count viewd model by user in $format_H_d_m_Y_time
  - ```$user->viewd_day($model);``` //count viewd model by user current day
  - ```$user->viewd_day($model,$format_d_m_Y_time);``` // count viewd model by user in $format_d_m_Y_time
  - ```$user->viewd_month($model);``` //count viewd model by user current month
  - ```$user->viewd_month($model,$format_m_Y_time);``` // count viewd model by user in $format_m_Y_time
  - ```$user->viewd_year($model);``` //count viewd model by user current year
  - ```$user->viewd_year($model,$format_Y_time);``` // count viewd model by user in $format_Y_time
  - ```$user->viewd_total($model);``` // total time user viewd model
  - ```$user->view_token();``` // get token user view time
 
  - ```$model->viewd();``` // model viewd + 1
  - ```$model->viewd(second_time);``` // limit viewd by second time
  - ```$model->viewd_data_all();``` // list all viewd
  - ```$model->viewd_data();``` // list data viewd lastest (hour day month year)
  - ```$model->viewd_data($string_time);``` // data viewd lastest ($string_time = hour day month year) 
  - ```$model->viewd_hour();``` //count viewd current hour
  - ```$model->viewd_hour($format_H_d_m_Y_time);``` // count viewd in $format_H_d_m_Y_time
  - ```$model->viewd_day();``` //count viewd current day
  - ```$model->viewd_day($format_d_m_Y_time);``` // count viewd in $format_d_m_Y_time
  - ```$model->viewd_month();``` //count viewd current month
  - ```$model->viewd_month($format_m_Y_time);``` // count viewd in $format_m_Y_time
  - ```$model->viewd_year();``` //count viewd current year
  - ```$model->viewd_year($format_Y_time);``` // count viewd in $format_Y_time
  - ```$model->viewd_total();``` // total time viewd
