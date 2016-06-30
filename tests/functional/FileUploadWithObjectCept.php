<?php
$I = new FunctionalTester($scenario);
$I->wantTo('upload file');

$I->sendPOST('/rest', [], [
    'dump' => new Zend\Diactoros\UploadedFile(codecept_data_dir('dump.sql'), 57, 0, 'dump.sql', 'text/plain')
]);
$I->seeResponseIsJson();
$I->seeResponseContainsJson(['files' => [
    'dump' => [
        'name' => 'dump.sql',
        'size' => 57,
    ]
]]);
