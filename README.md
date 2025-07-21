# 📝 Notes App

Tato aplikace slouží jako jednoduchý poznámkový systém postavený na:

- **Frontend**: Vue 3 + TypeScript + Vuetify
- **Backend**: Symfony + API Platform
- **Databáze**: MariaDB
- **Správa DB**: Adminer
- **Docker**: Vše běží jako multikontejnerová aplikace

---

## 🚀 Spuštění pomocí Dockeru

### 1. Klonuj repozitář

```bash
git clone https://github.com/matouswrozyna/notes.git
cd notes-app
```

### 2. Sestavení kontejnerů (čistě)

```bash
docker compose build --no-cache
```

### 3. Spuštění aplikace

```bash
docker compose up
```

---

## 🌐 Přístupové adresy

| Služba           | URL                                   |
|------------------|----------------------------------------|
| Frontend (Vue)   | http://localhost:5173                 |
| Backend (API)    | http://localhost:8000/api             |
| Adminer          | http://localhost:8080                 |

---

## 🧱 Struktura repozitáře

```
.
├── frontend/        # Vue 3 + Vuetify (Vite)
├── backend/         # Symfony + API Platform
├── docker-compose.yml
└── README.md
```

---

## 🧪 Užitečné příkazy

### Frontend (lokálně mimo Docker)

```bash
cd frontend
npm install
npm run dev
```

### Backend (lokálně mimo Docker)

```bash
cd backend
composer install
php bin/console doctrine:migrations:migrate
symfony server:start
```

---

## 📦 Požadavky

- Docker + Docker Compose
- Node.js (pro lokální frontend)
- PHP 8.2+ (pro lokální backend)
