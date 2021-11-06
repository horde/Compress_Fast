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
 * The lz4 driver uses the horde_lz4 extension for compression.
 *
 * @author    Michael Slusarz <slusarz@horde.org>
 * @category  Horde
 * @copyright 2013-2017 Horde LLC
 * @license   http://www.horde.org/licenses/lgpl21 LGPL 2.1
 * @package   Compress_Fast
 */
class Lz4Driver extends BaseDriver
{
    /**
     * @inheritDoc
     */
    public static function supported(): bool
    {
        return extension_loaded('horde_lz4');
    }

    /**
     * @inheritDoc
     */
    public function compress(string $text): string
    {
        return strlen($text)
            ? horde_lz4_compress($text)
            : '';
    }

    /**
     * @inheritDoc
     */
    public function decompress(string $text): string
    {
        return strlen($text)
            ? @horde_lz4_uncompress($text)
            : '';
    }
}
