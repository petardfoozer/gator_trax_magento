<?php

$decks =[

    "deck_types"=>
    [
        "name"=>"deck_name",
        "id"  => 10,
        "styles"=>
        [
            [
                "id" => 150,
                "type"  => 10,
                "name" => "Extended Deck Welded",
                "active" => true,
                "deck_options" =>
                [
                    ["id"=>1, "name"=>"Enclosed with Hatch", "rules"=>[], "active"=>true]
                ]
            ],
            [
                "id" => 250,
                "type"  => 10,
                "name" => "Removable Extended Deck",
                "active" => true,
                "deck_options" =>
                [
                    ["id"=>2, "name"=>'18" Size Deck', "rules"=>[], "active"=>true],
                    ["id"=>3, "name"=>'24" Size Deck', "rules"=>[], "active"=>true],
                    ["id"=>4, "name"=>'36" Size Deck', "rules"=>[], "active"=>true],
                    ["id"=>5, "name"=>'48" Size Deck', "rules"=>[], "active"=>true]
                ]
            ]
        ]
    ]

];

echo json_encode($decks);