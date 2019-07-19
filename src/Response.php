<?php
/**
 * Simple natural language order decipherer.
 *
 * @package kebabble-order-parser
 * @author soup-bowl <code@soupbowl.io>
 * @license MIT
 */

namespace KOrderParser;

/**
 * Object class for orders.
 */
class Response
{
	/**
	 * The person in context.
	 *
	 * @var string|null
	 */
	protected $for;

	/**
	 * Extracted item.
	 *
	 * @var string|null
	 */
	protected $item;

	/**
	 * Whether or not they added or removed the item in context.
	 *
	 * @var string
	 */
	protected $operator;

	/**
	 * Default values.
	 */
	public function __construct()
	{
		$this->operator = 'add';
	}

	/**
	 * Gets the person this object represents.
	 *
	 * @return string|null
	 */
	public function getFor():?string
	{
		return $this->for;
	}

	/**
	 * Gets the item extracted from context.
	 *
	 * @return string|null
	 */
	public function getItem():?string
	{
		return $this->item;
	}

	/**
	 * Operation of context. Either 'add' or 'remove'.
	 *
	 * @return string
	 */
	public function getOperator():string
	{
		return $this->operator;
	}

	/**
	 * Sets the contextual person.
	 *
	 * @param string|null $for Name/alias.
	 * @return self
	 */
	public function setFor(?string $for):Response
	{
		$this->for = $for;

		return $this;
	}

	/**
	 * Sets the item.
	 *
	 * @param string|null $item Item.
	 * @return self
	 */
	public function setItem(?string $item):Response
	{
		$this->item = $item;

		return $this;
	}

	/**
	 * Sets the operator (must be 'add' or 'remove').
	 *
	 * @param string $operator Must be 'add' or 'remove'.
	 * @return self
	 */
	public function setOperator(string $operator):Response
	{
		$this->operator = $operator;

		return $this;
	}
}
