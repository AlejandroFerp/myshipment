<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\EnvioController;
use App\Http\Controllers\RecogidaController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\CentroController;
use App\Http\Controllers\AutorizacionController;
use App\Http\Controllers\EnvironmentalAuthorizationController;
use App\Http\Controllers\AutonomicCommunityController;
use App\Http\Controllers\WastesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductAttributeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ShipmentController;
// Rutas para Packages
Route::resource('packages', PackageController::class);
// Rutas de productos
Route::resource('products', ProductController::class);
// Rutas de atributos dinámicos vinculadas a productos
Route::prefix('products/{product}')->group(function () {
    Route::get('attributes', [ProductAttributeController::class, 'index'])->name('product_attributes.index');
    Route::get('attributes/create', [ProductAttributeController::class, 'create'])->name('product_attributes.create');
    Route::post('attributes', [ProductAttributeController::class, 'store'])->name('product_attributes.store');
    Route::get('attributes/{attribute}/edit', [ProductAttributeController::class, 'edit'])->name('product_attributes.edit');
    Route::put('attributes/{attribute}', [ProductAttributeController::class, 'update'])->name('product_attributes.update');
    Route::delete('attributes/{attribute}', [ProductAttributeController::class, 'destroy'])->name('product_attributes.destroy');
});
// residuos
Route::resource('wastes', WastesController::class);
// Página de inicio usando el controlador HomeController
Route::get('/', [HomeController::class, 'index'])->name('home');
// Rutas para AutonomicCommunity
Route::resource('autonomic_communities', AutonomicCommunityController::class);
// Clientes
Route::get('/clientes/{cliente}/pdf-word', [ClienteController::class, 'generatePdfWord'])->name('clientes.pdf-word');
Route::get('/clientes/{id}/pdf', [ClienteController::class, 'generarPdf'])->name('clientes.pdf');
Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
// Documentos
Route::get('/documentos', [DocumentoController::class, 'index'])->name('documentos.index');
Route::get('/documentos/create', [DocumentoController::class, 'create'])->name('documentos.create');
Route::post('/documentos', [DocumentoController::class, 'store'])->name('documentos.store');
Route::get('/documentos/{documento}/edit', [DocumentoController::class, 'edit'])->name('documentos.edit');
Route::put('/documentos/{documento}', [DocumentoController::class, 'update'])->name('documentos.update');
Route::delete('/documentos/{documento}', [DocumentoController::class, 'destroy'])->name('documentos.destroy');
// Rutas para Shipments
Route::resource('shipments', ShipmentController::class);
// Recogida
Route::get('/recogidas', [RecogidaController::class, 'index'])->name('recogidas.index');
Route::get('/recogidas/create', [RecogidaController::class, 'create'])->name('recogidas.create');
Route::post('/recogidas', [RecogidaController::class, 'store'])->name('recogidas.store');
Route::get('/recogidas/{recogida}/edit', [RecogidaController::class, 'edit'])->name('recogidas.edit');
Route::put('/recogidas/{recogida}', [RecogidaController::class, 'update'])->name('recogidas.update');
Route::delete('/recogidas/{recogida}', [RecogidaController::class, 'destroy'])->name('recogidas.destroy');
// Direcciones
Route::get('/direcciones', [DireccionController::class, 'index'])->name('direcciones.index');
Route::get('/direcciones/create', [DireccionController::class, 'create'])->name('direcciones.create');
Route::post('/direcciones', [DireccionController::class, 'store'])->name('direcciones.store');
Route::get('/direcciones/{direccion}/edit', [DireccionController::class, 'edit'])->name('direcciones.edit');
Route::put('/direcciones/{direccion}', [DireccionController::class, 'update'])->name('direcciones.update');
Route::delete('/direcciones/{direccion}', [DireccionController::class, 'destroy'])->name('direcciones.destroy');
// Centros
Route::get('/centros/{centro}/contrato', [CentroController::class, 'generarContrato'])->name('centros.contrato');
Route::get('/centros', [CentroController::class, 'index'])->name('centros.index');
Route::get('/centros/create', [CentroController::class, 'create'])->name('centros.create');
Route::post('/centros', [CentroController::class, 'store'])->name('centros.store');
Route::get('/centros/{centro}/edit', [CentroController::class, 'edit'])->name('centros.edit');
Route::put('/centros/{centro}', [CentroController::class, 'update'])->name('centros.update');
Route::delete('/centros/{centro}', [CentroController::class, 'destroy'])->name('centros.destroy');
// autorizaciones
Route::get('/autorizaciones', [AutorizacionController::class, 'index'])->name('autorizaciones.index');
Route::get('/autorizaciones/create', [AutorizacionController::class, 'create'])->name('autorizaciones.create');
Route::post('/autorizaciones', [AutorizacionController::class, 'store'])->name('autorizaciones.store');
Route::get('/autorizaciones/{autorizacion}/edit', [AutorizacionController::class, 'edit'])->name('autorizaciones.edit');
Route::put('/autorizaciones/{autorizacion}', [AutorizacionController::class, 'update'])->name('autorizaciones.update');
Route::delete('/autorizaciones/{autorizacion}', [AutorizacionController::class, 'destroy'])->name('autorizaciones.destroy');
// Environmental Authorization 
Route::resource('autorizacionesMedioambientales', EnvironmentalAuthorizationController::class)
    ->parameters([
        'autorizacionesMedioambientales' => 'autorizacionMedioambiental'
    ]);

// Puedes añadir rutas similares para documentos, envíos y recogidas si tienes sus controladores
// preview
Route::get('/vista-prueba', function () {
    $contrato = (object)[
        'numero_ct' => 'CT-00001',
        'fecha' => now()->format('d/m/Y'),
        'fecha_inicio' => now()->format('d/m/Y'),
        'fecha_fin' => now()->addYear()->format('d/m/Y'),
        'origen_nif' => '12345678A',
        'origen_razon_social' => 'Empresa Origen',
        'origen_nima' => 'NIMA001',
        'origen_nombre_centro' => 'Centro Origen',
        'origen_direccion' => 'Calle Origen, 1',
        'origen_cp' => '28001',
        'origen_municipio' => 'Madrid',
        'origen_provincia' => 'Madrid',
        'origen_telefono' => '600000000',
        'origen_email' => 'origen@empresa.com',
        'destino_nif' => 'B16735805',
        'destino_razon_social' => 'GDV GESTION Y DISTRIBUCION S.L.',
        'destino_nima' => '0300025443',
        'destino_nombre_centro' => 'CENTRAL',
        'destino_direccion' => 'Calle Sagitario, 5',
        'destino_cp' => '03006',
        'destino_municipio' => 'Alicante',
        'destino_provincia' => 'Alicante',
        'destino_telefono' => '865550870',
        'destino_email' => 'residuos@gdvmobility.com',
        'codigo_ler' => '160605',
        'descripcion_residuo' => 'Baterías de litio',
        'tratamiento' => 'R04',
        'hp' => 'HP6',
        'cantidad' => '1200',
    ];

    return view('pdf.CT', compact('contrato'));
});

