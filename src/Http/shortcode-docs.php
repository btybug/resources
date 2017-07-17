<?php
return [
    [
        'section' => 'Styles',
        'functions' => [
            [
                'title' => 'Assest Classes',
                'des' => 'This function provides all available classes against specific class type<br/>Like Text,Images',
                'params' => 'Type of Class  possible values can be text,image,container,field,button,notification,menu || Response type (collection/array) ',
                'return' => 'Collection | Array',
                'code_snap' => 'BBClasses($type,$response_style)'
            ],
            [
                'title' => 'Assest Classes Lists',
                'des' => 'This function provides all available classes against specific class type in lists style',
                'params' => 'Type of Class  possible values can be text,image,container,field,button,notification,menu',
                'return' => 'Lists data',
                'code_snap' => 'BBClassesList()'
            ],
            [
                'title' => 'Assest Classe Variations',
                'des' => 'This function provides all classe Variations ',
                'params' => 'id of Class || Response type',
                'return' => 'All Class Variations in shape of Collection | Array',
                'code_snap' => 'BBClassVariations($id,$response_style)'
            ],
            [
                'title' => 'Assest Classe Variations Lists',
                'des' => 'This function provides all classe Variations in Lists',
                'params' => 'id of Class',
                'return' => 'All Class Variations in shape of Lists',
                'code_snap' => 'BBClassVariationsList($id)'
            ]
        ]
    ],
    [
        'section' => 'Core Assests',
        'functions' => [
            [
                'title' => 'List Core Assests',
                'des' => 'This function provides all System Core Assests',
                'params' => 'response type [ Collection | Array ]',
                'return' => 'Core Assests Collection / Array',
                'code_snap' => 'BBCoreAssests($response_style)'
            ],
            [
                'title' => 'Core Assest Details',
                'des' => 'This function provides Details About Core Assest including its code samples',
                'params' => 'id of Assest,response type [ Collection | Array ]',
                'return' => 'Full Assest Details as Collection / Array',
                'code_snap' => 'BBCoreAssest($id,$response_style)'
            ]
        ]
    ],
    [
        'section' => 'Fonts',
        'functions' => [
            [
                'title' => 'List Font Libs',
                'des' => 'This function provides all Available Font libs',
                'params' => 'NONE',
                'return' => 'Font Libs Info as Array',
                'code_snap' => 'BBFontLibs()'
            ]
        ]
    ]
];