document.addEventListener('keyup', e => {
    if (e.target.matches('#buscadorEstado')) {
        const valorBuscado = e.target.value.toLowerCase();

        document.querySelectorAll('.estado').forEach(estado => {
            const textoEstado = estado.textContent.toLowerCase();
            const fila = estado.closest('tr');

            // Comprobar si el texto del estado incluye el valor buscado
            if (textoEstado.includes(valorBuscado)) {
                fila.classList.remove('filtro');
            } else {
                fila.classList.add('filtro');
            }
        });
    }
});
