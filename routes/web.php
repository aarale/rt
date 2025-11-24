<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ClientCartController;
use App\Http\Controllers\ClientOrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Seller\SellerDashboardController;
use App\Http\Controllers\Seller\SellerOrderController;
use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Controllers\Seller\SellerChatController;
use App\Http\Controllers\Seller\SellerBusinessController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Admin\AdminDashboardController;

Route::get('/', fn () => view('dashboard'))->name('dashboard');
Route::get('/chats', fn () => view('customer.chat.show'))->name('msj');

Route::get('/login', fn () => view('auth.login'))->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

Route::get('/catalog/category/{slug}', [CatalogController::class, 'category'])->name('catalog.category');
Route::get('/pedidos', [PedidosController::class, 'index'])->name('customer.orders.pedidos');

Route::get('/carrito', [ClientCartController::class, 'view'])->name('cliente.carrito.ver');
Route::post('/carrito/agregar', [ClientCartController::class, 'add'])->name('cliente.carrito.agregar');
Route::post('/carrito/eliminar', [ClientCartController::class, 'remove'])->name('cliente.carrito.eliminar');

Route::get('/checkout', [ClientOrderController::class, 'checkout'])->name('cliente.checkout');
Route::post('/pagar', [ClientOrderController::class, 'pagar'])->name('cliente.pagar');
Route::get('/confirmacion', [ClientOrderController::class, 'confirm'])->name('cliente.pedido.confirmado');
Route::post('/confirmar-pago', [ClientOrderController::class, 'confirmarPago'])->name('cliente.pago.confirmar');

Route::middleware('auth')->group(function () {
    Route::get('/chat', [ChatController::class, 'showAll'])->name('chat.index'); // Todas las conversaciones
    Route::get('/chat/{orderId}', [ChatController::class, 'show'])->name('chat.show'); // Una conversación específica
    Route::post('/chat/{orderId}', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/chat/todos', [ChatController::class, 'showAll'])->name('chat.all');

});



// Productos públicos
Route::get('/productos', [ProductController::class, 'index'])->name('productos.index');
Route::get('/productos/{product}', [ProductController::class, 'show'])->name('productos.show');

// Notificaciones
Route::get('/notificaciones', [NotificationController::class, 'index'])->name('notifications.index');
Route::get('/notificaciones/{id}/leer', [NotificationController::class, 'read'])->name('notifications.read');

// Perfil
Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::get('/cambiar-vendedor', [ProfileController::class, 'becomeSeller'])->name('profile.seller');
Route::get('/cambiar-cliente', [ProfileController::class, 'switchToCustomer'])->name('profile.customer');

// Vendedor
Route::get('/vendedor', [SellerDashboardController::class, 'index'])->name('seller.dashboard');

Route::get('/vendedor/pedidos', [SellerOrderController::class, 'index'])->name('seller.orders.chat');
Route::get('/vendedor/chat', [SellerOrderController::class, 'index'])->name('seller.orders.index');
Route::get('/vendedor/chat/{id}', [SellerOrderController::class, 'show'])->name('seller.orders.show');


Route::post('/vendedor/pedidos/{id}/aceptar', [SellerOrderController::class, 'accept'])->name('seller.orders.accept');
Route::post('/vendedor/pedidos/{id}/rechazar', [SellerOrderController::class, 'reject'])->name('seller.orders.reject');
Route::post('/vendedor/pedidos/{id}/listo', [SellerOrderController::class, 'ready'])->name('seller.orders.ready');
Route::post('/vendedor/pedidos/{id}/completar', [SellerOrderController::class, 'complete'])->name('seller.orders.complete');

Route::get('/vendedor/productos', [SellerProductController::class, 'index'])->name('seller.products.index');
Route::get('/vendedor/productos/crear', [SellerProductController::class, 'create'])->name('seller.products.create');
Route::post('/vendedor/productos', [SellerProductController::class, 'store'])->name('seller.products.store');
Route::get('/vendedor/productos/{product}', [SellerProductController::class, 'show'])->name('seller.products.show');
Route::get('/vendedor/productos/{product}/editar', [SellerProductController::class, 'edit'])->name('seller.products.edit');
Route::put('/vendedor/productos/{product}', [SellerProductController::class, 'update'])->name('seller.products.update');
Route::delete('/vendedor/productos/{product}', [SellerProductController::class, 'destroy'])->name('seller.products.destroy');

Route::get('/vendedor/chat/{orderId}', [SellerChatController::class, 'show'])->name('seller.chat.show');
Route::post('/vendedor/chat/{orderId}', [SellerChatController::class, 'send'])->name('seller.chat.send');

Route::get('/vendedor/negocio/crear', [SellerBusinessController::class, 'create'])->name('seller.business.create');
Route::post('/vendedor/negocio', [SellerBusinessController::class, 'store'])->name('seller.business.store');
Route::get('/vendedor/negocio/editar', [SellerBusinessController::class, 'edit'])->name('seller.business.edit');
Route::put('/vendedor/negocio', [SellerBusinessController::class, 'update'])->name('seller.business.update');



// admin
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');





Route::middleware(['auth'])->group(function () {
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');
});

/*
use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\User;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ClientCartController;
use App\Http\Controllers\ClientOrderController;
use App\Http\Controllers\Seller\SellerDashboardController;
use App\Http\Controllers\Seller\SellerOrderController;
use App\Http\Controllers\Seller\SellerChatController;
use App\Http\Controllers\Seller\SellerBusinessController;
use App\Http\Controllers\Seller\SellerProductController;

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/', fn () => view('dashboard'))->name('home');

require __DIR__.'/auth.php';
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/redirect-by-role', function () {
    return redirect(RouteServiceProvider::redirectTo());
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/become-seller', [ProfileController::class, 'becomeSeller'])->name('profile.becomeSeller');
    Route::post('/profile/switch-to-customer', [ProfileController::class, 'switchToCustomer'])->name('profile.switch.to.customer');
});

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'read'])->name('notifications.read');
});

Route::middleware(['auth', 'customer'])->group(function () {
    // Carrito
    Route::get('/carrito', [ClientCartController::class, 'view'])->name('cliente.carrito.ver');
    Route::post('/carrito/agregar', [ClientCartController::class, 'add'])->name('cliente.carrito.agregar');
    Route::post('/carrito/actualizar', [ClientCartController::class, 'update'])->name('cliente.carrito.actualizar');
    Route::post('/carrito/eliminar', [ClientCartController::class, 'remove'])->name('cliente.carrito.eliminar');

    // Pedido
    Route::post('/pedido/crear', [ClientOrderController::class, 'store'])->name('cliente.pedido.crear');
    Route::get('/checkout', [ClientOrderController::class, 'checkout'])->name('cliente.checkout');
    Route::post('/pedido-confirmar', [ClientOrderController::class, 'confirm'])->name('cliente.pedido.confirm');
    Route::get('/pedido/confirmado', fn () => view('customer.orders.confirmation'))->name('cliente.pedido.confirmado');

    // Chat
    Route::get('/chat/{orderId}', [SellerChatController::class, 'abrirDesdeCliente'])->name('cliente.chat');
});

Route::middleware(['auth', 'seller'])->prefix('seller')->name('seller.')->group(function () {
    Route::get('/business/create', [SellerBusinessController::class, 'create'])->name('business.create');
    Route::post('/business', [SellerBusinessController::class, 'store'])->name('business.store');
});

Route::middleware(['auth', 'seller', 'seller.business'])->prefix('seller')->name('seller.')->group(function () {
    Route::get('/dashboard', [SellerDashboardController::class, 'index'])->name('dashboard');

    // Negocio
    Route::get('/business/edit', [SellerBusinessController::class, 'edit'])->name('business.edit');
    Route::put('/business', [SellerBusinessController::class, 'update'])->name('business.update');

    // Productos
    Route::resource('/products', SellerProductController::class);

    // Pedidos
    Route::get('/orders', [SellerOrderController::class, 'index'])->name('orders');
    Route::get('/orders/{id}', [SellerOrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/accept', [SellerOrderController::class, 'accept'])->name('orders.accept');
    Route::post('/orders/{id}/reject', [SellerOrderController::class, 'reject'])->name('orders.reject');
    Route::post('/orders/{id}/ready', [SellerOrderController::class, 'ready'])->name('orders.ready');
    Route::post('/orders/{id}/complete', [SellerOrderController::class, 'complete'])->name('orders.complete');

    // Chat
    Route::get('/orders/{id}/chat', [SellerChatController::class, 'show'])->name('orders.chat');
    Route::post('/orders/{id}/chat/send', [SellerChatController::class, 'send'])->name('orders.chat.send');
});

Route::post('/pagar', [ClientOrderController::class, 'pagar'])
    ->middleware(['auth','customer'])
    ->name('cliente.pagar');

Route::post('/pago/confirmado', [ClientOrderController::class, 'confirmarPago'])
    ->middleware(['auth','customer'])
    ->name('cliente.pago.confirmar');
*/