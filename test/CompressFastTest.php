<?php
/**
 * @category   Horde
 * @package    Compress_Fast
 * @subpackage UnitTests
 */
namespace Horde\Compress\Fast\Test;
use Horde\Test\TestCase;
use \stdClass;
use \Horde\Compress\Fast\CompressFast;
use \Horde\Compress\Fast\NullDriver;
use \Horde\Compress\Fast\CompressFastException;
use \TypeError;
/**
 * @category   Horde
 * @package    Compress_Fast
 * @subpackage UnitTests
 */
class CompressFastTest extends TestCase
{
    /**
     * @dataProvider providerTestStringInput
     */
    public function testStringInput($data, $success)
    {
        $ob = new CompressFast(array(
            'drivers' => array(
                NullDriver::class
            )
        ));

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
        return array(
            array('a', true),
            array(0.1, true),
            array(1, true),
            array(true, true),
            array(null, false),
            array(array(), false),
            array(new stdClass, false),
            array(opendir(__DIR__), false)
        );
    }

}
