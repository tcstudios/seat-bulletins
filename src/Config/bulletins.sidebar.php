<?php

return [
    'bulletins' => [
        'name' => 'Bulletins',
        'icon' => 'fas fa-book',
        'route_segment' => 'bulletins',
        'permission' => 'bulletins.view',
        'entries' => [
            ['name' => 'Bulletins', 'icon' => 'fas fa-file-alt', 'route' => 'bulletins.list', 'permission' => 'bulletins.view'],
            ['name' => 'Manage', 'icon' => 'fas fa-cog', 'route' => 'bulletins.manage', 'permission' => 'bulletins.view'],
            ['name' => 'About', 'icon' => 'fas fa-info', 'route' => 'bulletins.about', 'permission' => 'bulletins.view'],
        ],
    ],
];
