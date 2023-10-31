		<?php
		include "Views/Templates/header.php"; ?>
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3 profile">Perfil</div>
					<div class="ps-3">
						<!-- <nav aria-label="breadcrumb">
		          <ol class="breadcrumb mb-0 p-0">
		            <li class="breadcrumb-item active" aria-current="page">Gestión</li>
		            </li>
		            <li class="breadcrumb-item active" aria-current="page">Perfil</li>
		          </ol>
		        </nav> -->
					</div>
				</div>
				<!--end breadcrumb-->
				<div class="container">
					<div class="main-body">
						<div class="row">
							<div class="row">
								<div class="col-lg-4">
									<div class="card">
										<div class="card-body">
											<div class="d-flex flex-column align-items-center text-center">
												<img src="<?php echo BASE_URL; ?>assets/images/avatars/usuario.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
												<div class="mt-3">
													<?php

													$id_usuario = $data['us_id'];
													$correo = $data['cor_us'];
													$fecha_creacion = $data['fec_cr_us'];
													$fecha_actualización = $data['fec_act_us'];
													$rol = $data['tp_rol'];
													$password = $data['con_us'];

													$usuario = $data['nom_us'];
													?>

													<h4><?php echo $usuario ?></h4>
													<p class="text-secondary mb-2"><?php echo $correo ?></p>
													<p class="text-secondary mb-2">Fecha creación: <?php echo $fecha_creacion ?></p>
													<p class="text-secondary mb-2">Última actualización: <?php echo $fecha_actualización ?></p>
												</div>

											</div>
											<hr class="my-4" />
											<p class="text-secondary text-center"><?php echo $rol ?></p>
											<div class="row text-center">
												<input id="btnCambiarPass" type="submit" class="btn btn-primary px-4" value="Cambiar contraseña" />
											</div>


										</div>
									</div>
								</div>
								<div class="col-lg-8">
									<div class="card">
										<div class="card-body">

											<form action="post" id="frmPerfil">
												<input type="hidden" id="id_hidden" name="id_hidden" value="<?php echo $id_usuario ?>">
												<input type="hidden" id="USUARIO_HIDDEN" name="USUARIO_HIDDEN" value="<?php echo $usuario ?>">
												<input type="hidden" id="CORREO_HIDDEN" name="CORREO_HIDDEN" value="<?php echo $correo ?>">

												<div class="formulario__grupo" id="grupo__usuario">
													<div class="form-group formulario__grupo-input">
														<div class="row mb-3 mt-2">
															<div class="col-sm-3  mt-2">
																<h6 class="mb-0">Usuario</h6>
															</div>
															<div class="col-sm-9 text-secondary">
																<input id="inputUsuario" name="inputUsuario" type="text" class="form-control formulario__input" value="<?php echo $usuario ?>" />
																<i class="formulario__validacion-estado fas fa-times-circle"></i>
															</div>
														</div>
														<p class="formulario__input-error userValidation">El campo usuario permite ingresar entre 5 y 30 caracteres, solo admite letras, numeros, guion y guion bajo, no se permiten carácteres especiales ni espacios.</p>
													</div>
												</div>

												<div class="formulario__grupo" id="grupo__correo">
													<div class="form-group formulario__grupo-input">
														<div class="row mb-3">
															<div class="col-sm-3  mt-2">
																<h6 class="mb-0">Correo</h6>
															</div>
															<div class="col-sm-9 text-secondary">
																<input id="inputCorreo" name="inputCorreo" type="text" class="form-control formulario__input" value="<?php echo $correo ?>" />
																<i class="formulario__validacion-estado fas fa-times-circle"></i>
															</div>
														</div>
														<p class="formulario__input-error emailValidation">El correo eléctronico permite ingresar entre 8 y 50 caracteres ademas debe contener el simbolo de arroba "@" seguido del dominio y por ultimo una extensión (.com,.co,etc).</p>
													</div>
												</div>

												<div class="formulario__grupo" id="grupo__rpñ">
													<div class="form-group formulario__grupo-input">
														<div class="row mb-3">
															<div class="col-sm-3  mt-2">
																<h6 class="mb-0">Rol</h6>
															</div>
															<div class="col-sm-9 text-secondary">
																<input type="text" class="form-control formulario__input" value="<?php echo $rol ?>" disabled />
																<i class="formulario__validacion-estado fas fa-times-circle"></i>
															</div>
														</div>
													</div>
												</div>

												<div class="formulario__grupo" id="grupo__password">
													<div class="form-group formulario__grupo-input">
														<div class="row mb-3">
															<div class="col-sm-3  mt-2">
																<h6 class="mb-0">Contraseña</h6>
															</div>
															<div class="col-sm-9 text-secondary">
																<input type="text" class="form-control formulario__input" value="<?php echo $password ?>" disabled />
																<i class="formulario__validacion-estado fas fa-times-circle"></i>
															</div>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-sm-4"></div>
													<div class="col-sm-8 text-secondary mb-2">
														<input type="submit" class="btn btn-primary px-4" value="Guardar cambios" />
													</div>
												</div>

											</form>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div id="CambiarPass" class="modal fade" tabindex="-1" aria-labelledby="my-modal-title" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header bg-primary">
							<h5 class="modal-title text-white newuser" id="title_modal">Cambiar contraseña</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							</button>
						</div>
						<div class="modal-body">
							<form id="frmCambiarPass">

										<div class="formulario__grupo" id="grupo__actual">
											<div class="form-group formulario__grupo-input">
												<label for="passActual" class="formulario__label passwordAct">Contraseña actual</label>
												<input id="passActual" class="form-control formulario__input" type="password" name="passActual" placeholder="Contraseña">
												<i class="formulario__validacion-estado fas fa-times-circle"></i>
											</div>
											<p class="formulario__input-error passwordValidation">La contraseña debe contener una letra minúscula, una letra mayúscula, un dígito, un carácter especial además la longitud mínima es de 8 caracteres y la longitud máxima es de 100 carácteres.</p>
										</div>
								
										<div class="formulario__grupo" id="grupo__pass1">
											<div class="form-group formulario__grupo-input">
												<label for="passNueva" class="formulario__label passwordNew">Nueva contraseña</label>
												<input id="passNueva" class="form-control formulario__input" type="password" name="passNueva" placeholder="Nueva contraseña">
												<i class="formulario__validacion-estado fas fa-times-circle"></i>
											</div>
											<p class="formulario__input-error passwordValidation">La contraseña debe contener una letra minúscula, una letra mayúscula, un dígito, un carácter especial además la longitud mínima es de 8 caracteres y la longitud máxima es de 100 carácteres.</p>
										</div>
									
										<div class="formulario__grupo" id="grupo__pass2">
											<div class="form-group formulario__grupo-input">
												<label for="passConfirm" class="formulario__label confirmpassword">Confirmar contraseña</label>
												<input id="passConfirm" class="form-control formulario__input" type="password" name="passConfirm" placeholder="Confirmar contraseña">
												<i class="formulario__validacion-estado fas fa-times-circle"></i>
											</div>
											<p class="formulario__input-error confirmPasswordValidation">El campo confirmar contraseña no coincide con el campo nueva contraseña.</p>
									</div>
								

								<!--  -->
								<div class="formulario__mensaje" id="formulario__mensaje">
									<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
								</div>


								<!--  -->
								<div class="d-grid gap-2">
									<button id="btnModal" class="btn btn-primary formulario__btn boton" type="submit">Aceptar</button>
									<button id="btnModal2" class="btn btn-danger formulario__btn2 boton cancel" type="button" data-bs-dismiss="modal">Cancelar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- obtener value desde js -->

			</div>
			<script src="<?php echo BASE_URL; ?>assets/js/modulos/usuarios/perfil.js"></script>
			<?php include "Views/Templates/footer.php"; ?>