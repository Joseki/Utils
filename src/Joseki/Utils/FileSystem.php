<?php

namespace Joseki\Utils;

class FileSystem
{
    public static function normalizePath($path)
    {
        $path = str_replace('\\', '/', $path);
        $path = preg_replace('#/+#', '/', $path);
        $segments = explode('/', $path);
        $parts = [];
        foreach ($segments as $segment) {
            if ($segment != '.') {
                $test = array_pop($parts);
                if (is_null($test)) { // first element
                    $parts[] = $segment;
                } else if ($segment == '..') {
                    if ($test == '..') {
                        $parts[] = $test;
                    }

                    if ($test == '..' || $test == '') {
                        $parts[] = $segment;
                    }
                } else {
                    $parts[] = $test;
                    $parts[] = $segment;
                }
            }
        }
        return implode('/', $parts);
    }
}
