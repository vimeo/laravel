<?php

namespace Vinkla\Vimeo;

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;
use Vinkla\Vimeo\Factories\VimeoFactory;

class VimeoManager extends AbstractManager
{
	/**
	 * @var VimeoFactory
	 */
	private $factory;

	/**
	 * @param Repository $config
	 * @param VimeoFactory $factory
	 */
	function __construct(Repository $config, VimeoFactory $factory)
	{
		parent::__construct($config);

		$this->factory = $factory;
	}

	/**
	 * Create the connection instance.
	 *
	 * @param array $config
	 *
	 * @return mixed
	 */
	protected function createConnection(array $config)
	{
		return $this->factory->make($config);
	}

	/**
	 * Get the configuration name.
	 *
	 * @return string
	 */
	protected function getConfigName()
	{
		return 'vimeo';
	}

	/**
	 * Get the factory instance.
	 *
	 * @return VimeoFactory
	 */
	public function getFactory()
	{
		return $this->factory;
	}
}
