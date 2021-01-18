FROM postgres:9.6

COPY schema.sql /docker-entrypoint-initdb.d/schema.sql
#COPY suite.pgsql /tmp

#ONBUILD psql -U suite suite < /tmp/suite.pgsql