<?php

return [
    'defaults' => [
        'attempts_threshold' => 1,      //especificar cuántos intentos tiene que hacer antes de declarar que un servicio ha "fallado" - predeterminado: 3;
        'attempts_ttl' => 1,            //especificar la ventana de tiempo (en minutos) en la que se realizan los intentos antes de declarar que un servicio "falló" - predeterminado: 1
        'failure_ttl' => 1              //una vez que un servicio se marca como "fallido", permanecerá en este estado durante este número de minutos, por defecto: 5;
    ],
    'services' => [
        'SpecialServices' => [
            'attempts_threshold' => 1,
            'attempts_ttl' => 1,
            'failure_ttl' => 1
        ]
    ]

];