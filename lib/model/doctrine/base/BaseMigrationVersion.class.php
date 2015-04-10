<?php
/*
 * Copyright (c) 2015, webvariants GmbH & Co. KG, http://www.webvariants.de
 *
 * This file is released under the terms of the MIT license. You can find the
 * complete text in the attached LICENSE file or online at:
 *
 * http://www.opensource.org/licenses/mit-license.php
 */

/**
 * BaseMigrationVersion
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @property integer $version
 *
 * @method integer          getVersion() Returns the current record's "version" value
 * @method MigrationVersion setVersion() Sets the current record's "version" value
 *
 * @package    policat
 * @subpackage model
 * @author     Martin
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseMigrationVersion extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('migration_version');
        $this->hasColumn('version', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();

    }
}
