# Página MVC de proyectos
1. CRUD
2. Descarga pdf
3. Login

Dompdf no funciona con Bootstrap 5 por esa razón utilizamos:

```PHP
echo '<style>' . file_get_contents("bootstrap-3.3.7-dist/css/bootstrap.min.css") . '</style>';
```