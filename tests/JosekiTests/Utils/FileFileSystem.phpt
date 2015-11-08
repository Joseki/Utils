<?php

namespace JosekiTests\Utils;

use Joseki\Utils\FileSystem;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

class FileSystemTest extends \Tester\TestCase
{

    public function testPath()
    {
        Assert::equal('one/two/three',FileSystem::normalizePath('one/two/three'));
        Assert::equal('C:/one/two/three',FileSystem::normalizePath('C:\one\two\three'));
        Assert::equal('/one/two/three/',FileSystem::normalizePath('/one//two///three/'));

        Assert::equal('/one/two/three/',FileSystem::normalizePath('/one/./two/././three/'));
        Assert::equal('/one/two/three/',FileSystem::normalizePath('/one/./two/foo/../three/'));
        Assert::equal('/one/two/three/',FileSystem::normalizePath('/one/two/foo/hi/./../bar/../../three/'));

        Assert::equal('one/two/three/..foo',FileSystem::normalizePath('one/two/three/..foo'));
    }

}

\run(new FileSystemTest());
