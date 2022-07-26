# Cara menjalankannya
1. download pustaka pustaka lainnya, ketikan : `composer install`, pastikan composer terinstall dan sesuai versi framework ci nya
2. kemudian setting file .env bagian databasenya dan juga buat database baru
```
// example
database.default.hostname = localhost
database.default.database = ci4-requestdb
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.DBPrefix =
```
3. jika sudah setting file .env. jalankan migrasi database. `php spark migrate`
4. kemudian masukan data dummy nya di folder `app/database/Seed/`. ada dua data dummy yaitu role dan user.
5. lalu jalankan `php spark db:seed` lalu isikan `RoleSeeder`.
6. lalu jalankan `php spark db:seed` lalu isikan `UserSeeder`.
7. ketika sudah semua dilakukan lalu hidupkan `php spark serve`
8. buka browser `http://localhost:8080`

# Jika port tidak bisa digunakan
1. Pilih port nya, misalkan
```
php spark serve --port 8081
```
2. kemudian setting file .env dari
```
# dari
app.baseURL = 'http://localhost:8080' 
# menjadi
app.baseURL = 'http://localhost:8081' 
```

# Jika ingin menambah data dummy
1. bisa di lihat `app/Database/Seeds`
2. dan memakai file model.
3. dan jalankan `php spark db:seed` lalu pilih filenya yang ada di `Seed`