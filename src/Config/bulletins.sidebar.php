<?php

return [
    'bulletins' => [
        'name' => 'Corporate Bulletins',
        'icon' => 'fas fa-file-alt',
        'route_segment' => 'bulletins',
        'permission' => 'bulletins.view',
        'entries' => [
            ['name' => 'About', 'icon' => 'fas fa-info', 'route' => 'bulletins.about', 'permission' => 'bulletins.view'],
        ],
    ],
];
