document.addEventListener('DOMContentLoaded', () => {
    checkAuthStatus();
});

async function checkAuthStatus() {
    try {
        const res = await fetchAPI('/me');
        if (res.success && res.user) {
            updateNavbarLogado(res.user.nome);
        }
    } catch (e) {
        // Não logado
        updateNavbarDeslogado();
    }
}

function updateNavbarLogado(nome) {
    const navLinks = document.querySelector('.nav-links');
    if (navLinks) {
        navLinks.innerHTML = ''; // Limpa de forma segura pois nós criaremos elementos
        
        const aInicio = document.createElement('a');
        aInicio.href = 'index.php';
        aInicio.textContent = 'Início';
        navLinks.appendChild(aInicio);

        const aMeus = document.createElement('a');
        aMeus.href = 'meus-anuncios.php';
        aMeus.textContent = 'Meus Anúncios';
        navLinks.appendChild(aMeus);

        const aPerfil = document.createElement('a');
        aPerfil.href = 'perfil.php';
        aPerfil.textContent = 'Meu Perfil';
        navLinks.appendChild(aPerfil);

        const spanOla = document.createElement('span');
        spanOla.style.color = '#666';
        spanOla.style.marginLeft = '10px';
        spanOla.textContent = `Olá, ${nome}`;
        navLinks.appendChild(spanOla);

        const aSair = document.createElement('a');
        aSair.href = '#';
        aSair.className = 'btn btn-primary';
        aSair.style.color = 'white';
        aSair.style.marginLeft = '10px';
        aSair.textContent = 'Sair';
        aSair.onclick = (e) => { e.preventDefault(); logout(); };
        navLinks.appendChild(aSair);
    }
}

function updateNavbarDeslogado() {
    const navLinks = document.querySelector('.nav-links');
    if (navLinks && !navLinks.querySelector('a[href="cadastro.php"]')) {
        navLinks.innerHTML = ''; // Limpa

        const aInicio = document.createElement('a');
        aInicio.href = 'index.php';
        aInicio.textContent = 'Início';
        navLinks.appendChild(aInicio);

        const aLogin = document.createElement('a');
        aLogin.href = 'login.php';
        aLogin.textContent = 'Login';
        navLinks.appendChild(aLogin);

        const aCadastro = document.createElement('a');
        aCadastro.href = 'cadastro.php';
        aCadastro.className = 'btn btn-primary';
        aCadastro.style.color = 'white';
        aCadastro.textContent = 'Criar Conta';
        navLinks.appendChild(aCadastro);
    }
}

async function logout() {
    try {
        await fetchAPI('/logout', { method: 'POST' });
        window.location.href = 'index.php';
    } catch (e) {
        alert('Erro ao sair.');
    }
}

function somenteNumeros(valor) {
    return valor.replace(/\D/g, '');
}

function formatarCPF(valor) {
    const numeros = somenteNumeros(valor).slice(0, 11);

    return numeros
        .replace(/(\d{3})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d{1,2})$/, '$1-$2');
}

function formatarTelefone(valor) {
    const numeros = somenteNumeros(valor).slice(0, 11);

    if (numeros.length <= 10) {
        return numeros
            .replace(/^(\d{2})(\d)/, '($1) $2')
            .replace(/(\d{4})(\d)/, '$1-$2');
    }

    return numeros
        .replace(/^(\d{2})(\d)/, '($1) $2')
        .replace(/(\d{5})(\d)/, '$1-$2');
}

function aplicarMascara(campo, formatador) {
    if (!campo) {
        return;
    }

    campo.addEventListener('input', () => {
        campo.value = formatador(campo.value);
    });
}