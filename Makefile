run: clean
	docker-compose -p alba build &&\
	docker-compose -p alba up -d mysql &&\
	./wait-for-mysql &&\
	docker-compose -p alba up -d &&\
	docker-compose -p alba logs -f

clean:
	docker-compose -p alba kill;\
	docker-compose -p alba down --remove-orphans;\
	exit 0