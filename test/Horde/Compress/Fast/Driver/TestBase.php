<?php
/**
 * @category   Horde
 * @package    Compress_Fast
 * @subpackage UnitTests
 */
namespace Horde\Compress\Fast\Driver;
use Horde_Test_Case as TestCase;
use \Horde_Compress_Fast;
use \stdClass;

/**
 * @category   Horde
 * @package    Compress_Fast
 * @subpackage UnitTests
 */
class TestBase extends TestCase
{
    protected $classname;

    private $compress_text = 'Foo Foo Foo Foo Foo Foo Foo Foo Foo Foo';
    private $ob;

    protected function setUp(): void
    {
        if (!call_user_func(array($this->classname, 'supported'))) {
            $this->markTestSkipped(
                sprintf('Driver %s is not available.', $this->classname)
            );
        }

        $this->ob = new Horde_Compress_Fast(array(
            'drivers' => array($this->classname)
        ));
    }

    public function testCompress()
    {
        $data = $this->ob->decompress(
            $this->ob->compress($this->compress_text)
        );

        $this->assertEquals(
            $this->compress_text,
            $data
        );
    }

    /**
     * @expectedException Horde_Compress_Fast_Exception
     */
    public function testBadCompress()
    {
        $this->expectException('Horde_Compress_Fast_Exception');
        $this->ob->compress(array());
    }

    /**
     * @expectedException Horde_Compress_Fast_Exception
     */
    public function testBadDecompress()
    {
        $this->expectException('Horde_Compress_Fast_Exception');
        $this->ob->decompress(new stdClass);
    }

}
