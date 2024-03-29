#
# Table structure for table 'sys_file_metadata'
#
CREATE TABLE sys_file_metadata
(
    tx_arcfal_transcript longtext,
    tx_arcfal_transcript_rte longtext,
    tx_arcfal_flipbook_url text,
);

#
# Table structure for table 'sys_file_reference'
#
CREATE TABLE sys_file_reference
(
    tx_arcfal_loop  tinyint(1) unsigned DEFAULT '0' NOT NULL,
    tx_arcfal_muted tinyint(1) unsigned DEFAULT '0' NOT NULL,
    tx_arcfal_force_image_render tinyint(1) unsigned DEFAULT '0' NOT NULL,
);
