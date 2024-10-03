DROP DATABASE IF EXISTS AutoMaster;
CREATE DATABASE AutoMaster CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE AutoMaster;

-- Tabela TipoUsuario
CREATE TABLE tipo_usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(50) NOT NULL UNIQUE
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela Usuario
CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo_id INT NOT NULL,
    status ENUM('Ativo', 'Inativo') DEFAULT 'Ativo',
    CONSTRAINT fk_tipo_usuario
        FOREIGN KEY (tipo_id) REFERENCES tipo_usuario(id)
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela Cliente
CREATE TABLE cliente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf_cnpj VARCHAR(20) UNIQUE NOT NULL,
    telefone VARCHAR(20),
    email VARCHAR(100),
    endereco VARCHAR(255)
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela TipoEquipamento
CREATE TABLE tipo_equipamento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(50)
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela Equipamento
CREATE TABLE equipamento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT,
    tipo_equipamento_id INT,
    marca VARCHAR(50),
    modelo VARCHAR(50),
    ano_fabricacao INT,
    identificacao VARCHAR(50),
    numero_serie VARCHAR(50),
    cor VARCHAR(20),
    uso_horas_km INT,
    CONSTRAINT fk_cliente
        FOREIGN KEY (cliente_id) REFERENCES cliente(id) ON DELETE CASCADE,
    CONSTRAINT fk_tipo_equipamento
        FOREIGN KEY (tipo_equipamento_id) REFERENCES tipo_equipamento(id) ON DELETE RESTRICT
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela StatusOrcamento
CREATE TABLE status_orcamento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(50) NOT NULL UNIQUE
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela Orcamento
CREATE TABLE orcamento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT,
    equipamento_id INT,
    total DECIMAL(10, 2),
    status_id INT,
    usuario_id INT,
    data_criacao DATE NOT NULL,
    CONSTRAINT fk_cliente_orcamento
        FOREIGN KEY (cliente_id) REFERENCES cliente(id) ON DELETE SET NULL,
    CONSTRAINT fk_equipamento_orcamento
        FOREIGN KEY (equipamento_id) REFERENCES equipamento(id) ON DELETE SET NULL,
    CONSTRAINT fk_status_orcamento
        FOREIGN KEY (status_id) REFERENCES status_orcamento(id),
    CONSTRAINT fk_usuario_orcamento
        FOREIGN KEY (usuario_id) REFERENCES usuario(id) ON DELETE SET NULL
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela StatusOrdemServico
CREATE TABLE status_ordem_servico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(50) NOT NULL UNIQUE
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela OrdemServico
CREATE TABLE ordem_servico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    orcamento_id INT,
    status_id INT,
    usuario_id INT,
    data_inicio DATE,
    data_fim DATE,
    CONSTRAINT fk_orcamento
        FOREIGN KEY (orcamento_id) REFERENCES orcamento(id) ON DELETE CASCADE,
    CONSTRAINT fk_status_ordem_servico
        FOREIGN KEY (status_id) REFERENCES status_ordem_servico(id),
    CONSTRAINT fk_usuario_ordem_servico
        FOREIGN KEY (usuario_id) REFERENCES usuario(id) ON DELETE SET NULL
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela Produto
CREATE TABLE produto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    modelo_tipo VARCHAR(50) NOT NULL,
    marca VARCHAR(50) NOT NULL,
    preco_compra DECIMAL(10, 2) NOT NULL,
    preco_venda DECIMAL(10, 2) NOT NULL,
    quantidade_estoque INT NOT NULL
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela Fornecedor
CREATE TABLE fornecedor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    contato VARCHAR(100)
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela Estoque
CREATE TABLE estoque (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto_id INT,
    fornecedor_id INT,
    quantidade_entrada INT NOT NULL,
    quantidade_saida INT DEFAULT 0,
    data_entrada DATE NOT NULL,
    CONSTRAINT fk_produto
        FOREIGN KEY (produto_id) REFERENCES produto(id) ON DELETE CASCADE,
    CONSTRAINT fk_fornecedor
        FOREIGN KEY (fornecedor_id) REFERENCES fornecedor(id) ON DELETE CASCADE
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela Serviço
CREATE TABLE servico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(255) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela OrcamentoProduto
CREATE TABLE orcamento_produto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    orcamento_id INT,
    produto_id INT,
    quantidade INT NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (orcamento_id) REFERENCES orcamento(id) ON DELETE CASCADE,
    FOREIGN KEY (produto_id) REFERENCES produto(id) ON DELETE CASCADE
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela OrcamentoServico
CREATE TABLE orcamento_servico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    orcamento_id INT,
    servico_id INT,
    preco DECIMAL(10, 2) NOT NULL,
    CONSTRAINT fk_orcamento_servico
        FOREIGN KEY (orcamento_id) REFERENCES orcamento(id) ON DELETE CASCADE,
    CONSTRAINT fk_servico_orcamento
        FOREIGN KEY (servico_id) REFERENCES servico(id)
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela TipoTransacao
CREATE TABLE tipo_transacao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(50) NOT NULL UNIQUE
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela Transações Financeiras
CREATE TABLE transacao_financeira (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ordem_servico_id INT,
    tipo_id INT,
    valor DECIMAL(10, 2) NOT NULL,
    data_transacao DATE NOT NULL,
    CONSTRAINT fk_ordem_servico_transacao
        FOREIGN KEY (ordem_servico_id) REFERENCES ordem_servico(id),
    CONSTRAINT fk_tipo_transacao
        FOREIGN KEY (tipo_id) REFERENCES tipo_transacao(id)
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela Log Transação
CREATE TABLE log_transacao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    acao VARCHAR(255) NOT NULL,
    detalhes TEXT,
    id_registro_afetado INT,
    data_hora DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuario(id) ON DELETE CASCADE
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
