<?php

use Vimeo\Vimeo;

class VimeoTest extends PHPUnit_Framework_TestCase {

	protected $vimeo;

	private $clientId = 'myawesomestring';

	private $clientSecret = 'myawesomestring';

	public function setUp()
	{
		$this->vimeo = new Vimeo(
			$this->clientId,
			$this->clientSecret
		);
	}

	public function testThatVimeoIsInitiated()
	{
		$this->assertInstanceOf('Vimeo\Vimeo', $this->vimeo);
	}

	/**
	 * @expectedException Vimeo\Exceptions\VimeoUploadException
	 */
	public function testUploadException()
	{
		$this->vimeo->upload('myfile.mp4');
	}

}
