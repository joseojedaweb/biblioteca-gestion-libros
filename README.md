# Biblioteca Inglés – Laravel 11

Aplicación web para gestionar la **biblioteca del Departamento de Inglés**: altas de libros (con precarga por ISBN), préstamos y listado de préstamos, con autenticación.

## 🧰 Stack y dependencias
- **Laravel** 11 (`laravel/framework ^11.31`), **PHP ≥ 8.2**
- **Laravel Breeze** (auth por vistas Blade + Tailwind + Alpine)
- **Vite**, TailwindCSS, AlpineJS
- **Base de datos**: MySQL/MariaDB
- **API externa**: OpenLibrary para precargar datos del libro por ISBN

## 📂 Estructura funcional
- **Modelos** (`app/Models`):
  - `Libro` (hasMany `Prestamo`)
  - `Curso` (hasMany `Prestamo`)
  - `Prestamo` (belongsTo `Libro`, belongsTo `Curso`)
- **Controladores** (`app/Http/Controllers`):
  - `GestionarLibros`: buscar por ISBN en OpenLibrary, registrar libro, listar, eliminar.
  - `PrestamoController`: flujo de introducir ISBN, ver préstamos del libro, crear y eliminar préstamo, ver **todos** los préstamos.
- **Vistas** (`resources/views`): `dashboard`, `gestionarLibros`, `registroLibro`, `isbnPrestamo`, `todosLosPrestamos`.
- **JS público**: `public/js/eliminarLibro.js`, `public/js/borrarPrestamo.js` para borrado vía `fetch` (JSON).

## 🔐 Autenticación
Generada con **Laravel Breeze**: login, registro, perfil. El dashboard y las pantallas funcionales están protegidas con `auth`.

## 🗃️ Esquema de datos (migraciones)
- `libros`: `id`, `isbn (string)`, `titulo`, `autor`, `num_ejemplares (int)`, `nivel (string)`
- `cursos`: `id`, `curso (string)`, `grupo (string)`
- `prestamos`: `id`, `id_libro (fk->libros)`, `id_curso (fk->cursos)`, `fecha (date)`, `nombre_alumno`, `apellido1_alumno`, `apellido2_alumno`  
  → `prestamos.id_libro` y `prestamos.id_curso` con **FK** y *cascade on delete*.

> **Nota**: Según requerimientos del proyecto, los cursos se añaden **manualmente** (no hay CRUD de cursos).

## 🔀 Rutas principales (web)
> Nombres de ruta (útiles en Blade) → método y URL

- `mostrarLibros` → `GET /libros`
- `getLibro` → `GET /libro` (formulario de ISBN → precarga con OpenLibrary y muestra `registroLibro`)
- `guardarLibro` → `POST /guardarLibro`
- `formulario_IsbnPrestamo` → `GET /isbn-prestamo`
- `procesar_FormularioPrestamo` → `POST /isbn-prestamo` (muestra préstamos del ISBN introducido + formulario de alta)
- `procesar_CrearPrestamo` → `POST /crear-prestamo`
- `eliminarPrestamo` → `GET /eliminar-prestamo/{id}` (*ver recomendación REST abajo*)
- `mostrar_TodosPrestamos` → `GET /prestamos`
- `eliminarLibro` → `GET /eliminar-libro/{id}` (*ver recomendación REST abajo*)

## 🚀 Puesta en marcha (local)
1. **Clonar** el repo y entrar en la carpeta del proyecto (la que contiene `artisan`).
2. Instalar PHP deps (reconstruye `/vendor`):  
   ```bash
   composer install
   ```
3. Copiar `.env` de ejemplo y **configurar DB**:  
   ```bash
   cp .env.example .env      # En Windows: copy .env.example .env
   php artisan key:generate
   ```
   En `.env` ajusta: `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.
4. **Migraciones**:  
   ```bash
   php artisan migrate
   ```
   (Los **cursos** se insertan manualmente. Ejemplo SQL:)
   ```sql
   INSERT INTO cursos (curso, grupo) VALUES
     ('1 ESO','A'), ('1 ESO','B'), ('2 ESO','A'),
     ('3 ESO','A'), ('4 ESO','A'), ('1 BACHILLER','A'), ('2 BACHILLER','A');
   ```
5. Frontend (opcional para estilos/JS con Vite):  
   ```bash
   npm install
   npm run dev    # o npm run build
   ```
6. **Levantar** servidor:  
   ```bash
   php artisan serve
   ```
   Acceso: `http://localhost:8000`

## 📌 Notas importantes para el repositorio
- **NO subas**: `/vendor`, `/node_modules`, `/public/build`, **`.env`**, ni ficheros de compilación. Ya están listados en `.gitignore`.
- **Sí sube**: `composer.json`, `composer.lock`, `package.json`, `vite.config.js`, código fuente, migraciones, vistas, `public/js/*`, etc.
- Si accidentalmente `.env` hubiese sido *trackeado*, saca del index:  
  ```bash
  git rm --cached .env
  ```

## ✅ Comprobación rápida
- Login/Registro (Breeze) → Dashboard con 3 opciones.
- **Gestionar Libros**: introducir ISBN → precarga por OpenLibrary → completar y guardar → aparece en tabla → eliminar vía botón.
- **Préstamos por ISBN**: introducir ISBN → ver préstamos de ese libro + alta de préstamo (al crear **decrementa** `num_ejemplares`; al eliminar **incrementa**).
- **Todos los préstamos**: listado por fecha (recientes primero) + opción de eliminar.

## 🧪 Recomendaciones/mejoras (siguientes pasos)
- Cambiar borrados a **método `DELETE`** (no `GET`) con protección CSRF (formularios o `fetch` con token) y **Policy** si procede.
- Añadir **índice único** a `libros.isbn` para evitar duplicados.
- Validar `num_ejemplares ≥ 0` y bloquear préstamo cuando no haya stock.
- Considerar **SoftDeletes** en `prestamos` si quieres histórico.
- Normalizar valores de `nivel` (enum) y mostrarlos desde una constante o `Enum` de PHP.

## 🧾 Licencia
MIT (recomendado).

---

### Cómo subir con GitHub Desktop (pasos)
1. Abre **GitHub Desktop** → *Add an Existing Repository* → selecciona la carpeta del proyecto (la que contiene `composer.json`).
2. Verifica en *Changes* que **no** aparece `.env` ni `vendor/` (si aparecen, revisa `.gitignore`).
3. Escribe un mensaje de commit (p.ej., “Proyecto inicial Biblioteca”) → **Commit to main**.
4. Pulsa **Publish repository** → elige nombre (p.ej., `biblioteca-ingles-laravel`), visibilidad *Public* o *Private* → **Publish**.
5. En GitHub, añade una **Descripción**, **Topics**: `laravel`, `php`, `library`, `breeze`, `tailwind` y sube este `README`. 

