<?php
require_once 'config/config.php';

require_once 'models/Model.php';

require_once 'Calories.php';

require_once 'Users.php';

$cal = new Calories();

//$cal->testFunction();

$calories_array = [
    'id' => 1,
    'date' => ' 2016-09-16',
    'time' => '08:20:20',
    'description' => 'A secret recipe packed with 1000Kalories',
    'num_calories'=> 100
];


//$cal->save($calories_array);

//$cal->delete(6);
//$cal->edit($calories_array);


/*******************************************************/

$user = new Users();

$users_arrays = [


    ['id' => 3,
        'email'=>'user2@email.com',
        'password' => 'pass'],
    ['id' => 4,
        'email'=>'user3@email.com',
        'password' => 'pass'],
    ['id' => 5,
        'email'=>'user4@email.com',
        'password' => 'pass'],
    ['id' => 6,
        'email'=>'user5@email.com',
        'password' => 'pass']

];


/*
foreach($users_arrays as $key=>$user_data){
    $user->register($user_data);
}
*/

$login =  ['id' => 2,
    'email'=>'user1@email.com',
    'password' => 'pass'];

$user->login($login);

