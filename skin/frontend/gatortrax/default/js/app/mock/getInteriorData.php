<?php

$data = 
[
    "name"     => "boat_interior_positions",
    "id"       => 101,
    "type"     => 500,
    "positions"=>
    [
        "name"=>"positions",
        "id"=> 500,
        "types"=>
        [
            [
                "name"=>"port",
                "alternative_name"=>"left",
                "type"=>500,
                "id"=> 540,
                "boxes"=>[
                    [
                        "id"    => 8,
                        "type"  => 540,
                        "name"  => "Rear Half Box Port",
                        "rules" => [],
                        "active"=> true
                    ],
                    [
                        "id"    => 9,
                        "type"  => 540,
                        "name"  => "Gun Box Port",
                        "rules" => [],
                        "active"=> true
                    ],
                    [
                        "id"    => 10,
                        "type"  => 540,
                        "name"  => "Rod Box Port",
                        "rules" => [],
                        "active"=> true
                    ],
                    [
                        "id"    => 11,
                        "type"  => 540,
                        "name"  => "Open Catwalk Port",
                        "rules" => [],
                        "active"=> true
                    ],
                    [
                        "id"    => 12,
                        "type"  => 540,
                        "name"  => "Enclosed Catwalk Port",
                        "rules" => [],
                        "active"=> true
                    ],
                    [
                        "id"    => 13,
                        "type"  => 540,
                        "name"  => "Half Box Mid-Ship Port",
                        "rules" => [],
                        "active"=> true
                    ],
                    [
                        "id"    => 14,
                        "type"  => 540,
                        "name"  => "Slanted Half Box Port",
                        "rules" => [],
                        "active"=> true
                    ]
                ]
            ],
            [
                "name"=>"center",
                "alternative_name"=>"middle",
                "type"=>500,
                "id"=> 550,
                "boxes"=>
                    [
                        [
                            "id"    => 15,
                            "type"  => 550,
                            "name"  => "Center Bench",
                            "rules" => [],
                            "active"=> true
                        ]
                    ]
            ],
            [
                "name"=>"starboard",
                "alternative_name"=>"right",
                "type"=>500,
                "id"=> 530,
                "boxes"=>
                [
                    [
                        "id"    => 1,
                        "type"  => 530,
                        "name"  => "Rear Half Box Starboard",
                        "rules" => [],
                        "active"=> true
                    ],
                    [
                        "id"    => 2,
                        "type"  => 530,
                        "name"  => "Gun Box Starboard",
                        "rules" => [],
                        "active"=> true
                    ],
                    [
                        "id"    => 3,
                        "type"  => 530,
                        "name"  => "Rod Box Starboard",
                        "rules" => [],
                        "active"=> true
                    ],
                    [
                        "id"    => 4,
                        "type"  => 530,
                        "name"  => "Open Catwalk Starboard",
                        "rules" => [],
                        "active"=> true
                    ],
                    [
                        "id"    => 5,
                        "type"  => 530,
                        "name"  => "Enclosed Catwalk Starboard",
                        "rules" => [],
                        "active"=> true
                    ],
                    [
                        "id"    => 6,
                        "type"  => 530,
                        "name"  => "Half Box Mid-Ship Starboard",
                        "rules" => [],
                        "active"=> true
                    ],
                    [
                        "id"    => 7,
                        "type"  => 530,
                        "name"  => "Slanted Half Box Starboard",

                        "active"=> true
                    ]
                ]

            ]
        ]
    ]
];

echo json_encode($data);
