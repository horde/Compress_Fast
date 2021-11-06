<?php
/**
 * @category   Horde
 * @package    Compress_Fast
 * @subpackage UnitTests
 */
namespace Horde\Compress\Fast\Test\Driver;
use Horde\Test\TestCase;
use \Horde\Compress\Fast\CompressFast;
use Horde\Compress\Fast\CompressFastException;
use \stdClass;
use TypeError;

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
        if (!$this->classname::supported()) {
            $this->markTestSkipped(
                sprintf('Driver %s is not available.', $this->classname)
            );
        }

        $this->ob = new CompressFast(array(
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

    public function testBadCompress()
    {
        $this->expectException(TypeError::class);
        $this->ob->compress(array());
    }

    public function testBadDecompress()
    {
        $this->expectException(TypeError::class);
        $this->ob->decompress(new stdClass);
    }

}
