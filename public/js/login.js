document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    if (!form) return;

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const email = document.getElementById('email').value;
        const senha = document.getElementById('senha').value;

        if (!email || !senha) {
            alert('Por favor, preencha o e-mail e a senha.');
            return;
        }

        try {
            const res = await fetchAPI('/login', {
                method: 'POST',
                body: JSON.stringify({ email, senha })
            });

            if (res.success) {
                window.location.href = 'perfil.php'; // Vai para área logada
            }
        } catch (error) {
            alert(error.message);
        }
    });
});
