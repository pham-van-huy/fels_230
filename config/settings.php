<?php
return [
    'user' => [
        'avatar_path' => '/uploads/avatar/',
        'paginate' => 10,
        'paginate_word' => 200,
        'avatar_default' => 'default-avatar.png',
        'path_avatar_default' => '/uploads/avatar/default-avatar.png',
        'is_admin' => 1,
        'limit_number_show_in_homepage' => 5,
        'all' => 'all',
        'follow' => 'follow',
        'un_follow' => 'un_follow',
        'default_password' => 123123,
    ],
    'action' => [
        'add' => 'add',
        'remove' => 'remove',
    ],
    'answer' => [
        'number_answer' => 4,
        'is_correct_answer' => 1,
        'not_correct_answer' => 0,
    ],
    'filter' => [
        'no_learned' => '0',
        'learned' => '1',
    ],
    'status' => [
        'success' => 1,
        'fail' => 0,
    ],
    'activities' => [
        'limit_get_activities' => 5,
        'limit_activities_user' => 10,
    ],
    'word' => [
        'limit_words_random' => 15,
    ],
];
