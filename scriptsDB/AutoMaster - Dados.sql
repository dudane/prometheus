-- Inserir TipoUsuario
INSERT INTO tipo_usuario (descricao) VALUES
('Admin'),
('Funcionário'),
('Cliente');

-- Inserir Usuario
INSERT INTO usuario (nome, email, senha, tipo_id, status) VALUES
('Admin User', 'admin@example.com', 'senha_admin', 1, 'Ativo'),
('Funcionário 1', 'funcionario1@example.com', 'senha_func1', 2, 'Ativo'),
('Funcionário 2', 'funcionario2@example.com', 'senha_func2', 2, 'Ativo'),
('Eduardo Ribeiro', 'dudane@gmail.com', '123', 1, 'Ativo');

-- Inserir Clientes
INSERT INTO cliente (nome, cpf_cnpj, telefone, email, endereco) VALUES
('Maria Silva', '12345678909', '99999-0000', 'maria.silva@example.com', 'Rua A, 123, Cidade A'),
('João Souza', '98765432100', '88888-0000', 'joao.souza@example.com', 'Rua B, 456, Cidade B'),
('Ana Costa', '12312312300', '77777-0000', 'ana.costa@example.com', 'Rua C, 789, Cidade C'),
('Pedro Almeida', '32132132100', '66666-0000', 'pedro.almeida@example.com', 'Rua D, 321, Cidade D'),
('Lucas Oliveira', '45645645600', '55555-0000', 'lucas.oliveira@example.com', 'Rua E, 654, Cidade E'),
('Juliana Pereira', '65465465400', '44444-0000', 'juliana.pereira@example.com', 'Rua F, 987, Cidade F'),
('Fernanda Lima', '78978978900', '33333-0000', 'fernanda.lima@example.com', 'Rua G, 159, Cidade G'),
('Carlos Santos', '11122233344', '22222-0000', 'carlos.santos@example.com', 'Rua H, 258, Cidade H'),
('Roberta Ferreira', '44455566677', '11111-0000', 'roberta.ferreira@example.com', 'Rua I, 369, Cidade I'),
('Marcio Ribeiro', '99988877766', '00000-0000', 'marcio.ribeiro@example.com', 'Rua J, 741, Cidade J'),
('Tatiane Rocha', '33322211100', '88888-1111', 'tatiane.rocha@example.com', 'Rua K, 852, Cidade K'),
('Rodrigo Mendes', '22211133300', '77777-2222', 'rodrigo.mendes@example.com', 'Rua L, 963, Cidade L'),
('Gustavo Nascimento', '55544477700', '66666-3333', 'gustavo.nascimento@example.com', 'Rua M, 159, Cidade M'),
('Sofia Martins', '88899900000', '55555-4444', 'sofia.martins@example.com', 'Rua N, 258, Cidade N'),
('Eduardo Cardoso', '11100022233', '44444-5555', 'eduardo.cardoso@example.com', 'Rua O, 369, Cidade O'),
('Patricia Alves', '22233311144', '33333-6666', 'patricia.alves@example.com', 'Rua P, 741, Cidade P'),
('Ricardo Gomes', '33344422255', '22222-7777', 'ricardo.gomes@example.com', 'Rua Q, 852, Cidade Q'),
('Simone Costa', '44455533366', '11111-8888', 'simone.costa@example.com', 'Rua R, 963, Cidade R'),
('Natália Dias', '55566644477', '00000-9999', 'natalia.dias@example.com', 'Rua S, 159, Cidade S'),
('Fernando Rocha', '66677755588', '99999-1111', 'fernando.rocha@example.com', 'Rua T, 258, Cidade T');


-- Inserir TipoEquipamento
INSERT INTO tipo_equipamento (descricao) VALUES
('Automóvel'),
('Motocicleta'),
('Caminhão'),
('Van');

-- Inserir Equipamento
INSERT INTO equipamento (cliente_id, tipo_equipamento_id, marca, modelo, ano_fabricacao, identificacao, numero_serie, cor, uso_horas_km) VALUES
(1, 1, 'Fiat', 'Palio', 2010, 'ABC1D23', 'SER12345', 'Prata', 120000),
(2, 1, 'Ford', 'Fiesta', 2012, 'XYZ9W88', 'SER54321', 'Azul', 80000),
(3, 1, 'Volkswagen', 'Gol', 2015, 'LMN2O34', 'SER67890', 'Preto', 60000),
(4, 1, 'Chevrolet', 'Onix', 2018, 'QRS4T56', 'SER09876', 'Branco', 30000),
(5, 1, 'Renault', 'Sandero', 2016, 'UVW5X67', 'SER13579', 'Vermelho', 45000),
(6, 1, 'Toyota', 'Corolla', 2019, 'ABC9Y12', 'SER24680', 'Prata', 20000),
(7, 1, 'Honda', 'Civic', 2020, 'DEF7G89', 'SER86420', 'Azul', 10000),
(8, 1, 'Nissan', 'Sentra', 2021, 'GHI3J45', 'SER75319', 'Preto', 5000),
(9, 1, 'Hyundai', 'HB20', 2017, 'JKL8M23', 'SER95124', 'Branco', 35000),
(10, 1, 'Kia', 'Sportage', 2018, 'OPQ6R45', 'SER14785', 'Vermelho', 15000),
(11, 1, 'Peugeot', '208', 2014, 'RST2U78', 'SER25896', 'Prata', 75000),
(12, 1, 'Citroën', 'C3', 2013, 'UVW9Y89', 'SER36987', 'Azul', 85000),
(13, 1, 'Fiat', 'Uno', 2011, 'XYZ1Z12', 'SER15973', 'Preto', 95000),
(14, 1, 'Ford', 'Ka', 2015, 'LMN3C34', 'SER75384', 'Branco', 65000),
(15, 1, 'Volkswagen', 'Polo', 2019, 'ABC4D56', 'SER25874', 'Vermelho', 18000),
(16, 1, 'Chevrolet', 'Tracker', 2020, 'DEF9A12', 'SER95163', 'Prata', 9000),
(17, 1, 'Renault', 'Duster', 2018, 'GHI7F45', 'SER75321', 'Azul', 22000),
(18, 1, 'Toyota', 'Hilux', 2021, 'JKL5A78', 'SER15982', 'Preto', 15000),
(19, 1, 'Honda', 'HR-V', 2020, 'MNO2D89', 'SER75392', 'Branco', 5000),
(20, 1, 'Nissan', 'Kicks', 2022, 'PQR8U56', 'SER15926', 'Vermelho', 3000);

-- Inserir StatusOrcamento
INSERT INTO status_orcamento (descricao) VALUES
('Aguardando Aprovação'),
('Aprovado'),
('Rejeitado');

-- Inserir Orcamento
INSERT INTO orcamento (cliente_id, equipamento_id, total, status_id, usuario_id, data_criacao) VALUES
(1, 1, 1500.00, 1, 1, '2024-09-28'),
(2, 2, 2000.00, 2, 1, '2024-09-28');

-- Inserir StatusOrdemServico
INSERT INTO status_ordem_servico (descricao) VALUES
('Em Andamento'),
('Concluído'),
('Cancelado');

-- Inserir OrdemServico
INSERT INTO ordem_servico (orcamento_id, status_id, usuario_id, data_inicio, data_fim) VALUES
(1, 1, 1, '2024-09-29', NULL),
(2, 2, 1, '2024-09-29', NULL);

-- Inserir Peça
INSERT INTO produto (nome, modelo_tipo, marca, preco_compra, preco_venda, quantidade_estoque) VALUES
('Pneu', 'Aro 14', 'Michelin', 150.00, 200.00, 100),
('Óleo de Motor', '5W30', 'Shell', 80.00, 120.00, 50),
('Bateria', '60Ah', 'Moura', 220.00, 300.00, 40),
('Filtro de Óleo', 'Spin-On', 'Fram', 25.00, 40.00, 75),
('Velas de Ignição', 'Iridium', 'NGK', 45.00, 70.00, 60),
('Amortecedor', 'Dianteiro', 'Monroe', 180.00, 250.00, 30),
('Pastilha de Freio', 'Cerâmica', 'Bosch', 55.00, 90.00, 80),
('Correia Dentada', '1.6L', 'Gates', 70.00, 110.00, 25),
('Radiador', 'Alumínio', 'Valeo', 280.00, 400.00, 20),
('Palheta Limpador', '24 Polegadas', 'Trico', 15.00, 25.00, 100),
('Câmbio Manual', '5 Marchas', 'ZF', 850.00, 1200.00, 5),
('Sensor de Oxigênio', '4 Fios', 'Denso', 110.00, 150.00, 35),
('Disco de Freio', 'Ventilado', 'Brembo', 90.00, 140.00, 50),
('Filtro de Combustível', 'Linha Flex', 'Mahle', 18.00, 30.00, 120),
('Parafuso de Roda', 'M12', 'Febi', 5.00, 10.00, 500),
('Embreagem', 'Kit Completo', 'Sachs', 350.00, 500.00, 15),
('Farol Dianteiro', 'LED', 'Philips', 210.00, 300.00, 10),
('Calota', 'Aro 15', 'Universal', 25.00, 50.00, 60),
('Parachoque', 'Dianteiro', 'Plascar', 200.00, 350.00, 8),
('Cabo de Vela', 'Silicone', 'NGK', 35.00, 55.00, 45),
('Filtro de Ar', 'Esportivo', 'K&N', 60.00, 100.00, 30),
('Lanterna Traseira', 'LED', 'Arteb', 120.00, 180.00, 12);


-- Inserir Fornecedor
INSERT INTO fornecedor (nome, contato) VALUES
('Fornecedor A', 'contatoA@example.com'),
('Fornecedor B', 'contatoB@example.com');

-- Inserir Estoque
INSERT INTO estoque (produto_id, fornecedor_id, quantidade_entrada, quantidade_saida, data_entrada) VALUES
(1, 1, 50, 0, '2024-09-01'),
(2, 2, 30, 0, '2024-09-05');

-- Inserir Serviço
INSERT INTO servico (descricao, preco) VALUES
('Troca de Óleo', 100.00),
('Revisão Completa', 300.00);

-- Inserir OrcamentoPeca
INSERT INTO orcamento_produto (orcamento_id, produto_id, quantidade, preco) VALUES
(1, 1, 4, 200.00),
(2, 2, 2, 120.00);

-- Inserir OrcamentoServico
INSERT INTO orcamento_servico (orcamento_id, servico_id, preco) VALUES
(1, 1, 100.00),
(2, 2, 300.00);

-- Inserir TipoTransacao
INSERT INTO tipo_transacao (descricao) VALUES
('Entrada'),
('Saída');

-- Inserir Transações Financeiras
INSERT INTO transacao_financeira (ordem_servico_id, tipo_id, valor, data_transacao) VALUES
(1, 1, 500.00, '2024-09-29'),
(2, 2, 300.00, '2024-09-29');

-- Inserir Log Transação
INSERT INTO log_transacao (usuario_id, acao, detalhes, id_registro_afetado) VALUES
(1, 'Criar Orçamento', 'Criou o orçamento 1', 1),
(1, 'Criar Ordem de Serviço', 'Criou a ordem de serviço 1', 1);
