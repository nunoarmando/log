<?php

namespace naas\log;

/*!
 * Log library
 * http://www.nunoserrano.com
 * Version 0.1
 *
 * Copyright 2017, Nuno Serrano
 * Released under the MIT license
 */

class Log
{
	private $logDir = '';
	private $logFile = '';
	private $logErrorFile = '';
	
	public function __construct($options)
	{
		$this->logDir = (isset($options['logDir']))? $options['logDir']: dirname(__DIR__) . '/logs/';
		$this->logFile = (isset($options['logFile']))? $options['logFile']: 'log.txt';
		$this->logErrorFile = (isset($options['logErrorFile']))? $options['logErrorFile']: 'logError.txt';
		
		if (!file_exists($this->logDir)) {
			mkdir($this->logDir, 0755, true);
		}
	}
	
	public function logIt($type, $message, $ok = true, $logfile = 'log') {
		$st_message =
				date('Ymd_His') .
				'_' . $type . '_' . (($ok) ? 'OK' : 'NOK') . ': ' . $message .
				"\r\n";
		
		if ($logfile == 'err') {
			file_put_contents(self::$logDir . self::$logErrorFile, $st_message, FILE_APPEND);
		} else { //default - log file
			file_put_contents(self::$logDir . self::$logFile, $st_message, FILE_APPEND);
		}
	}
	
	public static function logIt($type, $message, $ok = true, $logfile = 'log')
	{
		$log = LogFactory::create();
		$log->logIt($type, $message, $ok, $logfile);
	} 
	
}

class LogFactory
{
    public static function create($options = [])
    {
        return new Log([
			'logDir' => (isset($options['logDir']))? $options['logDir']: dirname(__DIR__) . '/logs/',
			'logFile' => (isset($options['logFile']))? $options['logFile']: 'log.txt',
			'logErrorFile' => (isset($options['logErrorFile']))? $options['logErrorFile']: 'logError.txt',
		]);
    }
	
}
