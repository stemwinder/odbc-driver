<?php namespace Foundation\Database\Driver;

require_once('Grammars/DB2.php');
require_once('Processors/DB2Processor.php');

use Illuminate\Database\Connection;
use Illuminate\Database\Query\Grammars\Grammar as IllGrammar;
use Illuminate\Database\Schema\Grammars\Grammar as SchemaGrammar;
use Foundation\Database\Driver\Grammars\DB2 as DB2Grammar;
use Foundation\Database\Driver\Processors\DB2Processor;


class ODBCDriverConnection extends Connection
{
	/**
	 * @return Query\Grammars\Grammar
	 */
	protected function getDefaultQueryGrammar()
	{
		$grammarConfig = $this->getGrammarConfig();

		if ($grammarConfig) {
			$packageGrammar = "Foundation\\Database\\Driver\\Grammars\\" . $grammarConfig; 
			if (class_exists($packageGrammar)) {
				return $this->withTablePrefix(new $packageGrammar);
			}
			
			$illuminateGrammar = "IllGrammar\\" . $grammarConfig;
			if (class_exists($illuminateGrammar)) {
				return $this->withTablePrefix(new $illuminateGrammar);
			}
		}

		return $this->withTablePrefix(new DB2Grammar);
	}

	/**
	 * Default grammar for specified Schema
	 * @return Schema\Grammars\Grammar
	 */
	protected function getDefaultSchemaGrammar()
	{
		return $this->withTablePrefix(new DB2Grammar);
	}

	protected function getGrammarConfig()
	{
		if ($this->getConfig('grammar')) {
			return $this->getConfig('grammar');
		}

		return false;
	}

	/**
	 * Get the default post processor instance.
	 *
	 * TODO: Refactor into dedicated DB2Connection file.
	 *
	 * @return \Illuminate\Database\Query\Processors\Processor
	 */
	protected function getDefaultPostProcessor()
	{
		return new DB2Processor;
	}
}
