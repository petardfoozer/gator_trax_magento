<?php

$electrical =
[
   "name"      => "electrical_products",
   "id"       => 10,
   "type"     => 100,
   "products"  =>
       [
       "id"     => 100,
       "name"   => "Accessories",
       "products"=>
       [
            [
                "type"  => 100,
                "name"  => "LED Spotlight Kit",
                "id"    => 1,
                "product_options"  =>
                [
                    [
                        "name"      => "Dual 60W Lights",
                        "type"      => 1,
                        "id"        => 10,
                        "rules"     => [],
                        "active"    => true
                    ],[
                        "name"      => "120W Light Bar",
                        "type"      => 1,
                        "id"        => 11,
                        "rules"     => [],
                        "active"    => true
                    ]
                ]
            ],
            [
                "type"  => 100,
                "name"  => "Bilge Pump",
                "id"    => 2,
                "product_options"  =>
                [
                    [
                        "name"      => "1100GPH Manual",
                        "type"      => 2,
                        "id"        => 12,
                        "rules"     => [],
                        "active"    => true
                    ],[
                        "name"      => "1100GPH Automatic",
                        "type"      => 2,
                        "id"        => 13,
                        "rules"     => [],
                        "active"    => true
                    ]
                ]
            ],
            [
                "type"  => 100,
                "name"  => "12v Plug",
                "id"    => 3,
                "product_options"  =>
                [
                    [
                        "name"      => "Rear",
                        "type"      => 3,
                        "id"        => 14,
                        "rules"     => [],
                        "active"    => true
                    ],[
                        "name"      => "Mid Ship",
                        "type"      => 3,
                        "id"        => 15,
                        "rules"     => [],
                        "active"    => true
                    ]
                ]
            ],
            [
                "type"  => 100,
                "name"  => "Rocker Panel Switches (Includes 12v plug)",
                "id"    => 4,
                "product_options"   =>
                [
                    [
                        "name"      => "Yes",
                        "type"      => 4,
                        "id"        => 16,
                        "rules"     => [],
                        "active"    => true
                    ],[
                        "name"      => "No",
                        "type"      => 4,
                        "id"        => 17,
                        "rules"     => [],
                        "active"    => true
                    ]
                ]
            ],
            [
                "type"  => 100,
                "name"  => "LED Side Navigation Lights (Front red and green bow light upgrade)",
                "id"    => 5,
                "product_options"   =>
                [
                     [
                        "name"      => "Yes",
                        "type"      => 4,
                        "id"        => 18,
                        "rules"     => [],
                        "active"    => true
                     ],[
                        "name"      => "No",
                        "type"      => 4,
                        "id"        => 19,
                        "rules"     => [],
                        "active"    => true
                    ]
                ]
            ],
            [
                "type"  => 100,
                "name"  => "Cranking Battery",
                "id"    => 6,
                "product_options"   =>
                [
                    [
                        "name"      => "Yes",
                        "type"      => 4,
                        "id"        => 20,
                        "rules"     => [],
                        "active"    => true
                    ],[
                        "name"      => "No",
                        "type"      => 4,
                        "id"        => 21,
                        "rules"     => [],
                        "active"    => true
                    ]
                ]
            ],
            [
                "type"  => 100,
                "name"  => "Deep Cycle Trolling Battery",
                "id"    => 7,
                "product_options"   =>
                [
                    [
                        "name"      => "Yes",
                        "type"      => 4,
                        "id"        => 22,
                        "rules"     => [],
                        "active"    => true
                    ],[
                        "name"      => "No",
                        "type"      => 4,
                        "id"        => 23,
                        "rules"     => [],
                        "active"    => true
                    ]
                ]
            ],
            [
                "type"  => 100,
                "name"  => "On Board Charger",
                "id"    => 8,
                "product_options"  =>
                [
                    [
                        "name"      => "1 Bank",
                        "type"      => 8,
                        "id"        => 24,
                        "active"    => true
                    ],[
                        "name"      => "2 Banks",
                        "type"      => 8,
                        "id"        => 25,
                        "active"    => true
                    ],[
                        "name"      => "3 Banks",
                        "type"      => 8,
                        "id"        => 26,
                        "active"    => true
                    ],[
                        "name"      => "4 Banks",
                        "type"      => 8,
                        "id"        => 27,
                        "active"    => true
                    ]
                ]
            ],
            [
                "type"  => 100,
                "name"  => "Trolling Motor Plug and Wiring (Must have to operate trolling motor)",
                "id"    => 9,
                "product_options"   =>
                [
                    [
                        "name"      => "Yes",
                        "type"      => 4,
                        "id"        => 28,
                        "rules"     => [],
                        "active"    => true
                    ],[
                        "name"      => "No",
                        "type"      => 4,
                        "id"        => 29,
                        "rules"     => [],
                        "active"    => true
                    ]
                ]
            ],
            [
                "type"  => 100,
                "name"  => "Extreme Navigation Light (Rear stern light upgrade)",
                "id"    => 10,
                "product_options"   =>
                [
                    [
                        "name"      => "Yes",
                        "type"      => 4,
                        "id"        => 30,
                        "rules"     => [],
                        "active"    => true
                    ],[
                        "name"      => "No",
                        "type"      => 4,
                        "id"        => 31,
                        "rules"     => [],
                        "active"    => true
                    ]
                ]
            ]

        ]
    ]
];

echo json_encode($electrical);