<?php

return [
   // 'invoice/<name:\w+>'    => 'invoice/read',

    '<controller:\w+>' => '<controller>/index',
    '<controller:\w+>/<action:\w+>'    => '<controller>/<action>',
    '<controller:\w+>/<action:\w+>/<id:\d+>'    => '<controller>/<action>',
];