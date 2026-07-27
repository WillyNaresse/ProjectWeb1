document.addEventListener('DOMContentLoaded', () => {
    carregarMeusAnuncios();
});

async function carregarMeusAnuncios() {
    try {
        const res = await fetchAPI('/meus-anuncios');
        if (res.success) {
            renderizar(res.data);
        } else {
            alert('Erro ao carregar os anúncios.');
        }
    } catch (e) {
        if (e.message.includes('401')) {
            window.location.href = 'login.php';
        }
    }
}

function renderizar(anuncios) {
    const tbody = document.getElementById('meus-anuncios-tbody');
    if (!tbody) return;

    tbody.innerHTML = ''; // Limpa antes de popular de forma segura

    if (anuncios.length === 0) {
        const tr = document.createElement('tr');
        const td = document.createElement('td');
        td.colSpan = 5;
        td.textContent = 'Você ainda não possui anúncios.';
        tr.appendChild(td);
        tbody.appendChild(tr);
        return;
    }

    anuncios.forEach(anuncio => {
        const tr = document.createElement('tr');

        // Foto
        const tdFoto = document.createElement('td');
        const img = document.createElement('img');
        img.src = anuncio.FotoPrincipal ? `uploads/veiculos/${anuncio.FotoPrincipal}` : 'assets/images/default.png';
        img.alt = anuncio.Modelo;
        img.style.width = '80px';
        img.style.height = '50px';
        img.style.objectFit = 'cover';
        img.style.borderRadius = '4px';
        tdFoto.appendChild(img);
        tr.appendChild(tdFoto);

        // Marca/Modelo
        const tdModelo = document.createElement('td');
        tdModelo.textContent = `${anuncio.Marca} ${anuncio.Modelo}`;
        tr.appendChild(tdModelo);

        // Ano
        const tdAno = document.createElement('td');
        tdAno.textContent = anuncio.Ano;
        tr.appendChild(tdAno);

        // Valor
        const tdValor = document.createElement('td');
        tdValor.textContent = parseFloat(anuncio.Valor).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        tr.appendChild(tdValor);

        // Ações
        const tdAcoes = document.createElement('td');
        const divAcoes = document.createElement('div');
        divAcoes.className = 'action-buttons';

        const btnVer = document.createElement('a');
        btnVer.href = `anuncio.php?id=${anuncio.Id}`;
        btnVer.className = 'btn btn-primary';
        btnVer.style.padding = '0.4rem 0.8rem';
        btnVer.style.fontSize = '0.9rem';
        btnVer.style.marginRight = '0.5rem';
        btnVer.textContent = 'Ver';
        divAcoes.appendChild(btnVer);

        const btnInteresses = document.createElement('a');
        btnInteresses.href = `interesses.php?id=${anuncio.Id}`;
        btnInteresses.className = 'btn btn-secondary';
        btnInteresses.style.padding = '0.4rem 0.8rem';
        btnInteresses.style.fontSize = '0.9rem';
        btnInteresses.style.marginRight = '0.5rem';
        btnInteresses.textContent = 'Mensagens';
        divAcoes.appendChild(btnInteresses);

        const btnExcluir = document.createElement('button');
        btnExcluir.type = 'button';
        btnExcluir.className = 'btn btn-danger';
        btnExcluir.style.padding = '0.4rem 0.8rem';
        btnExcluir.style.fontSize = '0.9rem';
        btnExcluir.textContent = 'Excluir';
        btnExcluir.onclick = () => excluirAnuncio(anuncio.Id);
        divAcoes.appendChild(btnExcluir);

        tdAcoes.appendChild(divAcoes);
        tr.appendChild(tdAcoes);

        tbody.appendChild(tr);
    });
}

async function excluirAnuncio(id) {
    if (!confirm('Tem certeza que deseja excluir este anúncio?')) return;

    try {
        const res = await fetchAPI(`/anuncios/${id}`, { method: 'DELETE' });
        if (res.success) {
            alert('Anúncio excluído com sucesso.');
            carregarMeusAnuncios();
        }
    } catch (e) {
        alert(e.message || 'Erro ao excluir.');
    }
}
