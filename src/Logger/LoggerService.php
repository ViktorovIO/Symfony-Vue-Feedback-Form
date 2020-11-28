<?php

namespace App\Logger;

class LoggerService
{
    public const LOG_FILE = 'log.txt';

    public function write(array $data): bool
    {
        if ( ! is_writable(self::LOG_FILE)) {
            return false;
        }
        
        $logMessage = 'New feedback: \n';
        $logMessage .= 'id: ' . $data['id'];
        $logMessage .= 'name: ' . $data['name'];
        $logMessage .= 'phone: ' . $data['phone'];
        $logMessage .= 'message: ' . $data['message'];

        $fp = fopen(self::LOG_FILE, 'w');
        fwrite($fp, $logMessage);
        fclose($fp);

        return true;
    }
}