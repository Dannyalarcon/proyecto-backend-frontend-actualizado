//Desarrollador: Francis Daniel Velasquez Alarcon
//Mail: dannyalarcon417@gmail.com
//Sistema: Mayri's Salon & Nails
//version: v3.0
//creado: 1 Septiembre del 2019

Direcciones para entorno de desarrollo api para el modulo agenda

..::visualizar todas las citas::..
localhost/mayris_api/apis/agenda/view_cita.php

..::visualizar las citas activas::..
localhost/mayris_api/apis/agenda/view_cita_pendiente.php

..::visualizar las citas finalizadas::..
localhost/mayris_api/apis/agenda/view_cita_finalizado.php

..::visualizar las citas cancelados::..
localhost/mayris_api/apis/agenda/view_cita_cancelado.php

..::ingresar cita::..
localhost/mayris_api/apis/agenda/insert_cita.php
{
    "nombre":"karen ortega",
    "descripcion":"manicura color rosa diseño de caballo",
    "precio": "75",
    "telefono": "30986659",
    "fecha": "2021-10-03",
    "hora": "15:45:00"
}

..::editar la cita::..
localhost/mayris_api/apis/agenda/update_cita.php
{
    "id_agenda":12,
    "nombre":"karen ortega sevilla",
    "descripcion":"manicura color rosa diseño de caballo, herradura, sombrero",
    "precio": "175",
    "telefono": "30986659",
    "fecha": "2021-04-03",
    "hora": "15:45:00"
}

..::finalizar cita::..
localhost/mayris_api/apis/agenda/finalizar_cita.php
{
    "id_agenda":
}

..::cancelar cita::..
localhost/mayris_api/apis/agenda/cancelar_cita.php
{
    "id_agenda":
}

..::si por accidente cancela o finaliza cita volver a activar la cita::..
localhost/mayris_api/apis/agenda/activar_cita.php
{
    "id_agenda":
}


*****************************************************************************************************************************************************************
**********************      NO USAR         *********************************************************************************************************************
*****************************************************************************************************************************************************************
*****************************************************************************************************************************************************************
..::eliminar id cita::..
localhost/mayris_api/apis/agenda/delete_cita.php
{
    "id_agenda":
}
