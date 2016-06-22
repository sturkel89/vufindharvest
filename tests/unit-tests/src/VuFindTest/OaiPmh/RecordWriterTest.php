<?php

/**
 * OAI-PMH record writer unit test.
 *
 * PHP version 5
 *
 * Copyright (C) Villanova University 2016.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License version 2,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * @category VuFind
 * @package  Tests
 * @author   Demian Katz <demian.katz@villanova.edu>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     https://vufind.org/wiki/development
 */
namespace VuFindTest\Harvest\OaiPmh;

use VuFindHarvest\OaiPmh\RecordWriter, VuFindHarvest\OaiPmh\RecordXmlFormatter;

/**
 * OAI-PMH record writer unit test.
 *
 * @category VuFind
 * @package  Tests
 * @author   Demian Katz <demian.katz@villanova.edu>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     https://vufind.org/wiki/development
 */
class RecordWriterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Return protected or private property.
     *
     * Uses PHP's reflection API in order to modify property accessibility.
     *
     * @param object|string $object   Object or class name
     * @param string        $property Property name
     *
     * @throws \ReflectionException Property does not exist
     *
     * @return mixed
     */
    protected function getProperty($object, $property)
    {
        $reflectionProperty = new \ReflectionProperty($object, $property);
        $reflectionProperty->setAccessible(true);
        return $reflectionProperty->getValue($object);
    }

    /**
     * Test configuration.
     *
     * @return void
     */
    public function testConfig()
    {
        $config = [
            'idPrefix' => 'fakeidprefix',
            'idSearch' => 'search',
            'idReplace' => 'replace',
            'harvestedIdLog' => '/my/harvest.log',
        ];
        $oai = new RecordWriter(
            $this->getMock(
                'VuFindHarvest\RecordWriterStrategy\RecordWriterStrategyInterface'
            ), $this->getMock('VuFindHarvest\OaiPmh\RecordXmlFormatter'), $config
        );

        // Generic case for remaining configs:
        foreach ($config as $key => $value) {
            $this->assertEquals($value, $this->getProperty($oai, $key));
        }
    }
}