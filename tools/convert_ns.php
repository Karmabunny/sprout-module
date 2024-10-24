<?php
error_reporting(E_ALL ^ E_NOTICE);

$ROOT = dirname(__DIR__);

$composer = file_get_contents($ROOT . '/composer.json');
$composer = json_decode($composer, true);

$name = $composer['name'];
$ns_path = null;
$namespace = null;

$namespaces = $composer['autoload']['psr-4'];

foreach ($namespaces as $ns => $path) {
    echo "Is this the correct namespace? {$ns} [y/n]: ";
    $input = strtolower(trim(fgets(STDIN)));

    if (str_starts_with($input, 'y')) {
        $ns_path = $path;
        $namespace = trim($ns, '\\');
        break;
    }
}

if (!$ns_path) {
    echo "No namespace selected. Exiting.\n";
    exit(0);
}

echo "\n";
echo "Package name: {$name}\n";
echo "Selected namespace: {$namespace}\n";
echo "\n";

echo "Ready? [y/n]: ";
$input = strtolower(trim(fgets(STDIN)));

if (!str_starts_with($input, 'y')) {
    echo "Exiting.\n";
    exit(0);
}

echo "\n";

$iterator = new RecursiveDirectoryIterator($ns_path);
$iterator = new RecursiveIteratorIterator($iterator);

foreach ($iterator as $file) {
    if ($file->isDir()) continue;

    $path = $ROOT . '/' . $file->getPathname();
    $contents = file_get_contents($path);

    $replaces = [];
    $replaces['SproutModules\\Demo'] = $namespace;

    if (str_contains($contents, 'extends Module')) {
        $replaces['karmabunny/sprout-module'] = $name;
    }

    $processed = strtr($contents, $replaces);

    if ($processed !== $contents) {
        echo "Updated: {$file->getPathname()}\n";
        file_put_contents($path, $processed);
    }
}

echo "Done.\n";
exit(0);
