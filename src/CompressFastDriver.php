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
 * Abstract base driver class for fast compression.
 *
 * @author    Michael Slusarz <slusarz@horde.org>
 * @category  Horde
 * @copyright 2013-2017 Horde LLC
 * @license   http://www.horde.org/licenses/lgpl21 LGPL 2.1
 * @package   Compress_Fast
 */
interface CompressFastDriver
{
    /**
     * Is this driver supported on this system?
     *
     * @return bool  True if supported.
     */
    public static function supported(): bool;

    /**
     * Compresses a string.
     *
     * @param string $text  The string to compress.
     *
     * @return string  The compressed string.
     * @throws CompressFastException
     */
    public function compress(string $text): string;

    /**
     * Decompresses a string.
     *
     * @param string $text  The compressed string.
     *
     * @return string  The decompressed string.
     * @throws CompressFastException
     */
    public function decompress(string $text): string;
}
