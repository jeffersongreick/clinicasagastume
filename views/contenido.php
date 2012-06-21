            <div id="header">
                <h1 id="titulo">Clinica Sagastume</h1>
                <a href="">Cerrar seccion</a>
                <p id="user" style="margin-right: 20px;">Gerardo Sagastume</p>
                <div class="clear"></div>
            </div>
            <div id="aplicacion">

<!-- panel de datos del paciente-->
                <div id="pnlDatos">
                    <p id="nombrePaciente">Paciente: <span>Marciano Durán</span></p> 
                    <a href="" id="idTratamiento">Tratamiento: 16</a>
                    <p style="margin: 0;">Fecha:<time><?php echo date("d-m-Y"); ?></time></p>
                </div>


<!--menu funciones                -->
                <div class="funcion" id="registrosOdontogramas">
                    <ul>
                        <li>
                            <input type="button" id="btnEstadoInicial" class="boton" value="Odontograma estado inicial"/>
                            <ul >
                                <li><a href="odontograma.php"><input type="button" id="btnNuevoEstadoInicial" class="boton" value="Nuevo"/></a></li>
                                <li><a href="odontograma.php"><input type="button" id="btnEditarEstadoInicial" class="boton" value="Editar"/></a></li>
                                <li><a href="odontograma.php"><input type="button" id="btnVisualizarEstadoInicial" class="boton" value="Visualizar"/></a></li>
                            </ul>
                        </li>

                        <li>
                            <input type="button" id="btnOtrosOdontogramas" class="boton" value="Otros odontogramas"/>
                            <ul >
                                <li><a href="odontograma.php"><input type="button" id="btnEstadoActual" class="boton" value="Estado actual"/></a></li>
                                <li><input type="button" id="btnBuscarEstado" class="boton" value="Buscar"/></li>
                            </ul>
                        </li>
                        <li>
                            <input type="button" id="btnCancelarAccion" class="boton" value="Cancelar"/>
                        </li>
                    </ul>
                </div>
<!--menu busqueda de odontogramas-->
                <div id="buscarOdontograma" class="funcion">
                    <p>Desde:</p>
                    <input type="text" id="fromFecha" class="campoTexto" value="Fecha" style="color: gray"/>
                    <p>Hasta:</p>
                    <input type="text" id="toFecha" class="campoTexto" value="Fecha" style="color: gray" />
                    <div class="listado">
                        <table class="tabla">
                            <tr>
                                <td scope="col" style="width: 20%; background-color: #A5DCFF">Id</td>
                                <td scope="col" style="width: 40%; background-color: #A5DCFF">Fecha</td>

                            </tr>
                            <tr>
                                <td scope="row" style="width: 20%">5</td>
                                <td scope="row" style="width: 40%">15/02/11</td>
                            </tr>
                            <tr>
                                <td scope="row" style="width: 20%">19</td>
                                <td scope="row" style="width: 40%">18/02/11</td>
                            </tr>
                            <tr>
                                <td scope="row" style="width: 20%">58</td>
                                <td scope="row" style="width: 40%">25/02/11</td>
                            </tr>
                        </table>
                    </div>
                    <a href="odontograma.php"><input type="button" id="btnAceptarBusqueda" class="boton" value="Aceptar"/></a>
                    <input type="button" id="btnCancelarBusqueda" class="boton" value="Cancelar"/>
                </div>


                <!-- iconos escritorio-->

                <div class="iconoContainer" id="btnRegistroPaciente">
                    <input type="image" src="images/ico_escritorio/ico_registros.png" alt="odontograma"  class="iconos_escritorio" />
                    <div class="nombreFuncion">Registro pacientes</div>
                </div>
                <div class="iconoContainer" id="btnTratamiento">
                    <input type="image" src="images/ico_escritorio/ico_tratamiento.png" alt="odontograma"  class="iconos_escritorio" />
                    <div class="nombreFuncion">Tratamientos</div>
                </div>
                <div class="iconoContainer" id="btnHistoria" >
                    <input type="image" src="images/ico_escritorio/ico_historia.png" alt="odontograma" class="iconos_escritorio" />
                    <div class="nombreFuncion">Historia Clinica</div>
                </div>
                <div class="iconoContainer" id="btnOtros">
                    <input type="image" src="images/ico_escritorio/ico_otros.png" alt="odontograma"  class="iconos_escritorio" />
                    <div class="nombreFuncion">Otros</div>
                </div>
                <div class="block"></div>
            </div>       