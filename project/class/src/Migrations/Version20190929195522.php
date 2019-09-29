<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190929195522 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        $class = $schema->createTable('app_class');
        $class->addColumn('id', 'integer', ['autoincrement' => true, 'notnull' => true, 'primary' => true]);
        $class->addColumn('name', 'string', ['notnull' => true, 'length' => 100]);
        $class->addColumn('active', 'boolean', ['notnull' => true]);
        $class->addColumn('creation_date', 'datetime', ['notnull' => true]);
        $class->setPrimaryKey(array('id'));
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) : void
    {
        $schema->dropTable('app_class');

    }
}
