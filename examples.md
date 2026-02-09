Menu 

<?php
'items' => [
    ['label' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'heroicon-o-home', 'active' => true],
    ['type' => 'divider'],
    ['type' => 'title', 'label' => 'Settings'],
    [
        'label' => 'Admin',
        'icon' => 'heroicon-o-cog',
        'collapsible' => true,
        'children' => [
            ['label' => 'Users', 'route' => 'users'],
            ['label' => 'Roles', 'route' => 'roles', 'badge' => '5', 'badgeColor' => 'error'],
        ]
    ],
]