SET NAMES utf8mb4;

-- Inserir anunciante de teste (SenhaHash: root)
INSERT INTO Anunciante (Nome, CPF, Email, SenhaHash, Telefone) VALUES
('João Silva', '111.111.111-11', 'joao@email.com', '$2y$10$eE0H0hK9R8ZzR0J0v8w6ue4D4wL0O/T0T0v8w6ue4D4wL0O/T0T0', '(11) 99999-9999');

-- Inserir alguns anúncios de exemplo
INSERT INTO Anuncio (Marca, Modelo, Ano, Cor, Quilometragem, Descricao, Valor, Estado, Cidade, IdAnunciante) VALUES
('Chevrolet', 'Onix', 2020, 'Prata', 30000, 'Carro único dono, muito bem conservado.', 55900.00, 'SP', 'São Paulo', 1),
('Volkswagen', 'Polo', 2021, 'Branco', 15000, 'Revisões em dia, ótimo estado.', 78500.00, 'SP', 'Campinas', 1),
('Honda', 'Civic', 2019, 'Preto', 50000, 'Carro top de linha, sem detalhes.', 98900.00, 'MG', 'Belo Horizonte', 1);

-- Inserir fotos para os anúncios (assumindo IDs 1, 2 e 3)
INSERT INTO Foto (IdAnuncio, NomeArqFoto) VALUES
(1, 'chevrolet_onix_1.jpg'),
(2, 'vw_polo_1.jpg'),
(3, 'honda_civic_1.jpg');

-- Inserir alguns interesses
INSERT INTO Interesse (Nome, Telefone, Mensagem, IdAnuncio) VALUES
('Maria Oliveira', '(11) 88888-8888', 'Tenho interesse no Onix. Aceita troca?', 1),
('Carlos Souza', '(31) 77777-7777', 'Qual o menor valor à vista no Civic?', 3);
