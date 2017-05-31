<?php

/*
 * This file is part of the Antvel Shop package.
 *
 * (c) Gustavo Ocanto <gustavoocanto@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Antvel\Tests\Unit\Products\Features;

use Antvel\Tests\TestCase;
use Antvel\Product\Parsers\FeaturesValidationRulesParser;

class FeaturesValidationRulesParserTest extends TestCase
{
	/** @test */
	function it_parses_the_feature_input_validation_rules()
	{
		$rules = FeaturesValidationRulesParser::parse([
			'name' => 'foo',
			'required' => 1,
			'max' => 20,
			'min' => 10
		]);

		$this->assertTrue(is_string($rules->toString()));
		$this->assertEquals('required|max:20|min:10', $rules->toString());
	}

	/** @test */
	function it_retrieves_the_feature_validations_rules()
	{
		$rules = FeaturesValidationRulesParser::decode('required|max:20|min:10');

		$this->assertTrue($rules->all()->contains('required'));
		$this->assertTrue($rules->all()->contains('max:20'));
		$this->assertTrue($rules->all()->contains('min:10'));
		$this->assertEquals('required|max:20|min:10', $rules->toString());
	}

	/** @test */
	function it_is_able_to_expose_the_allowed_validation_rules()
	{
		$allowed = FeaturesValidationRulesParser::allowed();

		$this->assertTrue($allowed->contains('required'));
		$this->assertTrue($allowed->contains('max'));
		$this->assertTrue($allowed->contains('min'));
		$this->assertTrue($allowed->count() > 0);
	}
}
