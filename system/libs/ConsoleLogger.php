<?php
class ConsoleLogger {
    public static function log($data) {
        if (is_array($data) || is_object($data)) {
            $data = json_encode($data);
        }
        echo "<script>console.log('PHP:', " . json_encode($data) . ");</script>";
    }
}
?> 