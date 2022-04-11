#
# Table structure for table 'sys_file_metadata'
#
CREATE TABLE sys_file_metadata
(
    tx_arcfal_transcript longtext,
);

#
# Table structure for table 'sys_file_reference'
#
CREATE TABLE sys_file_reference
(
    tx_arcfal_loop  tinyint(1) unsigned DEFAULT '0' NOT NULL,
    tx_arcfal_muted tinyint(1) unsigned DEFAULT '0' NOT NULL,
);
