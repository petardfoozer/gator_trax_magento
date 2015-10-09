<?php

$trailers =
    [
        "id"    => 101,
        "type"  => 10,
        "name"  => "Trailers",
        "options"=>
        [
            [
                "type"  => 101,
                "name"  => "Trailer for 38\" Bottom",
                "id"    => 10,
                "rules" => [],
                "active"=> true
            ],
            [
                "type"  => 101,
                "name"  => "Trailer for 44\" Bottom",
                "id"    => 11,
                "rules" => [],
                "active"=> true
            ],
            [
                "type"  => 101,
                "name"  => "Trailer for 50\" Bottom",
                "id"    => 12,
                "rules" => [],
                "active"=> true
            ],
            [
                "type"  => 101,
                "name"  => "Trailer for 54\" Bottom",
                "id"    => 13,
                "rules" => [],
                "active"=> true
            ]

        ]
    ];
echo json_encode($trailers);