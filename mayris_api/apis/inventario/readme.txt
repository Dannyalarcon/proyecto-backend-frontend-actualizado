//Desarrollador: Francis Daniel Velasquez Alarcon
//Sistema: Mayri's Salon & Nails
//version: v3.0
//creado: 1 Septiembre del 2019

..::visualizar todo el inventario::..
localhost/mayris_api/apis/inventario/view_inventario.php

..::visualizar inventario sin stock::..
localhost/mayris_api/apis/inventario/view_inventario_baja.php

..::visualizar inventario con stock::..
localhost/mayris_api/apis/inventario/view_inventario_alta.php


..::insertar inventario::..
localhost/mayris_api/apis/inventario/insert_inventario.php
{
    "producto": "secadora",
    "precio": 250,
    "cantidad": 2
}

..::actualizar inventario::..
localhost/mayris_api/apis/inventario/update_inventario.php
{
    "id_inventario":7,
    "producto": "secadora roja",
    "precio": 150,
    "cantidad": 6
}

..::dar de baja a inventario::..
localhost/mayris_api/apis/inventario/baja_inventario.php
{
    "id_inventario":7
}

..::dar de alta a inventario::..
localhost/mayris_api/apis/inventario/alta_inventario.php
{
    "id_inventario": 7
}

..::eliminar inventario::..
localhost/mayris_api/apis/inventario/delete_inventario.php
{
    "id_inventario": ,
}
