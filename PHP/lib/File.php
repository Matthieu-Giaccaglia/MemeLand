<?php

class File {

    public static function build_path($segments) {
        return __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR
                . join(DIRECTORY_SEPARATOR, $segments);
    }
}

?>