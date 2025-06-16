<div class="max-w-md mx-auto mt-10">
  <div class="bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Registro de Usuario</h2>
    <?php if (isset($error)): ?>
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <?= $error ?>
      </div>
    <?php endif; ?>
    <form action="/register" method="post" class="space-y-5">
<input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
        <input id="name" name="name" type="text" required class="form-input" placeholder="Tu nombre">
      </div>
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input id="email" name="email" type="email" required class="form-input" placeholder="ejemplo@dominio.com">
      </div>
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
        <input id="password" name="password" type="password" required class="form-input" placeholder="••••••••">
      </div>
      <div>
        <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition">Registrar</button>
      </div>
    </form>
    <p class="mt-4 text-center text-sm text-gray-600">¿Ya tienes cuenta? <a href="/" class="text-secondary hover:text-primary">Iniciar sesión</a></p>
  </div>
</div>