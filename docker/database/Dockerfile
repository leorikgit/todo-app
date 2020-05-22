FROM mariadb:latest
RUN addgroup --gid 1024 mygroup
RUN adduser --disabled-password --gecos "" --force-badname --ingroup 1024 vidavi
USER vidavi
CMD ["mysqld"]

EXPOSE 3306
