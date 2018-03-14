
#---------------------------------------------------------------------- /cp/install?time=first_time
---2017-06-06 01:48:41
	---0.3134880065918s		---313ms
--- CHECK!
	ALTER TABLE `logitems` CHANGE `logitem_meta` `logitem_meta` MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL

#---------------------------------------------------------------------- /cp/install?time=first_time
---2017-06-06 01:48:45
	---0.22316718101501s		---223ms
--- CHECK!
	ALTER TABLE `passwords` CHANGE `substatus` `substatus` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL
