<?php
return [
    'user' => [
        'avatar_path' => public_path() . '/uploads/avatar/',
        'paginate' => 10,
        'avatar_default' => 'default-avatar.png',
        'is_admin' => 1,
    ],
    'action' => [
        'add' => 'add',
        'remove' => 'remove',
    ],
];
