<?php

require __DIR__ . '/../Cliargs.php';

$args = new wdst\cliargs\Cliargs();

$args->add('lockfile', 'l', 'lockfile', 'Lockfile for locking sync', function ($file) {
    return $file;
});
$option = $args->execute();

print $option['lockfile'];