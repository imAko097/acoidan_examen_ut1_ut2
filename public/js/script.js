document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="_token"]').getAttribute('content');
    
    // Nuevo
    const formNuevo = document.getElementById('formNuevo');
    formNuevo.addEventListener('submit', function (event) {
        event.preventDefault();

        const btnEnviar = document.querySelector('button[type="submit"]');
        btnEnviar.disabled = true;
        
        // Valores del formulario
        const nuevoMensaje = document.getElementById('nuevoMensaje').value;
        const negrita = document.getElementById('negrita').checked;
        const subrayado = document.getElementById('subrayado').checked;
        
        // Enviar datos al servidor
        fetch('/messages', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                text: nuevoMensaje,
                negrita: negrita,
                subrayado: subrayado
            }),
        })
        .then(response => response.json())
        .then(data => {
            const mensajeAviso = document.getElementById('mensajeAviso');
            mensajeAviso.style.backgroundColor = '#b1ee46';
            mensajeAviso.style.color = 'white';
            mensajeAviso.innerHTML = data.MESSAGE;
            btnEnviar.disabled = false;
            setTimeout(() => {
                mensajeAviso.remove();
                window.location.reload();
            }, 2000);
        })
        .catch(error => {
            console.error('Error:', error);
            const mensajeAviso = document.getElementById('mensajeAviso');
            mensajeAviso.style.backgroundColor = '#f44336';
            mensajeAviso.style.color = 'white';
            mensajeAviso.innerHTML = 'Error al enviar mensaje';
            btnEnviar.disabled = false;
            setTimeout(() => {
                mensajeAviso.remove();
                window.location.reload();
            }, 2000);
        });
    });

    // Modificar
    const divModificar = document.getElementById('divModificar');
    const btnModificar = document.querySelectorAll('button[id^="btnModificar-"]');
    btnModificar.forEach(btn => {
        btn.addEventListener('click', function () {
            if (divModificar.style.display === 'none') {
                divModificar.style.display = 'block';
            } else {
                divModificar.style.display = 'none';
            }
        });
    });
});