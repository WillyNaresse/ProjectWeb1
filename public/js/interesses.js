document.addEventListener('DOMContentLoaded', () => {
    // Verifica se veio um ID específico na URL
    const params = new URLSearchParams(window.location.search);
    const idAnuncio = params.get('id');

    if (idAnuncio) {
        carregarInteressesPorAnuncio(idAnuncio);
    } else {
        carregarTodosInteresses();
    }
});

async function carregarTodosInteresses() {
    try {
        const res = await fetchAPI('/meus-interesses');
        if (res.success) {
            renderizar(res.data, true); // true = mostra coluna de veículo
        } else {
            alert('Erro ao carregar mensagens.');
        }
    } catch (e) {
        if (e.message.includes('401')) {
            window.location.href = 'login.php';
        }
    }
}

async function carregarInteressesPorAnuncio(idAnuncio) {
    try {
        // Aproveita e busca o nome do anúncio para o título
        fetchAPI(`/anuncios/${idAnuncio}`).then(res => {
            if (res.success && res.data) {
                const title = document.getElementById('interesses-title');
                if (title) title.textContent = `Mensagens: ${res.data.Marca} ${res.data.Modelo}`;
            }
        }).catch(() => {});

        const res = await fetchAPI(`/anuncios/${idAnuncio}/interesses`);
        if (res.success) {
            renderizar(res.data, false); // false = não precisa mostrar coluna de veículo repetida (opcional)
        } else {
            alert('Erro ao carregar mensagens.');
        }
    } catch (e) {
        if (e.message.includes('401')) {
            window.location.href = 'login.php';
        }
    }
}

function renderizar(interesses, mostrarVeiculo) {
    const tbody = document.getElementById('interesses-tbody');
    if (!tbody) return;

    tbody.innerHTML = ''; // Limpa antes de popular de forma segura

    if (interesses.length === 0) {
        const tr = document.createElement('tr');
        const td = document.createElement('td');
        td.colSpan = 5;
        td.textContent = 'Nenhuma mensagem de interesse encontrada.';
        tr.appendChild(td);
        tbody.appendChild(tr);
        return;
    }

    interesses.forEach(interesse => {
        const tr = document.createElement('tr');

        // Veículo
        const tdVeiculo = document.createElement('td');
        if (mostrarVeiculo && interesse.Marca && interesse.Modelo) {
            tdVeiculo.style.fontWeight = '500';
            tdVeiculo.textContent = `${interesse.Marca} ${interesse.Modelo}`;
        } else if (!mostrarVeiculo) {
            tdVeiculo.style.fontWeight = '500';
            tdVeiculo.textContent = `(Este Veículo)`;
        } else {
            tdVeiculo.textContent = 'Veículo Excluído';
        }
        tr.appendChild(tdVeiculo);

        // Interessado(a)
        const tdNome = document.createElement('td');
        tdNome.textContent = interesse.Nome;
        tr.appendChild(tdNome);

        // Contato
        const tdContato = document.createElement('td');
        const divTel = document.createElement('div');
        divTel.style.marginBottom = '0.2rem';
        divTel.textContent = interesse.Telefone;
        tdContato.appendChild(divTel);
        
        // Simulação de badge de whatsapp
        const spanWpp = document.createElement('span');
        spanWpp.style.fontSize = '0.8rem';
        spanWpp.style.backgroundColor = '#25D366';
        spanWpp.style.color = 'white';
        spanWpp.style.padding = '0.1rem 0.4rem';
        spanWpp.style.borderRadius = '4px';
        spanWpp.textContent = 'Telefone';
        tdContato.appendChild(spanWpp);
        
        tr.appendChild(tdContato);

        // Mensagem
        const tdMsg = document.createElement('td');
        const pMsg = document.createElement('p');
        pMsg.style.fontSize = '0.9rem';
        pMsg.style.maxWidth = '300px';
        pMsg.style.color = 'var(--text-muted)';
        pMsg.textContent = interesse.Mensagem;
        tdMsg.appendChild(pMsg);
        tr.appendChild(tdMsg);

        // Ações
        const tdAcoes = document.createElement('td');
        const btnExcluir = document.createElement('button');
        btnExcluir.type = 'button';
        btnExcluir.className = 'btn btn-danger';
        btnExcluir.style.padding = '0.4rem 0.8rem';
        btnExcluir.style.fontSize = '0.9rem';
        btnExcluir.textContent = 'Excluir';
        btnExcluir.onclick = () => excluirInteresse(interesse.Id);
        tdAcoes.appendChild(btnExcluir);
        tr.appendChild(tdAcoes);

        tbody.appendChild(tr);
    });
}

async function excluirInteresse(id) {
    if (!confirm('Tem certeza que deseja excluir esta mensagem?')) return;

    try {
        const res = await fetchAPI(`/interesses/${id}`, { method: 'DELETE' });
        if (res.success) {
            alert('Mensagem excluída com sucesso.');
            // Recarrega a página atual para facilitar (mantém estado da URL)
            window.location.reload();
        }
    } catch (e) {
        alert(e.message || 'Erro ao excluir mensagem.');
    }
}
