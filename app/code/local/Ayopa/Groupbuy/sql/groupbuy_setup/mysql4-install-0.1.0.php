 
    <?php
 
     
 
    $installer = $this;
 
     
 
    $installer->startSetup();
 
     
 
    $installer->run("
 
     
 
    -- DROP TABLE IF EXISTS {$this->getTable('groupbuy')};

    CREATE TABLE {$this->getTable('groupbuy')} (

      `groupbuy_id` int(11) unsigned NOT NULL auto_increment,

      `email` varchar(255) NOT NULL default '',

      PRIMARY KEY (`groupbuy_id`)

    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

     

        ");

     

    $installer->endSetup();