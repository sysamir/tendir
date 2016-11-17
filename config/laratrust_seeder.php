<?php

return [
    'role_structure'  => [
        'super_admin' => [
            /* Admins */
            'admin_in_menu' => 'v',
            'admins'        => 'c,r,u,d',
            'roles'         => 'c,r,u,d',
            'permissions'   => 'c,r,u,d',
            'bugs'          => 'r',

            'users'     => 'c,r,u,d',
            'tenders'   => 'c,r,u,d',
            'appeals'    => 'c,r,u,d',
            'companies' => 'c,r,u,d',

            'emails'     => 'c,r,u,d',
            'settings'   => 'c,r,u,d',
            'statistics' => 'v',
        ],
        'admin'       => [
            'users' => 'c,r,u,d',
        ],
        'moderator'   => [
            'users' => 'c,r,u,d',
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        's' => 'search',
        'v' => 'view',
        'o' => 'own',
    ],
];
