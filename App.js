document.addEventListener('DOMContentLoaded', function() {
    // Verificar si el usuario está logueado
    const loginLink = document.getElementById('login-link');
    const isLoggedIn = localStorage.getItem('isLoggedIn');

    if (isLoggedIn === 'true') {
        loginLink.textContent = 'Cerrar Sesión';
        loginLink.href = '#';
        loginLink.addEventListener('click', function() {
            localStorage.setItem('isLoggedIn', 'false');
            window.location.href = 'index.html';
        });
    }

    // Manejo del formulario de inicio de sesión
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            if (username === 'admin' && password === 'admin') {
                localStorage.setItem('isLoggedIn', 'true');
                window.location.href = 'index.html';
            } else {
                alert('Usuario o contraseña incorrectos.');
            }
        });
    }

    // Manejo del formulario de agendar cita
    const agendarForm = document.getElementById('agendar-form');
    if (agendarForm) {
        agendarForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const mascota = document.getElementById('mascota').value;
            const servicio = document.getElementById('servicio').value;
            const fecha = document.getElementById('fecha').value;
            const hora = document.getElementById('hora').value;

            const citas = JSON.parse(localStorage.getItem('citas')) || [];
            citas.push({ mascota, servicio, fecha, hora });
            localStorage.setItem('citas', JSON.stringify(citas));

            alert('Cita agendada con éxito.');
            agendarForm.reset();
        });
    }

    // Manejo del formulario de consultar citas
    const consultarForm = document.getElementById('consultar-form');
    if (consultarForm) {
        consultarForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const mascota = document.getElementById('mascota').value;
            const citas = JSON.parse(localStorage.getItem('citas')) || [];
            const citasList = document.getElementById('citas-list');
            citasList.innerHTML = '';

            const citasMascota = citas.filter(cita => cita.mascota === mascota);
            if (citasMascota.length > 0) {
                citasMascota.forEach(cita => {
                    const citaElement = document.createElement('div');
                    citaElement.textContent = `Servicio: ${cita.servicio}, Fecha: ${cita.fecha}, Hora: ${cita.hora}`;
                    const cancelarButton = document.createElement('button');
                    cancelarButton.textContent = 'Cancelar';
                    cancelarButton.addEventListener('click', function() {
                        const index = citas.indexOf(cita);
                        citas.splice(index, 1);
                        localStorage.setItem('citas', JSON.stringify(citas));
                        citaElement.remove();
                        alert('Cita cancelada con éxito.');
                    });
                    citaElement.appendChild(cancelarButton);
                    citasList.appendChild(citaElement);
                });
            } else {
                citasList.textContent = 'No se encontraron citas para esta mascota.';
            }
        });
    }

    // Manejo del formulario de reseñas
    const reseñarForm = document.getElementById('reseñar-form');
    if (reseñarForm) {
        reseñarForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const reseña = document.getElementById('reseña').value;

            const reseñas = JSON.parse(localStorage.getItem('reseñas')) || [];
            reseñas.push(reseña);
            localStorage.setItem('reseñas', JSON.stringify(reseñas));

            alert('Reseña enviada con éxito.');
            reseñarForm.reset();
        });
    }
 
     // Manejo del formulario de gestionar usuarios
     const gestionarUsuarioForm = document.getElementById('gestionar-usuario-form');
     if (gestionarUsuarioForm) {
         gestionarUsuarioForm.addEventListener('submit', function(event) {
             event.preventDefault();
             const nombreUsuario = document.getElementById('nombre-usuario').value;
             const correoUsuario = document.getElementById('correo-usuario').value;
 
             const usuarios = JSON.parse(localStorage.getItem('usuarios')) || [];
             usuarios.push({ nombre: nombreUsuario, correo: correoUsuario });
             localStorage.setItem('usuarios', JSON.stringify(usuarios));
 
             alert('Usuario añadido con éxito.');
             gestionarUsuarioForm.reset();
         });
     }
 
     // Manejo del formulario de gestionar mascotas
     const gestionarMascotaForm = document.getElementById('gestionar-mascota-form');
     if (gestionarMascotaForm) {
         gestionarMascotaForm.addEventListener('submit', function(event) {
             event.preventDefault();
             const nombreMascota = document.getElementById('nombre-mascota').value;
             const tipoMascota = document.getElementById('tipo-mascota').value;
 
             const mascotas = JSON.parse(localStorage.getItem('mascotas')) || [];
             mascotas.push({ nombre: nombreMascota, tipo: tipoMascota });
             localStorage.setItem('mascotas', JSON.stringify(mascotas));
 
             alert('Mascota añadida con éxito.');
             gestionarMascotaForm.reset();
         });
     }
 
     // Manejo del formulario de gestionar servicios
     const gestionarServicioForm = document.getElementById('gestionar-servicio-form');
     if (gestionarServicioForm) {
         gestionarServicioForm.addEventListener('submit', function(event) {
             event.preventDefault();
             const nombreServicio = document.getElementById('nombre-servicio').value;
             const precioServicio = document.getElementById('precio-servicio').value;
 
             const servicios = JSON.parse(localStorage.getItem('servicios')) || [];
             servicios.push({ nombre: nombreServicio, precio: precioServicio });
             localStorage.setItem('servicios', JSON.stringify(servicios));
 
             alert('Servicio añadido con éxito.');
             gestionarServicioForm.reset();
         });
     }
 });
