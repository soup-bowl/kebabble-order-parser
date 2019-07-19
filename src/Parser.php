<?php
/**
 * Simple natural language order decipherer.
 *
 * @package kebabble-order-parser
 * @author soup-bowl <code@soupbowl.io>
 * @license MIT
 */

namespace KOrderParser;

use KOrderParser\Response;

/**
 * Functions devoted to deciphering user orders.
 */
class Parser
{
	/**
	 * Deciphers the input string into orders.
	 *
	 * @param string $segment    The natural language string to be parsed.
	 * @param array  $potentials Items present on the menu (will match up exact).
	 * @return Response|null
	 */
	public function decipherOrder(string $segment, array $potentials):?Response
	{
		$response = new Response();

		$segment_split       = explode(' ', $segment);
		$segment_split_count = count($segment_split);

		// Sort into length order.
		usort(
			$potentials,
			function ($a, $b) {
				return strlen($a) <=> strlen($b);
			}
		);

		// Attempt to work out the item.
		foreach ($potentials as $potential) {
			if (strpos(strtolower($segment), strtolower($potential)) !== false) {
				$response->setItem($potential);
			}
		}

		// now for the operator, and if this is for someone else.
		for ($i = 0; $i < $segment_split_count; $i++) {
			switch ($segment_split[ $i ]) {
				case 'no':
				case 'delete':
				case 'remove':
				case 'x':
				case '-':
					$response->setOperator('remove');
					break;
				case 'for':
					$for_person = ucfirst($segment_split[ ( $i + 1 ) ]);
					if (false !== strpos($for_person, '@')) {
						return null;
					} else {
						$response->setFor($for_person);
					}
					break;
			}
		}

		if ($response->getItem() !== null) {
			return $response;
		} else {
			return null;
		}
	}
}
