<?php namespace Foundation\Database\Driver\Processors;

use Illuminate\Database\Query\Processors\Processor;
use Illuminate\Database\Query\Builder;

class DB2Processor extends Processor {

	/**
	 * Process an "insert get ID" query.
	 *
	 * @param  \Illuminate\Database\Query\Builder  $query
	 * @param  string  $sql
	 * @param  array   $values
	 * @param  string  $sequence
	 * @return int
	 */
	public function processInsertGetId(Builder $query, $sql, $values, $sequence = null)
	{
		$query->getConnection()->insert($sql, $values);

		return -1;
	}

}
