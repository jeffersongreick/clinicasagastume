<h1 class="title3">Usuarios</h1>
<div class="table_list" style="overflow-y: scroll;">
    <table>
        <tbody>
            <tr onclick="mostrarDetalles(this)">
                <td>
                    <img src="<?php echo URL ?>public/img/tic.png"/> Administrador
                </td>
                <td>
                    <input type="button" value="Editar"/>
                </td>
                <td>
                    <input type="button" value="Eliminar"/>
                </td>
            </tr>
            <tr onclick="mostrarDetalles(this)">
                <td>
                    <img src="<?php echo URL ?>public/img/tic.png"/> Gerardo Sagastume
                </td>
                <td>
                    <input type="button" value="Editar"/>
                </td>
                <td>
                    <input type="button" value="Eliminar"/>
                </td>
            </tr>
            <tr onclick="mostrarDetalles(this)">
                <td>
                    <img src="<?php echo URL ?>public/img/tic.png"/> Graciela Rué
                </td>
                <td>
                    <input type="button" value="Editar"/>
                </td>
                <td>
                    <input type="button" value="Eliminar"/>
                </td>
            </tr>
            <tr onclick="mostrarDetalles(this)">
                <td>
                    <img src="<?php echo URL ?>public/img/tic.png"/> Katia Massa
                </td>
                <td>
                    <input type="button" value="Editar"/>
                </td>
                <td>
                    <input type="button" value="Eliminar"/>
                </td>
            </tr>
            <tr onclick="mostrarDetalles(this)"><td><img src="<?php echo URL ?>public/img/tic.png"/>Andrea Suarez</td>
                <td>
                    <input type="button" value="Editar"/>
                </td>
                <td>
                    <input type="button" value="Eliminar"/>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div id="detalles_usuario">
    <h1 class="title3">Detalles</h1>
    <div style="width: 700px;display: inline-block;float: left;">
        <label for="ci">ci:</label><input  name="ci" maxlength="8" type="text"/>
        <label for="rol">Rol:</label>
        <select name="confirm_password">
            <option value="1"/>Usuario
            <option value="2"/>Administrador
        </select><br/>
        <label for="nombre">Nombres:</label><input id="detail_name" name="nombre" type="text" style="width: 530px"/><br/>
        <label for="apellido">Apellidos:</label><input name="apellido" type="text" style="width: 530px"/><br/>
        <label for="email">Email:</label><input name="email" type="email" style="width: 530px"/><br/>
    </div>
    <img style="float: left;border: solid 5px white;margin: 0 15px;" height="130px" src="<?php echo URL ?>public/img/user_img.png"/>
</div>
<form class="form_usuario">
    <h1 id="title2">
        Datos usuario
    </h1>
    <label for="ci">ci</label><input name="ci" maxlength="8" type="text"/>
    <label for="nombre">Nombres</label><input name="nombre" type="text" style="width: 530px"/>
    <label for="apellido">Apellido</label><input name="apellido" type="text" style="width: 530px"/>
    <label for="email">Email</label><input name="email" type="email" style="width: 530px"/>
    <label for="password" >Password</label><input name="password" type="password"/>
    <label for="confirm_password">Confirme password</label><input name="confirm_password" type="password"/>
    <label for="foto">Foto</label><input onclick="this.focus()" onblur='LimitAttach(this)' name="foto" type="file" style="width: 530px"/>
    <label for="rol">Rol</label>
    <select name="confirm_password">
        <option value="1"/>Usuario
        <option value="2"/>Administrador
    </select>

    <div id="contenedor_botones">
        <input type="button" class="button" id="aceptar" value="Aceptar">
        <input type="button" class="button" id="cancelar" value="Cancelar">
    </div>
</form>

<div id="contenedor_botones">
    <input type="button" class="button"  id="nuevoUsuario" value="Nuevo">
    <input type="button" class="button" onclick="location.href='<?php echo URL ?>usuario/principal/'" id="volver" value="Volver">
</div>
<div class="block"></div>
