<?php

namespace CyberDuck\PardotApi\Query;

/**Prospects object representation
 *
 * @category   PardotApi
 * @package    PardotApi
 * @author     Andrew Mc Cormack <andy@cyber-duck.co.uk>
 * @copyright  Copyright (c) 2018, Andrew Mc Cormack
 * @license    https://github.com/cyber-duck/pardot-api/license
 * @version    1.0.0
 * @link       https://github.com/cyber-duck/pardot-api
 * @since      1.0.0
 */
class ProspectsQuery extends Query
{
	/**
	 * Object name
	 *
	 * @var string
	 */
	protected $object = 'prospect';

	/**
	 * Sends the request to retrieve the user object by email and returns it from the API
	 *
	 * /api/user/version/{version}/do/read/email/<email>?...
	 *
	 * required: user_key, api_key, email
	 *
	 * @param int $id
	 * @return stdClass|null
	 */
	public function readByEmail(string $email):? \stdClass
	{
		return $this->setOperator(sprintf('read/email/%s', $email))->request($this->object);
	}
}
