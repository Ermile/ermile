# the server must be like this


server {
	listen 80;
	listen [::]:80;


	...

	# extra php config
	autoindex on;
	location ~* \.(eot|otf|svg|ttf|woff|woff2|css|js)$ { add_header Access-Control-Allow-Origin *; expires max;}

	# add extra html for index files
	add_before_body /indexNginx/html-before.txt;
	add_after_body /indexNginx/html-after.txt;
}

