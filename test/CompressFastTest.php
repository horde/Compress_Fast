<?php

/**
 * @category   Horde
 * @package    Compress_Fast
 * @subpackage UnitTests
 */

namespace Horde\Compress\Fast\Test;

use Horde\Test\TestCase;
use stdClass;
use Horde\Compress\Fast\CompressFast;
use Horde\Compress\Fast\NullDriver;
use Horde\Compress\Fast\CompressFastException;
use TypeError;

/**
 * @category   Horde
 * @package    Compress_Fast
 * @subpackage UnitTests
 * @coversNothing
 */
class CompressFastTest extends TestCase
{
    /**
     * @dataProvider providerTestStringInput
     */
    public function testStringInput($data, $success)
    {
        $ob = new CompressFast([
            'drivers' => [
                NullDriver::class,
            ],
        ]);

        //        $this->expectException(CompressFastException::class);
        if (!$success) {
            $this->expectException(TypeError::class);
        }
        $ob->compress($data);
        if ($success) {
            $this->markTestIncomplete();
        }
    }

    public function providerTestStringInput()
    {
        // Format: data, expected success
        return [
            ['a', true],
            [0.1, true],
            [1, true],
            [true, true],
            [null, false],
            [[], false],
            [new stdClass(), false],
            [opendir(__DIR__), false],
        ];
    }

}
