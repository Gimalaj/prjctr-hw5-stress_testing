Add random data to database:
	http://localhost:8080/?add_records=NUM

My database has 951745 clients record

Run siege:
	siege -c 150 -t 30s -i -f siege.txt