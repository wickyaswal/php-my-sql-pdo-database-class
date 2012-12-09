<?php 
       /* *
	* Log 			A logger class which creates logs when an exception is thrown.
	* @author		Author: Vivek Wicky Aswal. (https://twitter.com/#!/VivekWickyAswal)
	* @git 			https://github.com/indieteq-vivek/PHP-MySQL-PDO-Database-Class
	* @version      0.1a
	*/
	class Log {
			
		    # @string, Log directory name
		    	private $path = '/logs/';
			
		    # @void, Default Constructor, Sets the timezone and path of the log files.
			public function __construct() {
				date_default_timezone_set('Europe/Amsterdam');	
				$this->path  = dirname(__FILE__)  . $this->path;	
			}
			
		   /**
		    *   @void 
		    *	Creates the log
		    *
		    *   @param string $message the message which is written into the log.
		    *	@description:
		    *	 1. Checks if directory exists, if not, create one and call this method again.
	            *	 2. Checks if log already exists.
		    *	 3. If not, new log gets created. Log is written into the logs folder.
		    *	 4. Logname is current date(Year - Month - Day).
		    *	 5. If log exists, edit method called.
		    *	 6. Edit method modifies the current log.
		    */	
			public function write($message) {
				$date = new DateTime();
				$log = $this->path . $date->format('Y-m-d').".txt";

				if(is_dir($this->path)) {
					if(!file_exists($log)) {
						$fh  = fopen($log, 'a+') or die("Fatal Error !");
						$logcontent = "Time : " . $date->format('H:i:s')."\r\n" . $message ."\r\n";
						fwrite($fh, $logcontent);
						fclose($fh);
					}
					else {
						$this->edit($log,$date, $message);
					}
				}
				else {
					  if(mkdir($this->path,0777) === true) 
					  {
 						 $this->write($message);  
					  }	
				}
			 }
			
			/** 
			 *  @void
			 *  Gets called if log exists. 
			 *  Modifies current log and adds the message to the log.
			 *
			 * @param string $log
			 * @param DateTimeObject $date
			 * @param string $message
			 */
			    private function edit($log,$date,$message) {
				$logcontent = "Time : " . $date->format('H:i:s')."\r\n" . $message ."\r\n\r\n";
				$logcontent = $logcontent . file_get_contents($log);
				file_put_contents($log, $logcontent);
			    }
		}
?>