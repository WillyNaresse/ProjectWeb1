document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    if (!form) return;

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const nome = document.getElementById('nome').value;
        const cpf = document.getElementById('cpf').value;
        const telefone = document.getElementById('telefone').value;
        const email = document.getElementById('email').value;
        const senha = document.getElementById('senha').value;
        const senhaConfirm = document.getElementById('senhaConfirm').value;

        if (!nome || !cpf || !telefone || !email || !senha || !senhaConfirm) {
            alert('Por favor, preencha todos os campos obrigatórios.');
            return;
        }

        if (senha !== senhaConfirm) {
            alert('As senhas não coincidem!');
            return;
        }

        try {
            const res = await fetchAPI('/cadastrar', {
                method: 'POST',
                body: JSON.stringify({ nome, cpf, telefone, email, senha })
            });

            if (res.success) {
                alert('Cadastro realizado com sucesso! Faça login.');
                window.location.href = 'login.php';
            }
        } catch (error) {
            alert(error.message);
        }
    });
});
