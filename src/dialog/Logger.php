<?php

namespace Dialog;

use Monolog\DateTimeImmutable;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class Logger implements LoggerInterface
{
    private string $savePath;
    private string $name;
    private bool $microsecondTimestamps = true;
    protected $timezone;

    public function __construct($name, $savePath)
    {
        $this->name = $name;
        $this->savePath = $savePath;
    }

    public function emergency($message, array $context = null)
    {
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    public function alert($message, array $context = null)
    {
        $this->log(LogLevel::ALERT, $message, $context);
    }

    public function critical($message, array $context = null)
    {
        $this->log(LogLevel::CRITICAL, $message, $context);
    }

    public function error($message, array $context = null)
    {
        $this->log(LogLevel::ERROR, $message, $context);
    }

    public function warning($message, array $context = null)
    {
        $this->log(LogLevel::WARNING, $message, $context);
    }

    public function notice($message, array $context = null)
    {
        $this->log(LogLevel::NOTICE, $message, $context);
    }

    public function info($message, array $context = null)
    {
        $this->log(LogLevel::INFO, $message, $context);
    }

    public function debug($message, array $context = null)
    {
        $this->log(LogLevel::DEBUG, $message, $context);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function getSavePath(): string
    {
        return $this->savePath;
    }

    /**
     * @param mixed $level
     * @param string $message
     * @param array|null $context
     * @return bool
     * @throws \Exception
     */
    public function log($level, $message, array $context = null): bool
    {
        $path = $this->getSavePath();
        $msg = "LOGGER NAME:\t" . $this->getName() . "\n" .
            "LOG LEVEL:\t" . $level . "\n" .
            "LOG MESSAGE:\t" . $message . "\n" .
            "LOG CONTEXT:\t" . implode(', ', $context) . "\n" .
            "LOG TIME:\t" . new DateTimeImmutable($this->microsecondTimestamps, $this->timezone) . "\n\n";
        fopen($path, "a+");
        if (file_exists($path)) {
            file_put_contents($path, $msg, FILE_APPEND);
        }
    }
}
