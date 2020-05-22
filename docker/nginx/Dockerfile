FROM nginx:alpine
RUN addgroup --gid 1024 mygroup
RUN adduser --disabled-password --gecos "" --force-badname --ingroup 1024 vidavi
USER vidavi
WORKDIR /var/www

CMD ["nginx"]



EXPOSE 80 443
