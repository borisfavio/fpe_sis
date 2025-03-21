<?php
echo view('templates/header');
echo view('templates/main');
echo view($contenido);
echo view('templates/footer', $lib);
?>

