<?php

/*!
 * Log library
 * http://www.nunoserrano.com
 * Version 0.6
 *
 * Copyright 2017, Nuno Serrano
 * Released under the MIT license
 */

class Log
{
	private $logDir = '';
	private $logFile = '';
	private $logErrorFile = '';
	
	public function __construct($options = [])
	{
		global $argv;
		$this->logDir = (isset($options['logDir']))? $options['logDir']: dirname(dirname(realpath($argv[1]))) . '/logs/';
		$this->logFile = (isset($options['logFile']))? $options['logFile']: 'log.txt';
		$this->logErrorFile = (isset($options['logErrorFile']))? $options['logErrorFile']: 'logError.txt';
		
		if (!file_exists($this->logDir)) {
			mkdir($this->logDir, 0755, true);
		}
	}
	
	public function log($type, $message, $ok = true, $logfile = 'log') {
		$st_message =
				date('Ymd_His') .
				'_' . $type . '_' . (($ok) ? 'OK' : 'NOK') . ': ' . $message .
				"\r\n";
		
		if ($logfile == 'err') {
			file_put_contents($this->logDir . $this->logErrorFile, $st_message, FILE_APPEND);
		} else { //default - log file
			file_put_contents($this->logDir . $this->logFile, $st_message, FILE_APPEND);
		}
	}
	
	public static function logIt($type, $message, $ok = true, $logfile = 'log')
	{
		$log = new Log();
		$log->log($type, $message, $ok, $logfile);
	} 
	
}

class LogFactory
{
    public static function create($options = [])
    {
		global $argv;
        return new Log([
			'logDir' => (isset($options['logDir']))? $options['logDir']: dirname(dirname(realpath($argv[1]))) . '/logs/',
			'logFile' => (isset($options['logFile']))? $options['logFile']: 'log.txt',
			'logErrorFile' => (isset($options['logErrorFile']))? $options['logErrorFile']: 'logError.txt',
		]);
    }
	
}
