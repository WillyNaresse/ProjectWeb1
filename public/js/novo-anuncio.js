document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('form-novo-anuncio');
    if (form) {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const formData = new FormData(form);

            let formValido = true;
            for (let [key, value] of formData.entries()) {
                if (value === '' || (value instanceof File && value.name === '')) {
                    formValido = false;
                }
            }
            
            let countFotos = 0;
            const inputFotos = document.getElementById('fotos');
            if (inputFotos && inputFotos.files) {
                countFotos = inputFotos.files.length;
            }

            if (!formValido) {
                alert('Por favor, preencha todos os campos obrigatórios.');
                return;
            }

            if (countFotos < 3) {
                alert('De acordo com as regras do sistema, é necessário enviar no mínimo 3 fotos do veículo.');
                return;
            }

            try {
                // fetchAPI configurado para não setar Content-Type se o body for FormData
                const res = await fetchAPI('/anuncios', {
                    method: 'POST',
                    body: formData
                });

                if (res.success) {
                    alert('Anúncio cadastrado com sucesso!');
                    window.location.href = 'meus-anuncios.php';
                }
            } catch (error) {
                alert(error.message || 'Erro ao cadastrar anúncio.');
            }
        });
    }
});
