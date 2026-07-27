document.addEventListener('DOMContentLoaded', () => {
    carregarMarcas();
    carregarAnuncios();

    const marcaSelect = document.getElementById('marca');
    const modeloSelect = document.getElementById('modelo');
    const btnBuscar = document.querySelector('button[type="button"]'); // Botão buscar veículos

    if (marcaSelect) {
        marcaSelect.addEventListener('change', () => {
            carregarModelos(marcaSelect.value);
            // Ao mudar a marca, limpa a cidade/modelo
            if (modeloSelect) {
                modeloSelect.innerHTML = '';
                const opt = document.createElement('option');
                opt.value = '';
                opt.textContent = 'Todos os modelos';
                modeloSelect.appendChild(opt);
            }
            const cidadeSelect = document.getElementById('cidade');
            if (cidadeSelect) {
                cidadeSelect.innerHTML = '';
                const opt = document.createElement('option');
                opt.value = '';
                opt.textContent = 'Todas as cidades';
                cidadeSelect.appendChild(opt);
            }
        });
    }

    if (modeloSelect) {
        modeloSelect.addEventListener('change', () => {
            carregarCidades(modeloSelect.value);
        });
    }

    if (btnBuscar) {
        btnBuscar.addEventListener('click', () => {
            carregarAnuncios();
        });
    }
});

async function carregarMarcas() {
    try {
        const res = await fetchAPI('/marcas');
        if (res.success) {
            const marcaSelect = document.getElementById('marca');
            if (!marcaSelect) return;
            
            marcaSelect.innerHTML = '';
            const optTodas = document.createElement('option');
            optTodas.value = '';
            optTodas.textContent = 'Todas as marcas';
            marcaSelect.appendChild(optTodas);

            res.data.forEach(marca => {
                const opt = document.createElement('option');
                opt.value = marca;
                opt.textContent = marca;
                marcaSelect.appendChild(opt);
            });
        }
    } catch (e) {
        console.error(e);
    }
}

async function carregarModelos(marca) {
    try {
        const url = marca ? `/modelos?marca=${encodeURIComponent(marca)}` : '/modelos';
        const res = await fetchAPI(url);
        if (res.success) {
            const modeloSelect = document.getElementById('modelo');
            if (modeloSelect && modeloSelect.tagName.toLowerCase() === 'select') {
                modeloSelect.innerHTML = '';
                const optTodos = document.createElement('option');
                optTodos.value = '';
                optTodos.textContent = 'Todos os modelos';
                modeloSelect.appendChild(optTodos);

                res.data.forEach(modelo => {
                    const opt = document.createElement('option');
                    opt.value = modelo;
                    opt.textContent = modelo;
                    modeloSelect.appendChild(opt);
                });
            }
        }
    } catch (e) {
        console.error(e);
    }
}

async function carregarCidades(modelo) {
    try {
        const url = modelo ? `/cidades?modelo=${encodeURIComponent(modelo)}` : '/cidades';
        const res = await fetchAPI(url);
        if (res.success) {
            const cidadeSelect = document.getElementById('cidade');
            if (cidadeSelect && cidadeSelect.tagName.toLowerCase() === 'select') {
                cidadeSelect.innerHTML = '';
                const optTodas = document.createElement('option');
                optTodas.value = '';
                optTodas.textContent = 'Todas as cidades';
                cidadeSelect.appendChild(optTodas);

                res.data.forEach(cidade => {
                    const opt = document.createElement('option');
                    opt.value = cidade;
                    opt.textContent = cidade;
                    cidadeSelect.appendChild(opt);
                });
            }
        }
    } catch (e) {
        console.error(e);
    }
}

async function carregarAnuncios() {
    try {
        const marca = document.getElementById('marca')?.value || '';
        const modelo = document.getElementById('modelo')?.value || '';
        const cidade = document.getElementById('cidade')?.value || '';

        let query = [];
        if (marca) query.push(`marca=${encodeURIComponent(marca)}`);
        if (modelo) query.push(`modelo=${encodeURIComponent(modelo)}`);
        if (cidade) query.push(`cidade=${encodeURIComponent(cidade)}`);
        
        const qs = query.length > 0 ? '?' + query.join('&') : '';
        const res = await fetchAPI(`/anuncios${qs}`);

        if (res.success) {
            renderizarAnuncios(res.data);
        }
    } catch (e) {
        console.error(e);
    }
}

function renderizarAnuncios(anuncios) {
    const grid = document.querySelector('.grid-container');
    if (!grid) return;

    grid.innerHTML = ''; // Limpa de forma segura pois nós criaremos elementos com appendChild

    if (anuncios.length === 0) {
        const p = document.createElement('p');
        p.textContent = 'Nenhum anúncio encontrado.';
        grid.appendChild(p);
        return;
    }

    anuncios.forEach(anuncio => {
        // Usa a FotoPrincipal ou fallback
        const foto = anuncio.FotoPrincipal ? `uploads/veiculos/${anuncio.FotoPrincipal}` : 'assets/images/default.png';
        const preco = parseFloat(anuncio.Valor).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

        const article = document.createElement('article');
        article.className = 'card';

        const img = document.createElement('img');
        img.src = foto;
        img.alt = anuncio.Modelo;
        img.className = 'card-img';
        img.style.height = '200px';
        img.style.objectFit = 'cover';
        article.appendChild(img);

        const divBody = document.createElement('div');
        divBody.className = 'card-body';

        const h3 = document.createElement('h3');
        h3.className = 'card-title';
        h3.textContent = `${anuncio.Marca} ${anuncio.Modelo}`;
        h3.title = h3.textContent; // Tooltip para nomes longos
        divBody.appendChild(h3);

        const pDesc = document.createElement('p');
        pDesc.className = 'card-text';
        pDesc.textContent = `${anuncio.Descricao.substring(0, 30)}... - ${anuncio.Ano}`;
        pDesc.title = anuncio.Descricao; // Tooltip para descrições longas
        divBody.appendChild(pDesc);

        const pLoc = document.createElement('p');
        pLoc.className = 'card-text';
        pLoc.textContent = `${anuncio.Cidade}, ${anuncio.Estado}`;
        divBody.appendChild(pLoc);

        const divPrice = document.createElement('div');
        divPrice.className = 'card-price';
        divPrice.textContent = preco;
        divBody.appendChild(divPrice);

        const aDet = document.createElement('a');
        aDet.href = `anuncio.php?id=${anuncio.Id}`;
        aDet.className = 'btn btn-primary';
        aDet.textContent = 'Ver Detalhes';
        divBody.appendChild(aDet);

        article.appendChild(divBody);
        grid.appendChild(article);
    });
}
