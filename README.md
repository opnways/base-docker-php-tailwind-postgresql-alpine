# Norseflow

Sistema MVC con PHP y PostgreSQL, TailwindCSS y AlpineJS usando Docker.

## Requisitos
- Docker
- Docker Compose

## Instalación
1. Copiar `.env.example` a `.env` y ajustar credenciales  
2. Construir y arrancar contenedores  
```bash
docker-compose up --build -d
```
3. Instalar dependencias de Node.js (assets)  
```bash
docker-compose exec app npm install
```

## Desarrollo
- Código fuente en `app/`  
- Vistas en `app/Views/`  
- Controladores en `app/Controllers/`  

Ejecutar build de assets en dev:  
```bash
docker-compose exec app npm run build
```

## Acceso
- Frontend: http://localhost:8080

## Volúmenes
- Base de datos: `db_data`

## Contenedores
- `app`: PHP-FPM + Composer  
- `web`: Nginx  
- `db`: PostgreSQL  

## Licencia
MIT