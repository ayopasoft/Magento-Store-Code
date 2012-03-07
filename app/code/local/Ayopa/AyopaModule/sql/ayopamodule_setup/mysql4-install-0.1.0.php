 <?php

    $installer = $this;
 	$installer->startSetup();

    $installer->run("

    -- DROP TABLE IF EXISTS {$this->getTable('ayopamodule')};

    CREATE TABLE {$this->getTable('ayopamodule/ayopamodule')} (
      `id` int(11) unsigned NOT NULL auto_increment,
      `auctionid` varchar(255) NOT NULL default '',
      `buyerid` varchar(255) NOT NULL default '',
      `quantity` smallint(6) NOT NULL default '0',
	  `price` varchar(255) NOT NULL default '0',
	  `verification` varchar(255) NULL,
      PRIMARY KEY (`id`)
      );

    ");

    $installer->endSetup();