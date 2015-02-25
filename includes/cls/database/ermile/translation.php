<?php
function transtext()
{

	// ------------------------------------------------------------------- Table accounts
	echo T_("accounts");            // Table accounts
	echo T_("Accounts");            // Accounts
	echo T_("account");             // accounts
	echo T_("Id");                  // id
	echo T_("Title");               // account_title
	echo T_("Slug");                // account_slug
	echo T_("Bank");                // bank_id
	echo T_("Branch");              // account_branch
	echo T_("Number");              // account_number
	echo T_("Card");                // account_card
	echo T_("Primarybalance");      // account_primarybalance
	echo T_("Desc");                // account_desc
	echo T_("User");                // user_id
	echo T_("Modified");            // date_modified
	echo T_("enable");              // Enum enable
	echo T_("disable");             // Enum disable
	echo T_("expire");              // Enum expire
	echo T_("goingtoexpire");       // Enum goingtoexpire

	// ------------------------------------------------------------------- Table addons
	echo T_("addons");              // Table addons
	echo T_("Addons");              // Addons
	echo T_("addon");               // addons
	echo T_("Name");                // addon_name
	echo T_("Slug");                // addon_slug
	echo T_("Desc");                // addon_desc
	echo T_("Status");              // addon_status
	echo T_("Expire");              // addon_expire
	echo T_("Installdate");         // addon_installdate

	// ------------------------------------------------------------------- Table attachmentmetas
	echo T_("attachmentmetas");     // Table attachmentmetas
	echo T_("Attachmentmetas");     // Attachmentmetas
	echo T_("attachmentmeta");      // attachmentmetas
	echo T_("Attachment");          // attachment_id
	echo T_("Cat");                 // attachmentmeta_cat
	echo T_("Name");                // attachmentmeta_name
	echo T_("Value");               // attachmentmeta_value
	echo T_("Status");              // attachmentmeta_status
	echo T_("productcategory");     // Enum productcategory
	echo T_("product");             // Enum product
	echo T_("admin");               // Enum admin
	echo T_("banklogo");            // Enum banklogo
	echo T_("post");                // Enum post
	echo T_("system");              // Enum system
	echo T_("other");               // Enum other
	echo T_("file");                // Enum file
	echo T_("folder");              // Enum folder
	echo T_("normal");              // Enum normal
	echo T_("trash");               // Enum trash
	echo T_("deleted");             // Enum deleted
	echo T_("inprogress");          // Enum inprogress

	// ------------------------------------------------------------------- Table attachments
	echo T_("attachments");         // Table attachments
	echo T_("Attachments");         // Attachments
	echo T_("attachment");          // attachments
	echo T_("File");                // file_id
	echo T_("Title");               // attachment_title
	echo T_("Type");                // attachment_type
	echo T_("Addr");                // attachment_addr
	echo T_("Name");                // attachment_name
	echo T_("Ext");                 // attachment_ext
	echo T_("Size");                // attachment_size
	echo T_("Desc");                // attachment_desc
	echo T_("Parent");              // attachment_parent
	echo T_("Depth");               // attachment_depth
	echo T_("Count");               // attachment_count
	echo T_("Order");               // attachment_order
	echo T_("Status");              // attachment_status

	// ------------------------------------------------------------------- Table banks
	echo T_("banks");               // Table banks
	echo T_("Banks");               // Banks
	echo T_("bank");                // banks
	echo T_("Title");               // bank_title
	echo T_("Slug");                // bank_slug
	echo T_("Website");             // bank_website
	echo T_("Status");              // bank_status
	echo T_("approved");            // Enum approved
	echo T_("unapproved");          // Enum unapproved
	echo T_("spam");                // Enum spam

	// ------------------------------------------------------------------- Table comments
	echo T_("comments");            // Table comments
	echo T_("Comments");            // Comments
	echo T_("comment");             // comments
	echo T_("Post");                // post_id
	echo T_("Product");             // product_id
	echo T_("Author");              // comment_author
	echo T_("Email");               // comment_email
	echo T_("Url");                 // comment_url
	echo T_("Content");             // comment_content
	echo T_("Status");              // comment_status
	echo T_("Parent");              // comment_parent
	echo T_("Visitor");             // Visitor_id
	echo T_("income");              // Enum income
	echo T_("outcome");             // Enum outcome

	// ------------------------------------------------------------------- Table costcats
	echo T_("costcats");            // Table costcats
	echo T_("Costcats");            // Costcats
	echo T_("costcat");             // costcats
	echo T_("Title");               // costcat_title
	echo T_("Slug");                // costcat_slug
	echo T_("Desc");                // costcat_desc
	echo T_("Parent");              // costcat_parent
	echo T_("Order");               // costcat_order
	echo T_("Type");                // costcat_type
	echo T_("Status");              // costcat_status

	// ------------------------------------------------------------------- Table costs
	echo T_("costs");               // Table costs
	echo T_("Costs");               // Costs
	echo T_("cost");                // costs
	echo T_("Title");               // cost_title
	echo T_("Price");               // cost_price
	echo T_("Costcat");             // costcat_id
	echo T_("Account");             // account_id
	echo T_("Date");                // cost_date
	echo T_("Desc");                // cost_desc
	echo T_("Type");                // cost_type

	// ------------------------------------------------------------------- Table errorlogs
	echo T_("errorlogs");           // Table errorlogs
	echo T_("Errorlogs");           // Errorlogs
	echo T_("errorlog");            // errorlogs
	echo T_("Errorlog");            // errorlog_id
	echo T_("critical");            // Enum critical
	echo T_("high");                // Enum high
	echo T_("medium");              // Enum medium
	echo T_("low");                 // Enum low

	// ------------------------------------------------------------------- Table errors
	echo T_("errors");              // Table errors
	echo T_("Errors");              // Errors
	echo T_("error");               // errors
	echo T_("Title");               // error_title
	echo T_("Solution");            // error_solution
	echo T_("Priority");            // error_priority
	echo T_("awaiting");            // Enum awaiting
	echo T_("start");               // Enum start
	echo T_("appended");            // Enum appended
	echo T_("failed");              // Enum failed
	echo T_("finished");            // Enum finished

	// ------------------------------------------------------------------- Table fileparts
	echo T_("fileparts");           // Table fileparts
	echo T_("Fileparts");           // Fileparts
	echo T_("filepart");            // fileparts
	echo T_("Part");                // filepart_part
	echo T_("Code");                // filepart_code
	echo T_("Status");              // filepart_status
	echo T_("ready");               // Enum ready
	echo T_("temp");                // Enum temp

	// ------------------------------------------------------------------- Table files
	echo T_("files");               // Table files
	echo T_("Files");               // Files
	echo T_("file");                // files
	echo T_("Server");              // file_server
	echo T_("Folder");              // file_folder
	echo T_("Code");                // file_code
	echo T_("Size");                // file_size
	echo T_("Status");              // file_status

	// ------------------------------------------------------------------- Table funds
	echo T_("funds");               // Table funds
	echo T_("Funds");               // Funds
	echo T_("fund");                // funds
	echo T_("Title");               // fund_title
	echo T_("Slug");                // fund_slug
	echo T_("Location");            // location_id
	echo T_("Initialbalance");      // fund_initialbalance
	echo T_("Desc");                // fund_desc

	// ------------------------------------------------------------------- Table locations
	echo T_("locations");           // Table locations
	echo T_("Locations");           // Locations
	echo T_("location");            // locations
	echo T_("Title");               // location_title
	echo T_("Slug");                // location_slug
	echo T_("Desc");                // location_desc
	echo T_("Status");              // location_status
	echo T_("read");                // Enum read
	echo T_("unread");              // Enum unread

	// ------------------------------------------------------------------- Table notifications
	echo T_("notifications");       // Table notifications
	echo T_("Notifications");       // Notifications
	echo T_("notification");        // notifications
	echo T_("Id Sender");           // user_id_sender
	echo T_("Title");               // notification_title
	echo T_("Content");             // notification_content
	echo T_("Url");                 // notification_url
	echo T_("Status");              // notification_status

	// ------------------------------------------------------------------- Table options
	echo T_("options");             // Table options
	echo T_("Options");             // Options
	echo T_("option");              // options
	echo T_("Cat");                 // option_cat
	echo T_("Name");                // option_name
	echo T_("Value");               // option_value
	echo T_("Extra");               // option_extra
	echo T_("Status");              // option_status
	echo T_("pass");                // Enum pass
	echo T_("recovery");            // Enum recovery
	echo T_("fail");                // Enum fail
	echo T_("lost");                // Enum lost
	echo T_("block");               // Enum block
	echo T_("delete");              // Enum delete

	// ------------------------------------------------------------------- Table papers
	echo T_("papers");              // Table papers
	echo T_("Papers");              // Papers
	echo T_("paper");               // papers
	echo T_("Type");                // paper_type
	echo T_("Number");              // paper_number
	echo T_("Date");                // paper_date
	echo T_("Price");               // paper_price
	echo T_("Holder");              // paper_holder
	echo T_("Desc");                // paper_desc
	echo T_("Status");              // paper_status
	echo T_("yes");                 // Enum yes
	echo T_("no");                  // Enum no

	// ------------------------------------------------------------------- Table permissions
	echo T_("permissions");         // Table permissions
	echo T_("Permissions");         // Permissions
	echo T_("permission");          // permissions
	echo T_("Title");               // permission_title
	echo T_("Module");              // Permission_module
	echo T_("View");                // permission_view
	echo T_("Add");                 // permission_add
	echo T_("Edit");                // permission_edit
	echo T_("Delete");              // permission_delete
	echo T_("Status");              // permission_status

	// ------------------------------------------------------------------- Table postmetas
	echo T_("postmetas");           // Table postmetas
	echo T_("Postmetas");           // Postmetas
	echo T_("postmeta");            // postmetas
	echo T_("Cat");                 // postmeta_cat
	echo T_("Name");                // postmeta_name
	echo T_("Value");               // postmeta_value
	echo T_("Status");              // postmeta_status
	echo T_("page");                // Enum page
	echo T_("open");                // Enum open
	echo T_("closed");              // Enum closed
	echo T_("publish");             // Enum publish
	echo T_("draft");               // Enum draft
	echo T_("schedule");            // Enum schedule

	// ------------------------------------------------------------------- Table posts
	echo T_("posts");               // Table posts
	echo T_("Posts");               // Posts
	echo T_("post");                // posts
	echo T_("Language");            // post_language
	echo T_("Cat");                 // post_cat
	echo T_("Title");               // post_title
	echo T_("Slug");                // post_slug
	echo T_("Content");             // post_content
	echo T_("Type");                // post_type
	echo T_("Comment");             // post_comment
	echo T_("Count");               // post_count
	echo T_("Status");              // post_status
	echo T_("Parent");              // post_parent
	echo T_("Publishdate");         // post_publishdate

	// ------------------------------------------------------------------- Table productcats
	echo T_("productcats");         // Table productcats
	echo T_("Productcats");         // Productcats
	echo T_("productcat");          // productcats
	echo T_("Title");               // productcat_title
	echo T_("Slug");                // productcat_slug
	echo T_("Desc");                // productcat_desc
	echo T_("Parent");              // productcat_parent
	echo T_("Order");               // productcat_order
	echo T_("Status");              // productcat_status
	echo T_("Count");               // productcat_count

	// ------------------------------------------------------------------- Table productmetas
	echo T_("productmetas");        // Table productmetas
	echo T_("Productmetas");        // Productmetas
	echo T_("productmeta");         // productmetas
	echo T_("Cat");                 // productmeta_cat
	echo T_("Name");                // productmeta_name
	echo T_("Value");               // productmeta_value
	echo T_("Status");              // productmeta_status

	// ------------------------------------------------------------------- Table productprices
	echo T_("productprices");       // Table productprices
	echo T_("Productprices");       // Productprices
	echo T_("productprice");        // productprices
	echo T_("Productmeta");         // productmeta_id
	echo T_("Cat");                 // productprice_cat
	echo T_("Startdate");           // productprice_startdate
	echo T_("Enddate");             // productprice_enddate
	echo T_("Buyprice");            // productprice_buyprice
	echo T_("Price");               // productprice_price
	echo T_("Discount");            // productprice_discount
	echo T_("Vat");                 // productprice_vat
	echo T_("Status");              // productprice_status
	echo T_("unset");               // Enum unset
	echo T_("available");           // Enum available
	echo T_("soon");                // Enum soon
	echo T_("discontinued");        // Enum discontinued
	echo T_("unavailable");         // Enum unavailable
	echo T_("store");               // Enum store
	echo T_("online");              // Enum online
	echo T_("both");                // Enum both

	// ------------------------------------------------------------------- Table products
	echo T_("products");            // Table products
	echo T_("Products");            // Products
	echo T_("product");             // products
	echo T_("Title");               // product_title
	echo T_("Slug");                // product_slug
	echo T_("Productcat");          // productcat_id
	echo T_("Barcode");             // product_barcode
	echo T_("Barcode2");            // product_barcode2
	echo T_("Buyprice");            // product_buyprice
	echo T_("Price");               // product_price
	echo T_("Discount");            // product_discount
	echo T_("Vat");                 // product_vat
	echo T_("Initialbalance");      // product_initialbalance
	echo T_("Mininventory");        // product_mininventory
	echo T_("Status");              // product_status
	echo T_("Sold");                // product_sold
	echo T_("Stock");               // product_stock
	echo T_("Carton");              // product_carton
	echo T_("Service");             // product_service
	echo T_("Sellin");              // product_sellin

	// ------------------------------------------------------------------- Table receipts
	echo T_("receipts");            // Table receipts
	echo T_("Receipts");            // Receipts
	echo T_("receipt");             // receipts
	echo T_("Code");                // receipt_code
	echo T_("Type");                // receipt_type
	echo T_("Price");               // receipt_price
	echo T_("Date");                // receipt_date
	echo T_("Paper");               // paper_id
	echo T_("Paperdate");           // receipt_paperdate
	echo T_("Paperstatus");         // receipt_paperstatus
	echo T_("Desc");                // receipt_desc
	echo T_("Transaction");         // transaction_id
	echo T_("Fund");                // fund_id
	echo T_("User");                // user_id_customer
	echo T_("get");                 // Enum get
	echo T_("receive");             // Enum receive
	echo T_("delivery");            // Enum delivery

	// ------------------------------------------------------------------- Table smss
	echo T_("smss");                // Table smss
	echo T_("Smss");                // Smss
	echo T_("sms");                 // smss
	echo T_("From");                // sms_from
	echo T_("To");                  // sms_to
	echo T_("Message");             // sms_message
	echo T_("Messageid");           // sms_messageid
	echo T_("Deliverystatus");      // sms_deliverystatus
	echo T_("Method");              // sms_method
	echo T_("Type");                // sms_type
	echo T_("Createdate");          // sms_createdate
	echo T_("Status");              // sms_status
	echo T_("cat");                 // Enum cat
	echo T_("tag");                 // Enum tag

	// ------------------------------------------------------------------- Table terms
	echo T_("terms");               // Table terms
	echo T_("Terms");               // Terms
	echo T_("term");                // terms
	echo T_("Language");            // term_language
	echo T_("Title");               // term_title
	echo T_("Slug");                // term_slug
	echo T_("Desc");                // term_desc
	echo T_("Parent");              // term_parent
	echo T_("Type");                // term_type
	echo T_("Status");              // term_status
	echo T_("Count");               // term_count
	echo T_("Order");               // term_order

	// ------------------------------------------------------------------- Table termusages
	echo T_("termusages");          // Table termusages
	echo T_("Termusages");          // Termusages
	echo T_("termusage");           // termusages
	echo T_("Term");                // term_id

	// ------------------------------------------------------------------- Table transactiondetails
	echo T_("transactiondetails");  // Table transactiondetails
	echo T_("Transactiondetails");  // Transactiondetails
	echo T_("transactiondetail");   // transactiondetails
	echo T_("Row");                 // transactiondetail_row
	echo T_("Quantity");            // transactiondetail_quantity
	echo T_("Price");               // transactiondetail_price
	echo T_("Discount");            // transactiondetail_discount

	// ------------------------------------------------------------------- Table transactionmetas
	echo T_("transactionmetas");    // Table transactionmetas
	echo T_("Transactionmetas");    // Transactionmetas
	echo T_("transactionmeta");     // transactionmetas
	echo T_("Cat");                 // transactionmeta_cat
	echo T_("Name");                // transactionmeta_name
	echo T_("Value");               // transactionmeta_value
	echo T_("Status");              // transactionmeta_status
	echo T_("sale");                // Enum sale
	echo T_("purchase");            // Enum purchase
	echo T_("customertostore");     // Enum customertostore
	echo T_("storetocompany");      // Enum storetocompany
	echo T_("anbargardani");        // Enum anbargardani
	echo T_("install");             // Enum install
	echo T_("repair");              // Enum repair
	echo T_("chqeuebackfail");      // Enum chqeuebackfail

	// ------------------------------------------------------------------- Table transactions
	echo T_("transactions");        // Table transactions
	echo T_("Transactions");        // Transactions
	echo T_("transaction");         // transactions
	echo T_("Type");                // transaction_type
	echo T_("Date");                // transaction_date
	echo T_("Sum");                 // transaction_sum
	echo T_("Remained");            // transaction_remained
	echo T_("forgetpassword");      // Enum forgetpassword

	// ------------------------------------------------------------------- Table userlogs
	echo T_("userlogs");            // Table userlogs
	echo T_("Userlogs");            // Userlogs
	echo T_("userlog");             // userlogs
	echo T_("Title");               // userlog_title
	echo T_("Desc");                // userlog_desc
	echo T_("Priority");            // userlog_priority
	echo T_("Type");                // userlog_type

	// ------------------------------------------------------------------- Table usermetas
	echo T_("usermetas");           // Table usermetas
	echo T_("Usermetas");           // Usermetas
	echo T_("usermeta");            // usermetas
	echo T_("Cat");                 // usermeta_cat
	echo T_("Name");                // usermeta_name
	echo T_("Value");               // usermeta_value
	echo T_("Extra");               // usermeta_extra
	echo T_("Status");              // usermeta_status
	echo T_("storeadmin");          // Enum storeadmin
	echo T_("storeemployee");       // Enum storeemployee
	echo T_("storesupplier");       // Enum storesupplier
	echo T_("storecustomer");       // Enum storecustomer
	echo T_("user");                // Enum user
	echo T_("male");                // Enum male
	echo T_("female");              // Enum female
	echo T_("active");              // Enum active
	echo T_("deactive");            // Enum deactive
	echo T_("removed");             // Enum removed
	echo T_("filter");              // Enum filter

	// ------------------------------------------------------------------- Table users
	echo T_("users");               // Table users
	echo T_("Users");               // Users
	echo T_("user");                // users
	echo T_("Type");                // user_type
	echo T_("Mobile");              // user_mobile
	echo T_("Pass");                // user_pass
	echo T_("Email");               // user_email
	echo T_("Gender");              // user_gender
	echo T_("Nickname");            // user_nickname
	echo T_("Firstname");           // user_firstname
	echo T_("Lastname");            // user_lastname
	echo T_("Birthday");            // user_birthday
	echo T_("Status");              // user_status
	echo T_("Credit");              // user_credit
	echo T_("Permission");          // permission_id
	echo T_("Createdate");          // user_createdate
	echo T_("emailsignup");         // Enum emailsignup
	echo T_("emailchangepass");     // Enum emailchangepass
	echo T_("emailrecovery");       // Enum emailrecovery
	echo T_("mobilesignup");        // Enum mobilesignup
	echo T_("mobilechangepass");    // Enum mobilechangepass
	echo T_("mobilerecovery");      // Enum mobilerecovery

	// ------------------------------------------------------------------- Table verifications
	echo T_("verifications");       // Table verifications
	echo T_("Verifications");       // Verifications
	echo T_("verification");        // verifications
	echo T_("Type");                // verification_type
	echo T_("Value");               // verification_value
	echo T_("Code");                // verification_code
	echo T_("Url");                 // verification_url
	echo T_("Verified");            // verification_verified
	echo T_("Status");              // verification_status
	echo T_("Createdate");          // verification_createdate

	// ------------------------------------------------------------------- Table visitors
	echo T_("visitors");            // Table visitors
	echo T_("Visitors");            // Visitors
	echo T_("visitor");             // visitors
	echo T_("Ip");                  // visitor_ip
	echo T_("Url");                 // visitor_url
	echo T_("Agent");               // visitor_agent
	echo T_("Referer");             // visitor_referer
	echo T_("Robot");               // visitor_robot
	echo T_("Createdate");          // visitor_createdate

}
?>