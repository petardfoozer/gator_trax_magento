<?php

$looks = [
    "id"               => 1,
    "type"             => 1,
    "availableOptions" => [
        [
            "id"        => 10,
            "color"     => "Duck Grass Camo",
            "active"    => true
        ],[
            "id"        => 11,
            "color"     => "BTB (Back to Basics)",
            "active"    => true
        ],[
            "id"        => 12,
            "color"     => "Nat Gear",
            "active"    => true
        ],[
            "id"        => 13,
            "color"     => "Gator Skin",
            "active"    => true
        ],[
            "id"        => 14,
            "color"     => "All Terrain Brown",
            "active"    => true
        ],[
            "id"        => 15,
            "color"     => "All Terrain Green",
            "active"    => true
        ]
    ]
];

echo json_encode($looks);


