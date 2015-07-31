<?php

class BabyTrackerDatabaseFactory
	extends BaseDatabaseFactory
{
	public function __construct(BabyTrackerConfig $config)
	{
		parent::__construct(
			  $config->dbHostname
			, $config->dbDatabase
			, $config->dbUsername
			, $config->dbPassword
		);
	}
}
