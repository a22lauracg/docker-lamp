<div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo isset($nombre) ? ($nombre) : '' ?>" required>
</div>
<div class="mb-3">
    <label for="apellidos" class="form-label">Apellidos</label>
    <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo isset($apellidos) ? ($apellidos) : '' ?>" required>
</div>
<div class="mb-3">
    <label for="rol" class="form-label">Rol</label>
    <select class="form-select" id="rol" name="rol" required>
        <option value="" <?php echo isset($rol) ? '' : 'selected' ?> disabled>Seleccione el tipo de usuario</option>
        <option value="usuario_registrado" <?php echo isset($rol) && $rol == 'usuario_registrado' ? 'selected' : '' ?> >Usuario resgistrado</option>
        <option value="administrador" <?php echo isset($rol) && $rol == 'administrador' ? 'selected' : '' ?> >Administrador</option>
    </select>
</div>
<div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($username) ? ($username) : '' ?>" required>
</div>