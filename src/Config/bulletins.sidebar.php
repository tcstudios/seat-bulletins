<?php

return [
    'bulletins' => [
        'name' => 'Corporate Bulletins',
        'icon' => 'fa fa-file-text-o',
        'route_segment' => 'bulletins',
        'permission' => 'bulletins.view',
        'entries' => [
            ['name' => 'About', 'icon' => 'fas fa-info', 'route' => 'bulletins.about', 'permission' => 'bulletins.view'],
        ],
    ],
];
