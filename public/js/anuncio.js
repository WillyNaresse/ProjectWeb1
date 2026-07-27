document.addEventListener('DOMContentLoaded', () => {
    // Obter ID da URL
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');

    if (id) {
        carregarDetalhes(id);
    } else {
        alert('Anúncio não especificado!');
        window.location.href = 'index.php';
    }

    const form = document.getElementById('form-interesse');
    if (form) {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            registrarInteresse(id);
        });
    }
});

async function carregarDetalhes(id) {
    try {
        const res = await fetchAPI(`/anuncios/${id}`);
        if (res.success && res.data) {
            preencherDOM(res.data);
        } else {
            alert('Anúncio não encontrado.');
            window.location.href = 'index.php';
        }
    } catch (e) {
        alert('Erro ao carregar detalhes.');
    }
}

function preencherDOM(anuncio) {
    document.title = `${anuncio.Marca} ${anuncio.Modelo} - AutoPortal`;
    document.getElementById('anuncio-title').textContent = `${anuncio.Marca} ${anuncio.Modelo} - ${anuncio.Ano}`;
    
    const preco = parseFloat(anuncio.Valor).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    document.getElementById('anuncio-preco').textContent = preco;

    document.getElementById('anuncio-marca').textContent = anuncio.Marca;
    document.getElementById('anuncio-modelo').textContent = anuncio.Modelo;
    document.getElementById('anuncio-ano').textContent = anuncio.Ano;
    document.getElementById('anuncio-cor').textContent = anuncio.Cor;
    document.getElementById('anuncio-km').textContent = anuncio.Quilometragem;
    document.getElementById('anuncio-estado').textContent = anuncio.Estado;
    document.getElementById('anuncio-cidade').textContent = anuncio.Cidade;
    document.getElementById('anuncio-desc').textContent = anuncio.Descricao;

    // Lida com as fotos
    const mainImg = document.getElementById('main-img');
    const thumbContainer = document.getElementById('thumbnails-container');
    thumbContainer.innerHTML = ''; // Limpa as thumbs de forma segura (vamos adicionar elementos logo abaixo)

    if (anuncio.fotos && anuncio.fotos.length > 0) {
        mainImg.src = `uploads/veiculos/${anuncio.fotos[0].NomeArqFoto}`;
        
        anuncio.fotos.forEach(foto => {
            const thumb = document.createElement('img');
            thumb.src = `uploads/veiculos/${foto.NomeArqFoto}`;
            thumb.className = 'thumb-img';
            thumb.style.cursor = 'pointer';
            thumb.onclick = () => {
                mainImg.src = thumb.src;
            };
            thumbContainer.appendChild(thumb);
        });
    } else {
        mainImg.src = 'assets/images/default.png';
    }
}

async function registrarInteresse(idAnuncio) {
    const nome = document.getElementById('int-nome').value;
    const telefone = document.getElementById('int-telefone').value;
    const mensagem = document.getElementById('int-mensagem').value;

    if (!nome || !telefone || !mensagem) {
        alert('Por favor, preencha todos os campos do formulário de contato.');
        return;
    }

    try {
        const res = await fetchAPI('/interesses', {
            method: 'POST',
            body: JSON.stringify({
                nome: nome,
                telefone: telefone,
                mensagem: mensagem,
                id_anuncio: idAnuncio
            })
        });

        if (res.success) {
            alert('Seu interesse foi registrado! O dono do veículo será notificado.');
            document.getElementById('form-interesse').reset();
        }
    } catch (e) {
        alert(e.message || 'Erro ao enviar interesse.');
    }
}
