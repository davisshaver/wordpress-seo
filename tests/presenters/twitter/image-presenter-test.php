<?php

namespace Yoast\WP\Free\Tests\Presenters\Twitter;

use Mockery;
use Yoast\WP\Free\Helpers\Url_Helper;
use Yoast\WP\Free\Presentations\Indexable_Presentation;
use Yoast\WP\Free\Presenters\Twitter\Image_Presenter;
use Yoast\WP\Free\Tests\TestCase;
use Brain\Monkey;

/**
 * Class Image_Presenter_Test.
 *
 * @coversDefaultClass \Yoast\WP\Free\Presenters\Twitter\Image_Presenter
 *
 * @group presentations
 * @group twitter
 * @group twitter-image
 */
class Image_Presenter_Test extends TestCase {

	/**
	 * @var Url_Helper|Mockery\MockInterface
	 */
	private $url_helper;

	/**
	 * @var Image_Presenter
	 */
	private $instance;

	/**
	 * Sets an instance with the mocked url helper.
	 */
	public function setUp() {
		$this->url_helper = Mockery::mock( Url_Helper::class )->makePartial();
		$this->instance   = new Image_Presenter( $this->url_helper );

		parent::setUp();

		Monkey\Functions\expect( 'post_password_required' )->andReturn( false );
	}

	/**
	 * Tests the presentation of a relative image.
	 *
	 * @covers ::present
	 * @covers ::filter
	 */
	public function test_present() {
		$presentation = new Indexable_Presentation();
		$presentation->twitter_image = 'relative_image.jpg';

		$this->assertEquals(
			'<meta name="twitter:image" content="relative_image.jpg" />',
			$this->instance->present( $presentation )
		);
	}
}
