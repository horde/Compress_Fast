<?php
/**
 * @category   Horde
 * @package    Compress_Fast
 * @subpackage UnitTests
 */
namespace Horde\Compress\Fast;
use Horde_Test_Case;
use \stdClass;
use \Horde_Compress_Fast;

/**
 * @category   Horde
 * @package    Compress_Fast
 * @subpackage UnitTests
 */
class CompressFastTest extends Horde_Test_Case
{
    /**
     * @dataProvider providerTestStringInput
     */
    public function testStringInput($data, $success)
    {
        $ob = new Horde_Compress_Fast(array(
            'drivers' => array(
                'Horde_Compress_Fast_Null'
            )
        ));

        $this->expectException('Horde_Compress_Fast_Exception');
        $ob->compress($data);
        if (!$success) {
            $this->expectException('Horde_Compress_Fast_Exception');
        }
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
            array(null, true),
            array(array(), false),
            array(new stdClass, false),
            array(opendir(__DIR__), false)
        );
    }

}
