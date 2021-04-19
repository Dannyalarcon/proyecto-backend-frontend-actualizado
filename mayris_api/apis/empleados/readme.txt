//Desarrollador: Francis Daniel Velasquez Alarcon
//Sistema: Mayri's Salon & Nails
//version: v3.0
//creado: 1 Septiembre del 2019

Direcciones para entorno de desarrollo api para el modulo empleados

..::visualizar todos los empleados ::..
localhost/mayris_api/apis/empleados/view_empleados.php

..::visualizar empleados activos::..
localhost/mayris_api/apis/empleados/view_empleados_activa.php

..::visualizar empleados desactivo::..
localhost/mayris_api/apis/empleados/view_empleados_desactivo.php

..::crear nuevo empleado::..
localhost/mayris_api/apis/empleados/insert_empleado.php
{
    "dpi":"123456789",
    "nombre":"maria fernanda guzman erazo",
    "direccion":"residenciales del valle, esquipulas, chiquimula",
    "telefono":"30986659",
    "fecha":"1999/01/04",
    "correo":"mariafernanda@gmail.com",
    "salario":"1000"
}

..::actualizar datos empleado::..
localhost/mayris_api/apis/empleados/update_empleados.php
{
    "id_empleados":5,
    "dpi":"0124578",
    "nombre":"maria fernanda erazo",
    "direccion":"residenciales del valle",
    "telefono":"44303866",
    "fecha":"1999/01/04",
    "correo":"mariafer@gmail.com",
    "salario":"700"
}

..::dar de baja a empleado::..
localhost/mayris_api/apis/empleados/baja_empleados.php
{
    "id_empleados"://
}

..::dar de alta a empleado::..
localhost/mayris_api/apis/empleados/alta_empleados.php
{
    "id_empleados"://
}

..::eliminar a empleado::..
localhost/mayris_api/apis/empleados/delete_empleados.php
{
    "id_empleados"://
}

