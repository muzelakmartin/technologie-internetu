# Rýchly návod

1) Do `docker-compose.yml` pridaj k službe **db** riadok s mapovaním SQL inicializácie:
```
volumes:
  - db_data:/var/lib/mysql
  - ./db/init.sql:/docker-entrypoint-initdb.d/init.sql:ro
```

2) Súbory z priečinka `app/` vlož do `./app` (je mapované do `/var/www/html`).

3) Spusť:
```
docker compose up --build
```

4) Formulár bude na `http://localhost:8080/` a phpMyAdmin na `http://localhost:8081`
   (host: `db`, user: `student`, pass: `student`).

