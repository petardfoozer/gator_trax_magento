<?php

$flooring = [

    "id"        => 1,
    "type"      => 10,
    "options"   =>
    [
        [
            "type"      => 1,
            "name"      => "Duck Grass",
            "id"        => 10,
            "active"    => true
        ],
        [
            "type"      => 1,
            "name"      => "BTB (Back to Basics)",
            "id"        => 11,
            "active"    => true
        ],
        [
            "type"      => 1,
            "name"      => "Natural Gear",
            "id"        => 12,
            "active"    => true
        ],
        [
            "type"      => 1,
            "name"      => "Gator Boat Brown",
            "id"        => 13,
            "active"    => true
        ],
        [
            "type"      => 1,
            "name"      => "Gator Skin",
            "id"        => 14,
            "active"    => true
        ]
    ]
];

echo json_encode($flooring);