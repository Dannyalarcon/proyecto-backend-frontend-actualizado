//Desarrollador: Francis Daniel Velasquez Alarcon
//Mail: dannyalarcon417@gmail.com
//Sistema: Mayri's Salon & Nails
//version: v3.0
//creado: 1 Septiembre del 2019

Direcciones para entorno de desarrollo api para el modulo deudas

..::visualizar todas las deudas::..
localhost/mayris_api/apis/deudas/view_deuda.php

..::visualizar deudas por cobrar::..
localhost/mayris_api/apis/deudas/view_deuda_cancelada.php

..::visualizar deudas por cobrar::..
localhost/mayris_api/apis/deudas/view_deuda_cobrar.php

..::crear una deuda::..
localhost/mayris_api/apis/deudas/insert_deuda.php
{
  "dpi": "112233445566",
  "nombre": "maria fernanda lopez",
  "direccion":"santa ana",
  "telefono":"44303866",
  "deuda":"uñas pixadas",
  "precio":100,
  "fecha":"2021-01-09"
}

..::actualizar deuda::..
localhost/mayris_api/apis/deudas/update_deuda.php
{
  "id_deuda":2,
  "dpi": "111",
  "nombre": "maria fernanda ",
  "direccion":"santa ana, esquipulas",
  "telefono":"44303",
  "deuda":"uñas pintadas, pelo",
  "precio":120,
  "fecha":"2021-02-09"
}

..::dar por terminado la deuda::..
localhost/mayris_api/apis/deudas/baja_deuda.php
{
"id_deuda":
}

..::activar deuda::..
localhost/mayris_api/apis/deudas/alta_deuda.php
{
"id_deuda":
}

*****************************************************************************************************************************************************************
**********************      NO USAR         *********************************************************************************************************************
*****************************************************************************************************************************************************************
*****************************************************************************************************************************************************************
..::eliminar deuda::..
localhost/mayris_api/apis/deudas/delete_deuda.php
{
"id_deuda":
}
