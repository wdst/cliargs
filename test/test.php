<?php

require __DIR__ . '/../Cliargs.php';

$args = new wdst\cliargs\Cliargs();

$args->add('lockfile', null, 'lock', 'lockfile for locking sync', function ($file) {
    return $file;
});

$args->add('sdf', 't', null, 'lockfile for locki asdf sdf sdf sdnasdasdg sync', function ($file) {
    return $file;
});
$args->add('aaa', null, 'asdswdwds', 'lockfile for lockinasdasdg sync', function ($file) {
    return $file;
});
$option = $args->execute();

print @$option['lockfile'];