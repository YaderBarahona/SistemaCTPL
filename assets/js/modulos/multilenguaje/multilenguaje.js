function loadTranslations(lang) {
  return {
    en: {
      //menu lateral
      dashboard: "Dashboard",
      management: "Management",
      users: "Users",
      rp: "Roles and permissions",
      al: "Access log",
      students: "Students",
      sections: "Sections",
      ah: "Assist History",
      qr: "Scan QR",
      assists: "Assists",

      //perfil
      profile: "Profile",
      taskList: "ToDo List",
      logout: "Logout",

      //
      roles: "Roles",
      section: "Section",

      // botones
      new: "New",

      //modal
      user: "User",
      email: "Email",
      password: "Password",
      confirmpassword: "Confirm password",
      role: "Role",
      cancel: "Cancel",

      //
      roleType: "Rol type",
      description: "Description",
      descriptionRole: "Description role",

      //
      ced: "ID Card",
      fullname: "Full name",
      pa: "First surname",
      sa: "Second surname",

      //validaciones
      userValidation:
        "The user field allows only 5 to 30 characters, only letters, numbers, hyphen and underscore can be typed, no special characters or spaces can be typed.",
      emailValidation:
        "The email address allows you to enter between 8 and 50 characters and must contain the at symbol '@' followed by the domain name and an extension (.com, .co, etc).",
      passwordValidation:
        "The password must contain one lowercase letter, one uppercase letter, one digit, one special character and the minimum length is 8 characters and the maximum length is 100 characters.",
      confirmPasswordValidation:
        "The confirm password field does not match the new password field.",

      //
      rolValidation:
        "The ID field allows you to enter from 1 to 30 characters and can only contain letters, numbers and hyphens.",
      rolDescriptionValidation:
        "The description field allows between 1 and 100 characters and can only contain letters.",

      //
      sectionValidation:
        "The section field allows 3 to 5 characters and can only contain numbers and must include a hyphen between the numbers (1-2 characters before and after the hyphen).",

      //
      cedValidation:
        "The ID field allows you to enter from 8 to 15 characters and can only contain letters, numbers and hyphens.",
      fullnameValidation:
        "The name field allows between 1 and 30 characters and can only contain letters.",
      paValidation:
        "The first surname field allows between 1 and 30 characters and can only contain letters.",
      saValidation:
        "The second last name field allows between 1 and 30 characters and can only contain letters.",
    },
    es: {
      dashboard: "Panel",
      management: "Gestión",
      users: "Usuarios",
      rp: "Roles y Permisos",
      al: "Registro de acceso",
      students: "Estudiantes",
      sections: "Secciones",
      ah: "Historial Asistencias",
      qr: "Escanear QR",
      assists: "Asistencias",

      //perfil
      profile: "Perfil",
      taskList: "Lista de tareas",
      logout: "Cerrar sesión",

      //
      roles: "Roles",
      section: "Sección",

      //botones
      new: "Nuevo",

      //modal
      user: "Usuario",
      email: "Correo eléctronico",
      password: "Contraseña",
      confirmpassword: "Confirmar contraseña",
      role: "Rol",
      cancel: "Cancelar",

      //
      roleType: "Tipo del rol",
      description: "Descripción",
      descriptionRole: "Descripción del rol",

      //
      ced: "Cédula",
      fullname: "Nombre",
      pa: "Primer apellido",
      sa: "Segundo Apellido",

      //validaciones
      userValidation:
        "El campo usuario permite ingresar entre 5 y 30 caracteres, solo admite letras, numeros, guion y guion bajo, no se permiten carácteres especiales ni espacios.",
      emailValidation:
        "El correo electrónico permite ingresar entre 8 y 50 caracteres ademas debe contener el simbolo de arroba '@' seguido del dominio y por ultimo una extensión (.com,.co,etc).",
      passwordValidation:
        "La contraseña debe contener una letra minúscula, una letra mayúscula, un dígito, un carácter especial además la longitud mínima es de 8 caracteres y la longitud máxima es de 100 carácteres.",
      confirmPasswordValidation:
        "El campo confirmar contraseña no coincide con el campo nueva contraseña.",

      //
      rolValidation:
        "El campo cédula permite ingresar de 1 a 30 caracteres y solo puede contener letras, numeros y guiones.",
      rolDescriptionValidation:
        "El campo descripción permite ingresar entre 1 y 100 caracteres y solo puede contener letras.",

      //
      sectionValidation:
        "El campo sección permite ingresar de 3 a 5 caracteres y solo puede contener números y debe incluir guion entre los números (1-2 caracteres antes y despues del guion).",

      //
      cedValidation:
        "El campo cédula permite ingresar de 8 a 15 caracteres y solo puede contener letras, números y guiones.",
      fullnameValidation:
        "El campo nombre permite ingresar entre 1 y 30 caracteres y solo puede contener letras.",
      paValidation:
        "El campo primer apellido permite ingresar entre 1 y 30 caracteres y solo puede contener letras.",
      saValidation:
        "El campo segundo apellido permite ingresar entre 1 y 30 caracteres y solo puede contener letras.",
    },
  }[lang];
}

function saveFlag(flag) {
  if (flag == "en") {
    pickerLenguaje.src = BASE_URL + "assets/images/county/english.png";
  } else {
    pickerLenguaje.src = BASE_URL + "assets/images/county/spanish.png";
  }

  localStorage.setItem("flag", flag);
}

function datatableLenguaje(url) {
  localStorage.setItem("datatableLeng", url);
}

function changeLanguage(lang) {
  const translation = loadTranslations(lang);

  //dashboard
  // document.getElementById("welcome").textContent = translation.welcome;
  document.getElementById("dashboard").textContent = translation.dashboard;
  document.getElementById("SQR").textContent = translation.qr;

  //elementos con la clase "estudiante"
  let leyendaManagement = document.querySelectorAll(".management");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaManagement.forEach(function (elemento) {
    elemento.textContent = translation.management;
  });

  //elementos con la clase "estudiante"
  let leyendaUsuarios = document.querySelectorAll(".users");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaUsuarios.forEach(function (elemento) {
    elemento.textContent = translation.users;
  });

  //elementos con la clase "estudiante"
  let leyendaRolesPermisos = document.querySelectorAll(".rp");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaRolesPermisos.forEach(function (elemento) {
    elemento.textContent = translation.rp;
  });

  //elementos con la clase "estudiante"
  let leyendaRegistro = document.querySelectorAll(".al");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaRegistro.forEach(function (elemento) {
    elemento.textContent = translation.al;
  });

  //elementos con la clase "estudiante"
  let leyendaEstudiantes = document.querySelectorAll(".students");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaEstudiantes.forEach(function (elemento) {
    elemento.textContent = translation.students;
  });

  //elementos con la clase "estudiante"
  let leyendaSecciones = document.querySelectorAll(".sections");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaSecciones.forEach(function (elemento) {
    elemento.textContent = translation.sections;
  });

  //elementos con la clase "estudiante"
  let leyendaHistorial = document.querySelectorAll(".ah");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaHistorial.forEach(function (elemento) {
    elemento.textContent = translation.ah;
  });

  //elementos con la clase "assists"
  let leyendaAsistencias = document.querySelectorAll(".assists");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaAsistencias.forEach(function (elemento) {
    elemento.textContent = translation.assists;
  });

  //elementos con la clase "new"
  let leyendaNuevo = document.querySelectorAll(".new");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaNuevo.forEach(function (elemento) {
    elemento.textContent = translation.new;
  });

  //tablas

  //modals
  //elementos con la clase "new"
  let leyendaUsuario = document.querySelectorAll(".user");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaUsuario.forEach(function (elemento) {
    elemento.textContent = translation.user;
  });

  //elementos con la clase "new"
  let leyendaEmail = document.querySelectorAll(".email");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaEmail.forEach(function (elemento) {
    elemento.innerHTML = translation.email;
  });

  //elementos con la clase "new"
  let leyendaPassword = document.querySelectorAll(".password");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaPassword.forEach(function (elemento) {
    elemento.innerHTML = translation.password;
  });

  //elementos con la clase "new"
  let leyendaConfirmar = document.querySelectorAll(".confirmpassword");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaConfirmar.forEach(function (elemento) {
    elemento.innerHTML = translation.confirmpassword;
  });

  //elementos con la clase "new"
  let leyendaRol = document.querySelectorAll(".role");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaRol.forEach(function (elemento) {
    elemento.innerHTML = translation.role;
  });

  //elementos con la clase "new"
  let leyendaCancelar = document.querySelectorAll(".cancel");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaCancelar.forEach(function (elemento) {
    elemento.innerHTML = translation.cancel;
  });

  //p de validacion
  //elementos con la clase "new"
  let leyendaUserValidation = document.querySelectorAll(".userValidation");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaUserValidation.forEach(function (elemento) {
    elemento.innerHTML = translation.userValidation;
  });

  //elementos con la clase "new"
  let leyendaEmailValidation = document.querySelectorAll(".emailValidation");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaEmailValidation.forEach(function (elemento) {
    elemento.innerHTML = translation.emailValidation;
  });

  //elementos con la clase "new"
  let leyendaPasswordValidation = document.querySelectorAll(
    ".passwordValidation"
  );

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaPasswordValidation.forEach(function (elemento) {
    elemento.innerHTML = translation.passwordValidation;
  });

  //elementos con la clase "new"
  let leyendaConfirmPasswordValidation = document.querySelectorAll(
    ".confirmPasswordValidation"
  );

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaConfirmPasswordValidation.forEach(function (elemento) {
    elemento.innerHTML = translation.confirmPasswordValidation;
  });

  //perfil
  //elementos con la clase "new"
  let leyendaProfile = document.querySelectorAll(".profile");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaProfile.forEach(function (elemento) {
    elemento.innerHTML = translation.profile;
  });

  //elementos con la clase "new"
  let leyendaTaskList = document.querySelectorAll(".taskList");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaTaskList.forEach(function (elemento) {
    elemento.innerHTML = translation.taskList;
  });

  //elementos con la clase "new"
  let leyendaLogout = document.querySelectorAll(".logout");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaLogout.forEach(function (elemento) {
    elemento.innerHTML = translation.logout;
  });

  //
  let leyendaTipoRol = document.querySelectorAll(".roleType");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaTipoRol.forEach(function (elemento) {
    elemento.innerHTML = translation.roleType;
  });

  let leyendaDescription = document.querySelectorAll(".description");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaDescription.forEach(function (elemento) {
    elemento.innerHTML = translation.description;
  });

  let leyendaDescriptionRole = document.querySelectorAll(".descriptionRole");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaDescriptionRole.forEach(function (elemento) {
    elemento.innerHTML = translation.descriptionRole;
  });

  //
  let leyendaValidationRole = document.querySelectorAll(".rolValidation");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaValidationRole.forEach(function (elemento) {
    elemento.innerHTML = translation.rolValidation;
  });

  let leyendaValidationRoleDescription = document.querySelectorAll(
    ".rolDescriptionValidation"
  );

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaValidationRoleDescription.forEach(function (elemento) {
    elemento.innerHTML = translation.rolDescriptionValidation;
  });

  let leyendaSeccion = document.querySelectorAll(".section");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaSeccion.forEach(function (elemento) {
    elemento.innerHTML = translation.section;
  });

  let leyendaValidationSection =
    document.querySelectorAll(".sectionValidation");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaValidationSection.forEach(function (elemento) {
    elemento.innerHTML = translation.sectionValidation;
  });

  //
  let leyendaCed = document.querySelectorAll(".ced");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaCed.forEach(function (elemento) {
    elemento.innerHTML = translation.ced;
  });

  let leyendaFullname = document.querySelectorAll(".fullname");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaFullname.forEach(function (elemento) {
    elemento.innerHTML = translation.fullname;
  });

  let leyendaPa = document.querySelectorAll(".pa");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaPa.forEach(function (elemento) {
    elemento.innerHTML = translation.pa;
  });

  let leyendaSa = document.querySelectorAll(".sa");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaSa.forEach(function (elemento) {
    elemento.innerHTML = translation.sa;
  });

  //
  let leyendaValidationCed = document.querySelectorAll(".cedValidation");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaValidationCed.forEach(function (elemento) {
    elemento.innerHTML = translation.cedValidation;
  });

  let leyendaValidationFullname = document.querySelectorAll(
    ".fullnameValidation"
  );

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaValidationFullname.forEach(function (elemento) {
    elemento.innerHTML = translation.fullnameValidation;
  });

  let leyendaValidationPa = document.querySelectorAll(".paValidation");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaValidationPa.forEach(function (elemento) {
    elemento.innerHTML = translation.paValidation;
  });

  let leyendaValidationSa = document.querySelectorAll(".saValidation");

  // querySelectorAll devuelve una nodeList
  // Itera a través de los elementos y cambia su texto
  leyendaValidationSa.forEach(function (elemento) {
    elemento.innerHTML = translation.saValidation;
  });

  // Guardar el idioma seleccionado en localStorage
  localStorage.setItem("lang", lang);
}

document.addEventListener("DOMContentLoaded", function () {
  let defaultLang = localStorage.getItem("lang");
  let defaultFlag = localStorage.getItem("flag");
  let defaultDatatableLeng = localStorage.getItem("datatableLeng");

  //lenguaje predeterminado
  if (!defaultLang) {
    defaultLang = "es";
  }

  //bandera predeterminada
  if (!defaultFlag) {
    defaultFlag = "es";
  }

  //lenguaje de datatable predeterminada
  if (!defaultDatatableLeng) {
    defaultDatatableLeng = BASE_URL + "assets/js/modulos/json/Spanish.json";
  }

  changeLanguage(defaultLang);
  saveFlag(defaultFlag);
  datatableLenguaje(defaultDatatableLeng);

  document
    .getElementById("changeToEnglish")
    .addEventListener("click", function () {
      changeLanguage("en");
      saveFlag("en");
      datatableLenguaje(BASE_URL + "assets/js/modulos/json/English.json");
      location.reload();
    });

  document
    .getElementById("changeToSpanish")
    .addEventListener("click", function () {
      changeLanguage("es");
      saveFlag("es");
      datatableLenguaje(BASE_URL + "assets/js/modulos/json/Spanish.json");
      location.reload();
    });
});
