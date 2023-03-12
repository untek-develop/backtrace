<?php

namespace Untek\Develop\Backtrace;

use axy\backtrace\helpers\Represent;
use axy\backtrace\Trace;

class DebugBacktrace
{

    private const BEGIN = "\n\n---------------- Debug backtrace ----------------\n\n";
    private const END = "\n\n---------------- Debug backtrace ----------------\n\n";

    public static function dump(int $limit = null): void
    {
        $items = debug_backtrace();
        array_shift($items);
        $trace = new Trace($items);
        if ($limit) {
            $trace->truncateByLimit($limit);
        }
        $rootDirectory = getenv('ROOT_DIRECTORY');
        if($rootDirectory) {
            $trace->trimFilename($rootDirectory);
        }
        $out = Represent::trace($trace->getItems());
        $out = trim($out);
        echo(self::BEGIN . $out . self::END);
    }
}
