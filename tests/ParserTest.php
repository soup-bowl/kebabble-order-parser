<?php
/**
 * Simple natural language order decipherer.
 *
 * @package kebabble-order-parser
 * @author soup-bowl <code@soupbowl.io>
 * @license MIT
 */

namespace KOrderParserTest;

use PHPUnit\Framework\TestCase;

use KOrderParser\parser;

class ParserTest extends TestCase
{
	/**
	 * Test subject.
	 *
	 * @var parser
	 */
	protected $parser;

	/**
	 * Test class constructor.
	 */
	public function setUp():void
	{
		$this->parser = new parser();
	}

	/**
	 * Rudimentary tests to see if basic operation works.
	 */
	public function testCorrectOrderDetermination()
	{
		$food_items = [
			'Large Food Roll',
			'Food Roll',
			'Medium Food Roll',
			'Drink',
		];

		$response = $this->parser->decipherOrder('Please sir, may I have a food roll?', $food_items);
		$this->assertTrue(isset($response));
		$this->assertEquals($response->getItem(), 'Food Roll');
		$this->assertEquals($response->getOperator(), 'add');

		$response = $this->parser->decipherOrder('remove my fOod ROLL please!', $food_items);
		$this->assertTrue(isset($response));
		$this->assertEquals($response->getItem(), 'Food Roll');
		$this->assertEquals($response->getOperator(), 'remove');

		$response = $this->parser->decipherOrder('can I get a large food roll?', $food_items);
		$this->assertTrue(isset($response));
		$this->assertEquals($response->getItem(), 'Large Food Roll');
		$this->assertEquals($response->getOperator(), 'add');

		$response = $this->parser->decipherOrder('This string is invalid!', $food_items);
		$this->assertNull($response);
	}
}
