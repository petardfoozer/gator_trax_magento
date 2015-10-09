<?php

$accessories = [

    "name"     => "accessory_products",
    "id"       => 100,
    "type"     => 10,
    "products" =>
    [
        [
            "type"  => 100,
            "name"  => "Extra Battery Trays",
            "id"    => 1,
            "product_options"   =>
            [
                [
                    "name"  => "Yes",
                    "type"  => 1,
                    "id"    => 10,
                    "rules"     => [],
                    "active"    => true
                ],
                [
                    "name"  => "No",
                    "type"  => 1,
                    "id"    => 11,
                    "rules"     => [],
                    "active"    => true
                ]
            ]
        ],
        [
            "type"  => 100,
            "name"  => "Stick It Anchor Pin",
            "id"    => 2,
            "product_options"   =>
            [
                [
                    "name"  => "7ft Anchor Pin",
                    "type"  => 2,
                    "id"    => 12,
                    "rules"     => [],
                    "active"    => true
                ],
                [
                    "name"  => "8ft Anchor Pin",
                    "type"  => 2,
                    "id"    => 13,
                    "rules"     => [],
                    "active"    => true
                ]
            ]
        ],
        [
            "type"  => 100,
            "name"  => "Bow Light Protector",
            "id"    =>3,
            "product_options"   =>
                [
                    [
                        "name"  => "Yes",
                        "type"  => 3,
                        "id"    => 14,
                        "rules"     => [],
                        "active"    => true
                    ],
                    [
                        "name"  => "No",
                        "type"  => 3,
                        "id"    => 15,
                        "rules"     => [],
                        "active"    => true
                    ]
                ]
        ],
        [
            "type"  => 100,
            "name"  => "Hydroturf Lid Pads",
            "id"    => 4,
            "product_options"   =>
            [
                [
                    "name"  => "Half Box Lid",
                    "type"  => 4,
                    "id"    => 16,
                    "rules"     => [],
                    "active"    => true
                ],
                [
                    "name"  => "Gun Box Lid",
                    "type"  => 4,
                    "id"    => 17,
                    "rules"     => [],
                    "active"    => true
                ]
            ]
        ],
        [
            "type"  => 100,
            "name"  => "Quick Fist Clamps",
            "id"    => 5,
            "product_options"   =>
            [
                [
                    "name"  => "Push Pole Clamp",
                    "type"  => 5,
                    "id"    => 18,
                    "rules"     => [],
                    "active"    => true
                ],
                [
                    "name"  => "Stabilizer Pole Clamps",
                    "type"  => 5,
                    "id"    => 19,
                    "rules"     => [],
                    "active"    => true
                ]
            ]
        ],
        [
            "type"  => 100,
            "name"  => "Engel Coolers",
            "id"    => 6,
            "product_options"   =>
            [
                [
                    "name"  => "60 Quart",
                    "type"  => 6,
                    "id"    => 20,
                    "rules"     => [],
                    "active"    => true
                ],
                [
                    "name"  => "80 Quart",
                    "type"  => 6,
                    "id"    => 21,
                    "rules"     => [],
                    "active"    => true
                ]
            ]
        ]
    ]
];

echo json_encode($accessories);
