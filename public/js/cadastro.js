document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');

    if (!form) {
        return;
    }

    const campoCpf = document.getElementById('cpf');
    const campoTelefone = document.getElementById('telefone');

    aplicarMascara(campoCpf, formatarCPF);
    aplicarMascara(campoTelefone, formatarTelefone);

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const nome = document.getElementById('nome').value.trim();
        const cpf = campoCpf.value.trim();
        const telefone = campoTelefone.value.trim();
        const email = document.getElementById('email').value.trim();
        const senha = document.getElementById('senha').value;
        const senhaConfirm = document.getElementById('senhaConfirm').value;

        if (!nome || !cpf || !telefone || !email || !senha || !senhaConfirm) {
            alert('Por favor, preencha todos os campos obrigatórios.');
            return;
        }

        if (somenteNumeros(cpf).length !== 11) {
            alert('Informe um CPF com 11 números.');
            campoCpf.focus();
            return;
        }

        const quantidadeNumerosTelefone = somenteNumeros(telefone).length;

        if (quantidadeNumerosTelefone !== 10 && quantidadeNumerosTelefone !== 11) {
            alert('Informe um telefone com DDD e 10 ou 11 números.');
            campoTelefone.focus();
            return;
        }

        if (senha !== senhaConfirm) {
            alert('As senhas não coincidem!');
            document.getElementById('senhaConfirm').focus();
            return;
        }

        try {
            const res = await fetchAPI('/cadastrar', {
                method: 'POST',
                body: JSON.stringify({
                    nome,
                    cpf,
                    telefone,
                    email,
                    senha
                })
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