<?php session_start(); ?>
<div id="pnlData">
    <p id="patientName">Paciente: <span><?php echo $_SESSION['nombre_paciente'] ?></span></p> 
    <p  id="idTreatment">Tratamiento id: <?php echo $_SESSION['id_tratamiento'] ?></p>
    <p style="margin: 0;">Fecha:<time><?php echo date("d-m-Y"); ?></time></p>
</div>
<ul class="tabs">
    <li class="tab" name="#antMedico"><p>Antecedentes medicos</p></li> 
    <li class="tab" name="#antOdontologicos"><p>Antecedentes odontologicos</p></li> 
    <li class="tab" name="#habHigienicos"><p>Hábitos higiénicos</p></li> 
    <li class="tab" name="#4"><p>Tratamientos realizados</p></li> 
    <li class="tab" name="#5"><p>Síntomas</p></li> 
    <li class="tab" name="#6"><p>Consultas</p></li> 
</ul>
<div id="antMedico" class="form">
    <div id="listAntMedico" class="table_list" style="overflow-y: scroll;">
        <table>
            <tbody>
                <tr class="rowHistoria">
                    <td>
                        <img src="<?php echo URL ?>public/img/tic.png"/> Está en tratamiento médico
                    </td>

                    <td>
                        <input type="button" class="visualizarObservaciones" value="observaciones"/>
                    </td>
                    <td>
                        <input type="button" value="Editar"/>
                    </td>
                    <td>
                        <input type="button" value="Eliminar"/>
                    </td>
                    <td class="observacionHistoria">
                        <textarea disabled="disabled" class="observacionesAntecedente"></textarea>
                    </td>
                </tr>
                <tr class="rowHistoria">
                    <td class="dataHistoria">
                        <img src="<?php echo URL ?>public/img/tic.png"/> Toma medicamentos
                    </td>
                    <td class="dataHistoria">
                        <input type="button" class="visualizarObservaciones" value="observaciones"/>
                    </td>
                    <td class="dataHistoria">
                        <input type="button" value="Editar"/>
                    </td>
                    <td class="dataHistoria">
                        <input type="button" value="Eliminar"/>
                    </td>
                    <td class="observacionHistoria">
                        <textarea disabled="disabled" class="observacionesAntecedente"></textarea>
                    </td>
                </tr>
                <tr class="rowHistoria">
                    <td class="dataHistoria">
                        <img src="<?php echo URL ?>public/img/tic.png"/> Padece enfermedades cardiovasculares (infarto, angina, soplo)?
                    </td>
                    <td class="dataHistoria">
                        <input type="button" class="visualizarObservaciones" value="observaciones"/>
                    </td>
                    <td class="dataHistoria">
                        <input type="button" value="Editar"/>
                    </td>
                    <td class="dataHistoria">
                        <input type="button" value="Eliminar"/>
                    </td>
                    <td class="observacionHistoria">
                        <textarea class="observacionesAntecedente"></textarea>
                    </td>
                </tr>
                <tr class="rowHistoria">
                    <td class="dataHistoria">
                        <img src="<?php echo URL ?>public/img/tic.png"/> Padece Arritmia, Hipertensión, Fiebre Reumática
                    </td>
                    <td class="dataHistoria">
                        <input type="button" class="visualizarObservaciones" value="observaciones"/>
                    </td>
                    <td class="dataHistoria">
                        <input type="button" value="Editar"/>
                    </td>
                    <td class="dataHistoria">
                        <input type="button" value="Eliminar"/>
                    </td>
                    <td class="observacionHistoria">
                        <textarea class="observacionesAntecedente"></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div id="contenedor_botones">
        <input type="button" class="button" id="btnNuevoAntecedenteMedico" value="Agregar antecedente"/>
        <input type="button" class="button" value="Volver"/>
    </div>

    <div id="ventanaNuevoAntecedente">
        <p class="title3">Ingresar antecedente</p>
        <select class="option_list_antecedentes">
            <option>Está en tratamiento médico                </option>
            <option>Padece Arritmia, Hipertensión, Fiebre Reumática</option>
            <option>Es alérgico</option>
        </select>
        <textarea class="observacionesAntecedente" rows="1" cols="3"></textarea>
        <div id="contenedor_botones">
            <input type="button" class="button" id="btnNuevoAntecedenteMedico" value="Aceptar"/>
            <input type="button" class="button" id="btn_cancel_antecedente" value="Cancelar"/>
        </div>
        <img id="img_load" src="<?php echo URL ?>public/img/loader.gif" style="display: none; margin:0 auto 0 auto;"/>
    </div>
</div>
<div id="antOdontologicos" class="form">
    <div id="listAntMedico" class="table_list" style="overflow-y: scroll;">
        <table class="tableHistoria" >
            <tbody>
                <tr class="rowHistoria">
                    <td class="dataHistoria">
                        <img src="<?php echo URL ?>public/img/tic.png"/> Recibió educación para la salud
                    </td>
                    <td class="dataHistoria">
                        <input type="button" class="visualizarObservaciones" value="observaciones"/>
                    </td>
                    <td class="dataHistoria">
                        <input type="button" value="Editar"/>
                    </td>
                    <td class="dataHistoria">
                        <input type="button" value="Eliminar"/>
                    </td>
                    <td class="observacionHistoria">
                        <textarea class="observacionesAntecedente"></textarea>
                    </td>
                </tr>
                <tr class="rowHistoria">
                    <td class="dataHistoria">
                        <img src="<?php echo URL ?>public/img/tic.png"/> Se hizo extracciones con problemas
                    </td>
                    <td class="dataHistoria">
                        <input type="button" class="visualizarObservaciones" value="observaciones"/>
                    </td>
                    <td class="dataHistoria">
                        <input type="button" value="Editar"/>
                    </td>
                    <td class="dataHistoria">
                        <input type="button" value="Eliminar"/>
                    </td>
                    <td class="observacionHistoria">
                        <textarea class="observacionesAntecedente"></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div id="contenedor_botones">
        <input type="button" class="button" id="btnNuevoAntecedenteMedico" value="Agregar antecedente"/>
        <input type="button" class="button" value="Volver"/>
    </div>

    <div id="ventanaNuevoAntecedente">
        <p class="title3">Ingresar antecedente</p>
        <select class="option_list_antecedentes">
            <option>Está en tratamiento médico                </option>
            <option>Padece Arritmia, Hipertensión, Fiebre Reumática</option>
            <option>Es alérgico</option>
        </select>
        <textarea class="observacionesAntecedente" rows="1" cols="3"></textarea>
        <div id="contenedor_botones">
            <input type="button" class="button" id="btnNuevoAntecedenteMedico" value="Aceptar"/>
            <input type="button" class="button" id="btn_cancel_antecedente" value="Cancelar"/>
        </div>
        <img id="img_load" src="<?php echo URL ?>public/img/loader.gif" style="display: none; margin:0 auto 0 auto;"/>
    </div>
</div>
<div id="habHigienicos" class="form">
    <div id="listAntMedico" class="table_list" style="overflow-y: scroll;">
        <table class="tableHistoria" >
            <tbody>
                <tr class="rowHistoria">
                    <td class="dataHistoria">
                        <img src="<?php echo URL ?>public/img/tic.png"/> Utiliza enjuagues fluorados
                    </td>
                    <td class="dataHistoria">
                        <input type="button" class="visualizarObservaciones" value="observaciones"/>
                    </td>
                    <td class="dataHistoria">
                        <input type="button" value="Editar"/>
                    </td>
                    <td class="dataHistoria">
                        <input type="button" value="Eliminar"/>
                    </td>
                    <td class="observacionHistoria">
                        <textarea class="observacionesAntecedente"></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div id="contenedor_botones">
        <input type="button" class="button" id="btnNuevoAntecedenteMedico" value="Agregar antecedente"/>
        <input type="button" class="button" value="Volver"/>
    </div>

    <div id="ventanaNuevoAntecedente">
        <p class="title3">Ingresar antecedente</p>
        <select class="option_list_antecedentes">
            <option>Está en tratamiento médico                </option>
            <option>Padece Arritmia, Hipertensión, Fiebre Reumática</option>
            <option>Es alérgico</option>
        </select>
        <textarea class="observacionesAntecedente" rows="1" cols="3"></textarea>
        <div id="contenedor_botones">
            <input type="button" class="button" id="btnNuevoAntecedenteMedico" value="Aceptar"/>
            <input type="button" class="button" id="btn_cancel_antecedente" value="Cancelar"/>
        </div>
        <img id="img_load" src="<?php echo URL ?>public/img/loader.gif" style="display: none; margin:0 auto 0 auto;"/>
    </div>
</div>
<div class="block"></div>
