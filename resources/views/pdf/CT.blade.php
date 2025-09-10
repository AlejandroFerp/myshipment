<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Contrato de Tratamiento de Residuos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 8px;
            margin: 10px;
        }

        h1,
        h2 {
            margin: 0;
            font-size: 10px;
        }

        h3 {
            margin-bottom: 3px;
            font-size: 9px;
        }

        /* Clase general para todas las tablas */
        .pdf-table {
            width: 100%;
            border-collapse: collapse;
            /* Elimina espacios entre celdas */
            border: 2px solid #000;
            /* Borde exterior grueso */
            margin-bottom: 5px;
            font-size: 8px;
        }

        .pdf-table th {
            background-color: #ccc;
            /* Fondo gris */
            padding: 4px;
            border: 2px solid #000;
            /* Borde grueso */
            text-align: center;
            font-weight: bold;
        }

        .pdf-table td {
            border: 2px solid #000;
            /* Borde grueso */
            padding: 3x;
            vertical-align: top;
        }

        .label {
            font-weight: bold;
        }

        .firma {
            height: 30px;
        }

        .top-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 5px;
            vertical-align: top;
        }

        .left-column {
            width: 65%;
        }

        .right-column {
            width: 30%;
            text-align: right;
        }
    </style>
</head>

<body>
    <div style="position: fixed; top: 0; width: 100%; text-align: left; line-height: 1.2; margin-bottom: 20px;">
        <h2 style="margin: 0; font-size: 10px;">CONTRATO DE TRATAMIENTO DE RESIDUOS</h2>
        <p style="margin: 0; font-size: 8px;">Artículo 5 del RD 553/2020, BOE 19/06/2020</p>
    </div>
    <div class="top-section" style="margin-top: 25px;">

       <table style="width: 100%; border-collapse: collapse; margin-bottom: 5px;">
            <tr>
                <!-- Columna izquierda: encabezados y datos generales -->
                <td style="width: 70%; vertical-align: top;">
                    <table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">
                        <tr>
                            <td class="label" style="border-right: none;">Nº CT:</td>
                            <td style="border-left: none;">{{ $contrato->numero_ct }}</td>
                        </tr>
                        <tr>
                            <td class="label" style="border-right: none;">Fecha:</td>
                            <td style="border-left: none;">{{ $contrato->fecha }}</td>
                        </tr>
                    </table>
                </td>
                <!-- Columna derecha: logo -->
                <td style="width: 30%; text-align: right; vertical-align: top;">
                    <img src="{{ public_path('images/logo.png') }}" style="max-width: 300px; height: auto;">
                </td>
            </tr>
        </table>
    </div>

    <!-- Datos del Contrato -->
    <div class="section">
        <table class="pdf-table">
            <!-- Encabezado -->
            <tr>
                <th colspan="4">Datos Generales del Contrato</th>
            </tr>
            <!-- Fila de datos -->
            <tr>
                <td class="label">Fecha Inicio CT:</td>
                <td>{{ $contrato->fecha_inicio }}</td>
                <td class="label">Fecha Fin CT:</td>
                <td>{{ $contrato->fecha_fin }}</td>
            </tr>
        </table>
    </div>

    <!-- Operador del Traslado -->
    <div class="section">
        <table class="pdf-table">
            <tr>
                <th colspan="6">OPERADOR DEL TRASLADO</th>
            </tr>
            <tr>
                <td colspan="6">Centro Productor o poseedor de residuos, o de la instalación de origen del traslado
                </td>
            </tr>

            <tr>
                <td class="label">NIF</td>
                <td>{{ $contrato->origen_nif }}</td>
                <td class="label">Razón Social</td>
                <td colspan="3">{{ $contrato->origen_razon_social }}</td>
            </tr>

            <tr>
                <td class="label">NIMA</td>
                <td>{{ $contrato->origen_nima }}</td>
                <td class="label">Nombre Centro</td>
                <td colspan="3">{{ $contrato->origen_nombre_centro }}</td>
            </tr>

            <tr>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td colspan="6" style="font-weight: bold;">ACTIVIDAD ECONOMICA</td>
            </tr>
            <tr>
                <td class="label">Dirección</td>
                <td colspan="5">{{ $contrato->origen_direccion }}</td>
            </tr>

            <tr>
                <td class="label">CP</td>
                <td>{{ $contrato->origen_cp }}</td>
                <td class="label">MUNICIPIO</td>
                <td>{{ $contrato->origen_municipio }}</td>
                <td class="label">PROVINCIA</td>
                <td>{{ $contrato->origen_provincia }}</td>
            </tr>

            <tr>
                <td class="label">Teléfono</td>
                <td>{{ $contrato->origen_telefono }}</td>
                <td class="label">Correo electrónico</td>
                <td colspan="3">{{ $contrato->origen_email }}</td>
            </tr>
        </table>

    </div>
    <!--Origen del Traslado -->
    <div class="section">
        <table class="pdf-table">
            <tr>
                <th colspan="6">ORIGEN DEL TRASLADO</th>
            </tr>
            <tr>
                <td colspan="6">Centro Productor o poseedor de residuos, o de la instalacion de origen del traslado
                </td>
            </tr>

            <tr>
                <td class="label">NIF</td>
                <td>{{ $contrato->origen_nif }}</td>
                <td class="label">Razón Social</td>
                <td colspan="3">{{ $contrato->origen_razon_social }}</td>
            </tr>

            <tr>
                <td class="label">NIMA</td>
                <td>{{ $contrato->origen_nima }}</td>
                <td class="label">Nombre Centro</td>
                <td colspan="3">{{ $contrato->origen_nombre_centro }}</td>
            </tr>

            <tr>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td colspan="6" style="font-weight: bold;">ACTIVIDAD ECONOMICA</td>
            </tr>
            <tr>
                <td class="label">Dirección</td>
                <td colspan="5">{{ $contrato->origen_direccion }}</td>
            </tr>

            <tr>
                <td class="label">CP</td>
                <td>{{ $contrato->origen_cp }}</td>
                <td class="label">MUNICIPIO</td>
                <td>{{ $contrato->origen_municipio }}</td>
                <td class="label">PROVINCIA</td>
                <td>{{ $contrato->origen_provincia }}</td>
            </tr>

            <tr>
                <td class="label">Teléfono</td>
                <td>{{ $contrato->origen_telefono }}</td>
                <td class="label">Correo electrónico</td>
                <td colspan="3">{{ $contrato->origen_email }}</td>
            </tr>
        </table>
    </div>

    <!-- Destino del Traslado -->
    <div class="section">
        <table class="pdf-table">
            <tr>
                <th colspan="6">DESTINO DEL TRASLADO</th>
            </tr>
            <tr>
                <td colspan="6">Centro receptor de residuos o instalación de destino del traslado</td>
            </tr>

            <tr>
                <td class="label">NIF</td>
                <td>{{ $contrato->destino_nif }}</td>
                <td class="label">Razón Social</td>
                <td colspan="3">{{ $contrato->destino_razon_social }}</td>
            </tr>

            <tr>
                <td class="label">NIMA</td>
                <td>{{ $contrato->destino_nima }}</td>
                <td class="label">Nombre Centro</td>
                <td colspan="3">{{ $contrato->destino_nombre_centro }}</td>
            </tr>

            <tr>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td colspan="6" style="font-weight: bold;">ACTIVIDAD ECONOMICA</td>
            </tr>

            <tr>
                <td class="label">Dirección</td>
                <td colspan="5">{{ $contrato->destino_direccion }}</td>
            </tr>

            <tr>
                <td class="label">CP</td>
                <td>{{ $contrato->destino_cp }}</td>
                <td class="label">MUNICIPIO</td>
                <td>{{ $contrato->destino_municipio }}</td>
                <td class="label">PROVINCIA</td>
                <td>{{ $contrato->destino_provincia }}</td>
            </tr>

            <tr>
                <td class="label">Teléfono</td>
                <td>{{ $contrato->destino_telefono }}</td>
                <td class="label">Correo electrónico</td>
                <td colspan="3">{{ $contrato->destino_email }}</td>
            </tr>
        </table>

    </div>

    <!-- Información sobre el residuo -->
    <div class="section">
        <table class="pdf-table">
            <!-- Encabezado de la tabla -->
            <tr>
                <th colspan="4">INFORMACIÓN SOBRE EL RESIDUO QUE SE TRASLADA</th>
            </tr>

            <!-- Filas de datos -->
            <tr>
                <td class="label" colspan="3">
                    <span style="font-weight: bold; font-size: 14px;">Código LER</span>
                    <p style="font-size: 10px; font-weight: normal; margin: 2px 0 0 0;">
                        Lista Europea de Residuos, según Decision 2000/532/CE
                    </p>
                </td>
                <td>{{ $contrato->codigo_ler }}</td>
            </tr>
            <tr>
                <td class="label">Descripción del Residuo</td>
                <td colspan="3">{{ $contrato->descripcion_residuo }}</td>
            </tr>
            <tr>
                <td class="label">COD. PROCESO EN ORIGEN</td>
                <td></td>
                <td class="label">OPERACIÓN TRATAMIENTO EN DESTINO</td>
                <td>R0404</td>
            </tr>
            <tr>
                <td class="label">COD. PELIGROSIDAD (HP)</td>
                <td>HP6</td>
                <td class="label">Cantidad (kg)</td>
                <td>{{ $contrato->cantidad }}</td>
            </tr>
        </table>
    </div>

    <table class="pdf-table">
        <tr>
            <td style="font-weight: bold; background-color: #ccc;">CONDICIONES DE ACEPTACION DE LOS RESIDUOS</td>
            <td>N/A</td>
        </tr>
        <tr>
            <td style="font-weight: bold; background-color: #ccc;">OBLIGACIONES DE LAS PARTES EN CASO DE RECHAZO DEL
                RESIDUO</td>
            <td>N/A</td>
        </tr>
    </table>
    <!-- Firmas -->
    <div class="section" style="margin-top: 5px;">
        <p style="margin: 0; font-size: 12px;">Mediante la firma del presente acuerdo, el productor autoriza
            expresamente al operador del traslado a ejercer
            como tal en el periodo y duración del presente contrato.</p>
        <table style="width: 100%; margin-top: 5px; border-collapse: collapse;">
            <tr>
                <!-- Firma izquierda -->
                <td style="width:50%; text-align: left; vertical-align: top;">
                    <p class="label">Firma Productor y/o Poseedor</p>
                </td>

                <!-- Firma derecha -->
                <td style="width:50%; text-align: right; vertical-align: top;">
                    <p class="label">Firma Responsable Destino</p>
                    <img src="{{ public_path('images/firmaCT.png') }}" class="firma">
                </td>
            </tr>
        </table>

        <div style="position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 8px; line-height: 1.2;">
            <p style="margin: 0;">
                GDV GESTION Y DISTRIBUCION S.L. - ESB16735805 - C/ Sagitario 5 03006 Alicante, España - Inscrita en el
                RM de Alicante - Hoja A 175484 Folio 220 Volumen 4394 Seccion GNE
            </p>
        </div>
</body>

</html>
