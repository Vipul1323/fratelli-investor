<?php

return [
    'role_structure' => [
        'superadministrator' => [
            'users' => 'c,r,u,d,v',
            'emailtemplates' => 'c,r,u,d,v',
            'staticpages' => 'c,r,u,d,v',
            'contactus' => 'c,r,u,d,v',
            'subadmin' => 'c,r,u,d,v',
            'acl' => 'c,r,u,d,v',
            'profile' => 'r,u',
        ],
        'administrator' => [
            'users' => 'c,r,u,d,v',
            'emailtemplates' => 'c,r,u,d,v',
            'staticpages' => 'c,r,u,d,v',
            'contactus' => 'c,r,u,d,v',
            'subadmin' => 'c,r,u,d,v',
            'acl' => 'c,r,u,d,v',
            'profile' => 'r,u',
        ],
        'subadmin' => [
            'users' => 'c,r,u,d,v',
            'emailtemplates' => 'c,r,u,d,v',
            'staticpages' => 'c,r,u,d,v',
            'contactus' => 'c,r,u,d,v',
            'profile' => 'r,u',
        ],
        'user' => [
            'profile' => 'r,u',
        ],
    ],
    'permission_structure' => [
        'superadministrator' => [
            'users' => 'c,r,u,d,v',
            'acl' => 'c,r,u,d,v',
            'profile' => 'r,u',
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'list',
        'u' => 'update',
        'd' => 'delete',
        'v' => 'view',
    ],
];
