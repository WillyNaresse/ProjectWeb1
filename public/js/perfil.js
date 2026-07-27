document.addEventListener('DOMContentLoaded', () => {
    carregarPerfil();
});

async function carregarPerfil() {
    try {
        const resMe = await fetchAPI('/me');
        if (resMe.success && resMe.user) {
            const h2 = document.getElementById('welcome-msg');
            if (h2) h2.textContent = `Bem-vindo, ${resMe.user.nome.split(' ')[0]}!`;
        } else {
            window.location.href = 'login.php';
        }

        const resAnuncios = await fetchAPI('/meus-anuncios');
        if (resAnuncios.success) {
            const countAnuncios = document.getElementById('count-anuncios');
            if (countAnuncios) {
                countAnuncios.textContent = resAnuncios.data.length;
            }
        }
    } catch (e) {
        window.location.href = 'login.php';
    }
}
