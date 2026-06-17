-- MySQL dump 10.13  Distrib 8.0.43, for Win64 (x86_64)
--
-- Host: localhost    Database: orcamento
-- ------------------------------------------------------
-- Server version	8.0.43

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cargos`
--

DROP TABLE IF EXISTS `cargos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cargos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `setor_id` int NOT NULL,
  `nome` varchar(150) NOT NULL,
  `cbo` varchar(20) DEFAULT NULL,
  `descricao` text,
  PRIMARY KEY (`id`),
  KEY `setor_id` (`setor_id`),
  CONSTRAINT `cargos_ibfk_1` FOREIGN KEY (`setor_id`) REFERENCES `setores` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargos`
--

LOCK TABLES `cargos` WRITE;
/*!40000 ALTER TABLE `cargos` DISABLE KEYS */;
/*!40000 ALTER TABLE `cargos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `checklist_itens`
--

DROP TABLE IF EXISTS `checklist_itens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `checklist_itens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `checklist_modelo_id` int NOT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `item` text NOT NULL,
  `obrigatorio` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `checklist_modelo_id` (`checklist_modelo_id`),
  CONSTRAINT `checklist_itens_ibfk_1` FOREIGN KEY (`checklist_modelo_id`) REFERENCES `checklist_modelos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `checklist_itens`
--

LOCK TABLES `checklist_itens` WRITE;
/*!40000 ALTER TABLE `checklist_itens` DISABLE KEYS */;
/*!40000 ALTER TABLE `checklist_itens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `checklist_modelos`
--

DROP TABLE IF EXISTS `checklist_modelos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `checklist_modelos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `descricao` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `checklist_modelos`
--

LOCK TABLES `checklist_modelos` WRITE;
/*!40000 ALTER TABLE `checklist_modelos` DISABLE KEYS */;
/*!40000 ALTER TABLE `checklist_modelos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `checklist_respostas`
--

DROP TABLE IF EXISTS `checklist_respostas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `checklist_respostas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `visita_id` int NOT NULL,
  `checklist_item_id` int NOT NULL,
  `resposta` enum('SIM','NAO','NAO_APLICA') DEFAULT NULL,
  `observacao` text,
  PRIMARY KEY (`id`),
  KEY `visita_id` (`visita_id`),
  KEY `checklist_item_id` (`checklist_item_id`),
  CONSTRAINT `checklist_respostas_ibfk_1` FOREIGN KEY (`visita_id`) REFERENCES `visitas_tecnicas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `checklist_respostas_ibfk_2` FOREIGN KEY (`checklist_item_id`) REFERENCES `checklist_itens` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `checklist_respostas`
--

LOCK TABLES `checklist_respostas` WRITE;
/*!40000 ALTER TABLE `checklist_respostas` DISABLE KEYS */;
/*!40000 ALTER TABLE `checklist_respostas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empresas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `razao_social` varchar(200) NOT NULL,
  `nome_fantasia` varchar(200) DEFAULT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  `inscricao_estadual` varchar(50) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `responsavel` varchar(150) DEFAULT NULL,
  `contato_responsavel` varchar(100) DEFAULT NULL,
  `endereco` text,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT '1',
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (1,'','','12341256000152','','','','Claudia','41998989796','','','','',1,'2026-05-15 00:55:22');
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evidencias`
--

DROP TABLE IF EXISTS `evidencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `evidencias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `visita_id` int DEFAULT NULL,
  `quantificacao_id` int DEFAULT NULL,
  `titulo` varchar(150) DEFAULT NULL,
  `descricao` text,
  `arquivo` varchar(255) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evidencias`
--

LOCK TABLES `evidencias` WRITE;
/*!40000 ALTER TABLE `evidencias` DISABLE KEYS */;
/*!40000 ALTER TABLE `evidencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fispq`
--

DROP TABLE IF EXISTS `fispq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fispq` (
  `id` int NOT NULL AUTO_INCREMENT,
  `empresa_id` int NOT NULL,
  `produto` varchar(200) NOT NULL,
  `fabricante` varchar(150) DEFAULT NULL,
  `arquivo_pdf` varchar(255) DEFAULT NULL,
  `validade` date DEFAULT NULL,
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `empresa_id` (`empresa_id`),
  CONSTRAINT `fispq_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fispq`
--

LOCK TABLES `fispq` WRITE;
/*!40000 ALTER TABLE `fispq` DISABLE KEYS */;
/*!40000 ALTER TABLE `fispq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `importacoes`
--

DROP TABLE IF EXISTS `importacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `importacoes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int DEFAULT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `arquivo` varchar(255) DEFAULT NULL,
  `total_registros` int DEFAULT '0',
  `total_importados` int DEFAULT '0',
  `total_erros` int DEFAULT '0',
  `status` enum('PROCESSANDO','FINALIZADO','ERRO') DEFAULT 'PROCESSANDO',
  `log_erros` longtext,
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `importacoes`
--

LOCK TABLES `importacoes` WRITE;
/*!40000 ALTER TABLE `importacoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `importacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs_sistema`
--

DROP TABLE IF EXISTS `logs_sistema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logs_sistema` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int DEFAULT NULL,
  `acao` varchar(255) DEFAULT NULL,
  `tabela_afetada` varchar(100) DEFAULT NULL,
  `registro_id` int DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `logs_sistema_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs_sistema`
--

LOCK TABLES `logs_sistema` WRITE;
/*!40000 ALTER TABLE `logs_sistema` DISABLE KEYS */;
/*!40000 ALTER TABLE `logs_sistema` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nao_conformidades`
--

DROP TABLE IF EXISTS `nao_conformidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nao_conformidades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `empresa_id` int NOT NULL,
  `visita_id` int DEFAULT NULL,
  `descricao` text NOT NULL,
  `classificacao` enum('LEVE','MODERADA','GRAVE','CRITICA') DEFAULT NULL,
  `prioridade` enum('BAIXA','MEDIA','ALTA') DEFAULT NULL,
  `prazo` date DEFAULT NULL,
  `responsavel` varchar(150) DEFAULT NULL,
  `status` enum('ABERTA','EM_ANDAMENTO','FINALIZADA') DEFAULT 'ABERTA',
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `empresa_id` (`empresa_id`),
  KEY `visita_id` (`visita_id`),
  CONSTRAINT `nao_conformidades_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`),
  CONSTRAINT `nao_conformidades_ibfk_2` FOREIGN KEY (`visita_id`) REFERENCES `visitas_tecnicas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nao_conformidades`
--

LOCK TABLES `nao_conformidades` WRITE;
/*!40000 ALTER TABLE `nao_conformidades` DISABLE KEYS */;
/*!40000 ALTER TABLE `nao_conformidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `planos_acao`
--

DROP TABLE IF EXISTS `planos_acao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `planos_acao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nao_conformidade_id` int NOT NULL,
  `acao` text NOT NULL,
  `responsavel` varchar(150) DEFAULT NULL,
  `prazo` date DEFAULT NULL,
  `status` enum('PENDENTE','EM_EXECUCAO','CONCLUIDO') DEFAULT 'PENDENTE',
  PRIMARY KEY (`id`),
  KEY `nao_conformidade_id` (`nao_conformidade_id`),
  CONSTRAINT `planos_acao_ibfk_1` FOREIGN KEY (`nao_conformidade_id`) REFERENCES `nao_conformidades` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planos_acao`
--

LOCK TABLES `planos_acao` WRITE;
/*!40000 ALTER TABLE `planos_acao` DISABLE KEYS */;
/*!40000 ALTER TABLE `planos_acao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quantificacao_resultados`
--

DROP TABLE IF EXISTS `quantificacao_resultados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quantificacao_resultados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `quantificacao_id` int NOT NULL,
  `limite_tolerancia` varchar(100) DEFAULT NULL,
  `resultado` varchar(100) DEFAULT NULL,
  `unidade` varchar(50) DEFAULT NULL,
  `acima_nr15` tinyint(1) DEFAULT '0',
  `acima_acgih` tinyint(1) DEFAULT '0',
  `conclusao` text,
  `recomendacao` text,
  PRIMARY KEY (`id`),
  KEY `quantificacao_id` (`quantificacao_id`),
  CONSTRAINT `quantificacao_resultados_ibfk_1` FOREIGN KEY (`quantificacao_id`) REFERENCES `quantificacoes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quantificacao_resultados`
--

LOCK TABLES `quantificacao_resultados` WRITE;
/*!40000 ALTER TABLE `quantificacao_resultados` DISABLE KEYS */;
/*!40000 ALTER TABLE `quantificacao_resultados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quantificacoes`
--

DROP TABLE IF EXISTS `quantificacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quantificacoes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `empresa_id` int NOT NULL,
  `unidade_id` int DEFAULT NULL,
  `setor_id` int DEFAULT NULL,
  `cargo_id` int DEFAULT NULL,
  `tecnico_id` int NOT NULL,
  `risco_id` int NOT NULL,
  `metodologia` varchar(255) DEFAULT NULL,
  `equipamento` varchar(255) DEFAULT NULL,
  `estrategia_amostragem` text,
  `observacoes` text,
  `status` enum('PENDENTE','EM_ANALISE','CONCLUIDA') DEFAULT 'PENDENTE',
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `empresa_id` (`empresa_id`),
  KEY `unidade_id` (`unidade_id`),
  KEY `setor_id` (`setor_id`),
  KEY `cargo_id` (`cargo_id`),
  KEY `tecnico_id` (`tecnico_id`),
  KEY `risco_id` (`risco_id`),
  CONSTRAINT `quantificacoes_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`),
  CONSTRAINT `quantificacoes_ibfk_2` FOREIGN KEY (`unidade_id`) REFERENCES `unidades` (`id`),
  CONSTRAINT `quantificacoes_ibfk_3` FOREIGN KEY (`setor_id`) REFERENCES `setores` (`id`),
  CONSTRAINT `quantificacoes_ibfk_4` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`),
  CONSTRAINT `quantificacoes_ibfk_5` FOREIGN KEY (`tecnico_id`) REFERENCES `tecnicos` (`id`),
  CONSTRAINT `quantificacoes_ibfk_6` FOREIGN KEY (`risco_id`) REFERENCES `riscos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quantificacoes`
--

LOCK TABLES `quantificacoes` WRITE;
/*!40000 ALTER TABLE `quantificacoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `quantificacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relatorios`
--

DROP TABLE IF EXISTS `relatorios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `relatorios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `empresa_id` int NOT NULL,
  `tecnico_id` int NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `conteudo` longtext,
  `arquivo_pdf` varchar(255) DEFAULT NULL,
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `empresa_id` (`empresa_id`),
  KEY `tecnico_id` (`tecnico_id`),
  CONSTRAINT `relatorios_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`),
  CONSTRAINT `relatorios_ibfk_2` FOREIGN KEY (`tecnico_id`) REFERENCES `tecnicos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relatorios`
--

LOCK TABLES `relatorios` WRITE;
/*!40000 ALTER TABLE `relatorios` DISABLE KEYS */;
/*!40000 ALTER TABLE `relatorios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `riscos`
--

DROP TABLE IF EXISTS `riscos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `riscos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo_risco_id` int NOT NULL,
  `nome` varchar(150) NOT NULL,
  `descricao` text,
  `limite_nr15` varchar(100) DEFAULT NULL,
  `limite_acgih` varchar(100) DEFAULT NULL,
  `unidade_medida` varchar(50) DEFAULT NULL,
  `exige_quantificacao` tinyint(1) DEFAULT '0',
  `severidade_padrao` int DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `tipo_risco_id` (`tipo_risco_id`),
  CONSTRAINT `riscos_ibfk_1` FOREIGN KEY (`tipo_risco_id`) REFERENCES `tipos_riscos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `riscos`
--

LOCK TABLES `riscos` WRITE;
/*!40000 ALTER TABLE `riscos` DISABLE KEYS */;
/*!40000 ALTER TABLE `riscos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setores`
--

DROP TABLE IF EXISTS `setores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `setores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `unidade_id` int NOT NULL,
  `nome` varchar(150) NOT NULL,
  `descricao` text,
  PRIMARY KEY (`id`),
  KEY `unidade_id` (`unidade_id`),
  CONSTRAINT `setores_ibfk_1` FOREIGN KEY (`unidade_id`) REFERENCES `unidades` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setores`
--

LOCK TABLES `setores` WRITE;
/*!40000 ALTER TABLE `setores` DISABLE KEYS */;
/*!40000 ALTER TABLE `setores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tecnicos`
--

DROP TABLE IF EXISTS `tecnicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tecnicos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `registro_profissional` varchar(100) DEFAULT NULL,
  `conselho` varchar(50) DEFAULT NULL,
  `uf` char(2) DEFAULT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `assinatura` text,
  `ativo` tinyint(1) DEFAULT '1',
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tecnicos`
--

LOCK TABLES `tecnicos` WRITE;
/*!40000 ALTER TABLE `tecnicos` DISABLE KEYS */;
INSERT INTO `tecnicos` VALUES (11,'William Lisboa','0012569','CREA','PR','619.403.280-47','(41) 99999-9999','engenheiro@ssosantiago.com.br',NULL,1,'2026-06-14 22:10:50');
/*!40000 ALTER TABLE `tecnicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_riscos`
--

DROP TABLE IF EXISTS `tipos_riscos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipos_riscos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_riscos`
--

LOCK TABLES `tipos_riscos` WRITE;
/*!40000 ALTER TABLE `tipos_riscos` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipos_riscos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unidades`
--

DROP TABLE IF EXISTS `unidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `unidades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `empresa_id` int NOT NULL,
  `nome` varchar(150) NOT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  `endereco` text,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `empresa_id` (`empresa_id`),
  CONSTRAINT `unidades_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidades`
--

LOCK TABLES `unidades` WRITE;
/*!40000 ALTER TABLE `unidades` DISABLE KEYS */;
/*!40000 ALTER TABLE `unidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `tipo` enum('ADMIN','TECNICO','CLIENTE','VISUALIZADOR') DEFAULT 'TECNICO',
  `ativo` tinyint(1) DEFAULT '1',
  `ultimo_login` datetime DEFAULT NULL,
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ultimo_acesso` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (13,'Administrador','admin@seudominio.com','$2y$10$D.E3MbeG.DRI2bgc2X2sdewXTr32gDnAE9hCDMIqbk9gnoY7ocaL.',NULL,'ADMIN',1,NULL,'2026-06-14 17:24:31','2026-06-14 20:34:58');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitas_tecnicas`
--

DROP TABLE IF EXISTS `visitas_tecnicas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `visitas_tecnicas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `empresa_id` int NOT NULL,
  `unidade_id` int DEFAULT NULL,
  `tecnico_id` int NOT NULL,
  `data_visita` date NOT NULL,
  `hora_visita` time DEFAULT NULL,
  `objetivo` text,
  `observacoes` text,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `assinatura_cliente` text,
  `assinatura_tecnico` text,
  `status` enum('ABERTA','FINALIZADA','CANCELADA') DEFAULT 'ABERTA',
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `empresa_id` (`empresa_id`),
  KEY `unidade_id` (`unidade_id`),
  KEY `tecnico_id` (`tecnico_id`),
  CONSTRAINT `visitas_tecnicas_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`),
  CONSTRAINT `visitas_tecnicas_ibfk_2` FOREIGN KEY (`unidade_id`) REFERENCES `unidades` (`id`),
  CONSTRAINT `visitas_tecnicas_ibfk_3` FOREIGN KEY (`tecnico_id`) REFERENCES `tecnicos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitas_tecnicas`
--

LOCK TABLES `visitas_tecnicas` WRITE;
/*!40000 ALTER TABLE `visitas_tecnicas` DISABLE KEYS */;
/*!40000 ALTER TABLE `visitas_tecnicas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-15 15:38:07
