@include("admin.pageTypes.all", [
    'title' => 'Albums',
    'filters' => [
        'band' => [
            'bands' => $bands,
            'current' => $bandId
        ]
    ],
    'createButton' => [
        'text' => 'New Album',
        'href' => action('Admin\AlbumController@create')
    ],
    'table' => [
        'columns' => [
            [
                'header' => 'id',
                'valueKey' => 'id'
            ],
            [
                'header' => 'Name',
                'valueKey' => 'name'
            ],
            [
                'header' => 'Slug',
                'valueKey' => 'slug'
            ],
            [
                'type' => 'button',
                'button' => [
                    'type' => 'edit',
                    'text' => 'Edit',
                    'href' => '#'
                ]
            ],
            [
                'type' => 'button',
                'button' => [
                    'type' => 'delete',
                    'text' => 'Delete',
                    'href' => '#'
                ]
            ]
        ],
        'data' => $albums
    ]
])
