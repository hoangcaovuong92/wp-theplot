mysqldump -d --comments=FALSE -u root woo_no_one > 1_schema.sql
mysqldump -t --order-by-primary --comments=FALSE -u root woo_no_one > 2_init_data.sql
