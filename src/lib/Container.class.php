<?php

class Container extends AutoContainer
{
	/**
	 * @var BabyTrackerConfig
	 */
	private $config;

	public function __construct(BabyTrackerConfig $config)
	{
		$this->config = $config;
	}

	public function getBabyTrackerConfig()
	{
		return $this->config;
	}

	public function getSlimSlim()
	{
		return \Slim\Slim::getInstance();
	}

	public function getAutoContainer()
	{
		return $this;
	}

	public function getIWebRequest(\Slim\Http\Request $request)
	{
		return new WebRequest($request);
	}

	public function getIWebResponse(\Slim\Http\Response $httpResponse, \Slim\Slim $app)
	{
		return new WebResponse($httpResponse, $app);
	}
}
