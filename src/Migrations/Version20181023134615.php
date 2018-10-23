<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181023134615 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE deals (id VARCHAR(255) NOT NULL, deal_name VARCHAR(255) NOT NULL, currency VARCHAR(255) NOT NULL, price NUMERIC(10, 2) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, productA_id VARCHAR(255) DEFAULT NULL, productB_id VARCHAR(255) DEFAULT NULL, INDEX IDX_EF39849B36A8B183 (productA_id), INDEX IDX_EF39849B241D1E6D (productB_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products (id VARCHAR(255) NOT NULL, product_name VARCHAR(255) NOT NULL, currency VARCHAR(255) NOT NULL, price NUMERIC(10, 2) NOT NULL, discount NUMERIC(10, 2) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE deals ADD CONSTRAINT FK_EF39849B36A8B183 FOREIGN KEY (productA_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE deals ADD CONSTRAINT FK_EF39849B241D1E6D FOREIGN KEY (productB_id) REFERENCES products (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE deals DROP FOREIGN KEY FK_EF39849B36A8B183');
        $this->addSql('ALTER TABLE deals DROP FOREIGN KEY FK_EF39849B241D1E6D');
        $this->addSql('DROP TABLE deals');
        $this->addSql('DROP TABLE products');
    }
}
