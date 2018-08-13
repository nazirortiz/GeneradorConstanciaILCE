<?php
/**
 * Archivo con la configuración del sistema
 *
 * @author: Nazir Ortiz
 * @email:  nazir.ortiz@gmail.com
 */

/**
 * DATOS DE CONFIGURACIÓN DE LA APLICACIÓN
 */

/**
 * Titulo que mostrará la aplicación
 */
define('TITULO_APLICACION', "ILCE - Generador de constancias");

/**
 * Rutas del proyecto
 */

/** 
 * Servidor
 */
define('PATH_HOME', $_SERVER['DOCUMENT_ROOT']);

/**
 * Si se desea cambiar el nombre del proyecto, aquí es donde se tiene que cambiar
 * Ruta de la aplicacion
 */
define('PATH_APP', PATH_HOME . "/GeneradorConstancias/");

/**
 * Capa de negocio
 */
define('PATH_BL', PATH_APP . "businesslayer/");

/** 
 * Carpeta de recursos, aquí se colocarán los archivos que se carguen en excel con los registros
 */
define('PATH_RS', PATH_APP . "recursos/");

/**
 * Carpeta de librerias
 */
define('PATH_LB', PATH_APP . "librerias/");

/** 
 * Carpeta donde se guardarán las constancias generadas
 */
define('PATH_CONSTANCIAS', PATH_RS . "constancias/");

/** 
 * Carpeta donde se guardarán los archivos en formato excel con las certificaciones cargadas al sistema
 */
define('PATH_CERTIFICACIONES', PATH_RS . "certificaciones/");

/** 
 * Carpeta donde se guardarán las codigos QR (Imagen) generados
 */
define('PATH_QR', PATH_RS . "qr/");