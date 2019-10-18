<?php

return [
    'name' => '用户管理',
    'middleware'=>['auth'],
    'namespace'=>null,
    'prefix'=>'',
    'index'=>'welcome',
    'groups'=>[], // 前后端分离，非权限相关的后端可以不用维护，
    'routes'=>[
        'data.user.index'=>[
            'uri'         =>'data/user/index',
            'uses'        =>'Data\UserController@getAllUsers',
            'method'      =>'get',
            'name'        =>'用户列表',
        ],
    ],
];
