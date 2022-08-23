<?php
return [
    'admin_permissions' => [
        'permission.refresh',
        'permission.view',
        'role.view',
        'role.create',
        'role.edit',
        'role.delete',
        'user.view',
        'user.create',
        'user.edit',
    ],

    'system_settings' => [
        ['menu' => 'Roles', 'route' => 'role.index', 'permission' => 'role.view', 'name' => 'role'],
        ['menu' => 'Permissions', 'route' => 'permission.index', 'permission' => 'permission.view', 'name' => 'permission'],
        ['menu' => 'Users', 'route' => 'user.index', 'user' => 'user.view', 'name' => 'user'],
    ],

    'masters' => [],

    'reports' => [],
];
