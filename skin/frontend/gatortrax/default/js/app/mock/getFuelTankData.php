<?php

$fuelTank = [

    "id"    => 1,
    "type"  => 10,
    "options" =>
    [
        [
            "name"  => "9 Gallon Aluminum in Rear Port Corner",
            "id"    => 1,
            "type"  => 1
        ],
        [
            "name"  => "12 Gallon Aluminum in Rear Port Corner",
            "id"    => 2,
            "type"  => 1
        ],
        [
            "name"  => "6 Gallon Plastic with Bracket",
            "id"    => 3,
            "type"  => 1
        ],
        [
            "name"  => "9 Gallon Plastic with Bracket",
            "id"    => 4,
            "type"  => 1
        ],
        [
            "name"  => "12 Gallon Plastic with Bracket",
            "id"    => 5,
            "type"  => 1
        ],
        [
            "name"  => "18 Gallon Plastic Permanent Mount (for boats with rear decks)",
            "id"    => 6,
            "type"  => 1
        ],
        [
            "name"  => "27 Gallon Plastic Permanent Mount (for boats with rear decks)",
            "id"    => 7,
            "type"  => 1
        ],
        [
            "name"  => "Custom Aluminum (call to get a quote)",
            "id"    => 8,
            "type"  => 1
        ],
        [
            "name"  => "Fuel Water Separator",
            "id"    => 9,
            "type"  => 1
        ]
    ]
];

echo json_encode($fuelTank);