document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="_token"]').getAttribute('content');
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
            alert(data.MESSAGE);
            btnEnviar.disabled = false;
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al enviar datos');
            btnEnviar.disabled = false;
        });
    });
});