<?php
$installer = $this;
$installer->startSetup();

$sql=<<<SQLTEXT

CREATE TABLE IF NOT EXISTS {$installer->getTable('pswidget/pswidgetlang')} (
  id int(11) NOT NULL AUTO_INCREMENT,
  id_widget int(11) NOT NULL,
  id_lang int(11) NOT NULL,
  submit_text text DEFAULT NULL,
  note_add_pics_text text DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AVG_ROW_LENGTH = 4096
CHARACTER SET utf8
COLLATE utf8_general_ci;

SQLTEXT;

$installer->run($sql);
$installer->endSetup();
