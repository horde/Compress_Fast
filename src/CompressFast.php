<?php
/**
 * Copyright 2013-2017 Horde LLC (http://www.horde.org/)
 *
 * See the enclosed file LICENSE for license information (LGPL). If you
 * did not receive this file, see http://www.horde.org/licenses/lgpl21.
 *
 * @author   Michael Slusarz <slusarz@horde.org>
 * @category Horde
 * @license  http://www.horde.org/licenses/lgpl21 LGPL 2.1
 * @package  Compress_Fast
 */

namespace Horde\Compress\Fast;

/**
 * Provides fast compression of strings using the best-available algorithm.
 *
 * @author    Michael Slusarz <slusarz@horde.org>
 * @category  Horde
 * @copyright 2013-2017 Horde LLC
 * @license   http://www.horde.org/licenses/lgpl21 LGPL 2.1
 * @package   Compress_Fast
 *
 * @property string $driver  Returns the name of the compression driver used.
 */
class CompressFast
{
    /**
     * Compression driver
     *
     * @var CompressFastDriver
     */
    protected CompressFastDriver $compress;

    /**
     * Constructor.
     *
     * @param array $opts  Options:
     * <pre>
     *   - drivers: (array) A list of driver names (Horde_Compress_Fast_Base
     *              class names) to use instead of auto-detecting.
     *   - zlib: (bool) Consider zlib to be a "fast" compression algorithm.
     *           Only used if 'drivers' is empty. (@since 1.1.0).
     * </pre>
     *
     * @throws CompressFastException
     */
    public function __construct(array $opts = [])
    {
        if (empty($opts['drivers'])) {
            $opts['drivers'] = [
                Lz4Driver::class,
                LzfDriver::class,
                NullDriver::class,
            ];
            if (!empty($opts['zlib'])) {
                array_unshift($opts['drivers'], ZlibDriver::class);
            }
        }

        foreach ($opts['drivers'] as $val) {
            if (($ob = new $val()) &&
                ($ob instanceof CompressFastDriver) &&
                $val::supported()) {
                $this->compress = $ob;
                break;
            }
        }

        if (!isset($this->compress)) {
            throw new CompressFastException('Could not load a valid compression driver.');
        }
    }

    /**
     */
    public function __get($name)
    {
        switch ($name) {
        case 'driver':
            return get_class($this->compress);
        }
    }

    /**
     * Compresses a string.
     *
     * @param string $text  The string to compress.
     *
     * @return string  The compressed string.
     * @throws CompressFastException
     */
    public function compress(string $text): string
    {
        if (!is_scalar($text) && !is_null($text)) {
            throw new CompressFastException('Data to compress must be a string.');
        }

        return $this->compress->compress(strval($text));
    }

    /**
     * Decompresses a string.
     *
     * @param string $text  The compressed string.
     *
     * @return string  The decompressed string.
     * @throws CompressFastException
     */
    public function decompress(string $text): string
    {
        if (!is_scalar($text) && !is_null($text)) {
            throw new CompressFastException('Data to decompress must be a string.');
        }

        return $this->compress->decompress(strval($text));
    }
}
