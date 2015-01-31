<?php namespace Vinkla\Tests\Vimeo;

use GrahamCampbell\TestBench\Traits\ServiceProviderTestCaseTrait;

class ServiceProviderTest extends AbstractTestCase {

	use ServiceProviderTestCaseTrait;

	public function testVimeoFactoryIsInjectable()
	{
		$this->assertIsInjectable('Vinkla\Vimeo\Factories\VimeoFactory');
	}

	public function testVimeoManagerIsInjectable()
	{
		$this->assertIsInjectable('Vinkla\Vimeo\VimeoManager');
	}

}
