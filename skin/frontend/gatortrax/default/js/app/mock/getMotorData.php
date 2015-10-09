<?php

$data = 
[
    "motors"=>
    [
        "name"=>"motors",
        "id"=> 120,
        "types"=> 
        [
            [
                "id"=>205, 
                "name"=>"Mud Motor",
                "brands"=> [
                    [
                        "name"=>"Mud Buddy",
                        "type"=> 120,
                        "active"=>true,
                        "motors"=>
                        [
                            ["id"=>1,"name"=>"23 HD Sport Belt Drive", "double"=>true, "rules"=> [], "active"=>true], 
                            ["id"=>2,"name"=>"35 HD Sport Belt Drive", "double"=>true, "rules"=> [], "active"=>true],
                            ["id"=>3,"name"=>"4500 Black Death HD Sport Belt Drive", "double"=>true, "rules"=> [], "active"=>true],
                            ["id"=>4,"name"=>"37 EFI HD Sport Belt Drive", "double"=>true, "rules"=> [], "active"=>true]
                        ]
                    ],
                    [
                        "name"=>"Pro Drive",
                        "type"=> 120,
                        "active"=>true,
                        "motors"=>
                        [
                            ["id"=>5,"name"=>"23 HD Sport Belt Drive", "double"=>true, "rules"=> [], "active"=>true],
                            ["id"=>6,"name"=>"35 HD Sport Belt Drive", "double"=>true, "rules"=> [], "active"=>true],
                            ["id"=>7,"name"=>"4500 Black Death HD Sport Belt Drive", "double"=>true, "rules"=> [], "active"=>true],
                            ["id"=>8,"name"=>"37 EFI HD Sport Belt Drive", "double"=>true, "rules"=> [], "active"=>true],
                            ["id"=>9,"name"=>"37 EFI HD Sport Belt Drive", "double"=>true, "rules"=> [], "active"=>true],
                            ["id"=>10,"name"=>"37 EFI HD Sport Belt Drive", "double"=>true, "rules"=> [], "active"=>true]
                        ]
                    ]
                ]
            ],
            [
                "id"=>210, 
                "name"=>"Outboard Motor",
                "brands"=> [
                    [
                        "name"=>"Mercury",
                        "type"=> 120,
                        "motors"=>
                        [
                            ["id"=>11,"name"=>"23 HD Sport Belt Drive", "double"=>true, "rules"=> [], "active"=>true],
                            ["id"=>12,"name"=>"35 HD Sport Belt Drive", "double"=>true, "rules"=> [], "active"=>true],
                            ["id"=>13,"name"=>"4500 Black Death HD Sport Belt Drive", "double"=>true, "rules"=> [], "active"=>true],
                            ["id"=>14,"name"=>"37 EFI HD Sport Belt Drive", "double"=>true, "rules"=> [], "active"=>true]
                        ]
                    ],
                    [
                        "name"=>"Suzuki",
                        "type"=> 120,
                        "motors"=>
                        [
                            ["id"=>15,"name"=>"23 HD Sport Belt Drive", "double"=>true, "rules"=> [], "active"=>truee],
                            ["id"=>16,"name"=>"35 HD Sport Belt Drive", "double"=>true, "rules"=> [], "active"=>true],
                            ["id"=>17,"name"=>"4500 Black Death HD Sport Belt Drive", "double"=>true, "rules"=> [], "active"=>true],
                            ["id"=>18,"name"=>"37 EFI HD Sport Belt Drive", "double"=>true, "rules"=> [], "active"=>true],
                            ["id"=>19,"name"=>"37 EFI HD Sport Belt Drive", "double"=>true, "rules"=> [], "active"=>true],
                            ["id"=>20,"name"=>"37 EFI HD Sport Belt Drive", "double"=>true, "rules"=> [], "active"=>true]
                        ]
                    ]
                ]
            ]
        ]
    ],
    "steering"=>
    [
        "name"=>"steering",
        "id"=>121,
        "types"=>
        [
            [
                "name"=> "Tiller",
                "id"=>130,
                "type"=>121,
                "rules"=> [], 
                "active"=>true
            ],
            [
                "name"=> "Center Console",
                "id"=>131,
                "type"=>121,
                "rules"=> [], 
                "active"=>true
            ],
            [
                "name"=> "Starboard Console",
                "id"=>132,
                "type"=>121,
                "rules"=> [], 
                "active"=>true
            ],
            [
                "name"=> "Port Console",
                "id"=>133,
                "type"=>121,
                "rules"=> [], 
                "active"=>true
            ]
        ]
    ]
];


echo json_encode($data);