<?php

return [
    'filters' => [
        'items_per_page' => [
            10,
            50,
            100,
            500,
            1000,
        ],
        'methods' => [
            'All' => '',
            'GET' => 'GET',
            'POST' => 'POST',
            'PUT' => 'PUT',
            'PATCH' => 'PATCH',
            'DELETE' => 'DELETE',
        ],
    ]
];
