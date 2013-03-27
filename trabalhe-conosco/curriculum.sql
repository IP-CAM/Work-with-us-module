-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mar 27, 2013 as 02:09 PM
-- Versão do Servidor: 5.1.66
-- Versão do PHP: 5.3.16

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `oc_curriculum`
--

CREATE TABLE IF NOT EXISTS `curriculum` (
  `curriculum_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `telephone` varchar(32) NOT NULL,
  `email` varchar(200) NOT NULL,
  `filename` varchar(200) NOT NULL,
  `mask` varchar(300) NOT NULL,
  `enquiry` text NOT NULL,
  `city` varchar(128) NOT NULL,
  `address_1` varchar(100) NOT NULL,
  `address_2` varchar(100) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `country_id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY (`curriculum_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;


INSERT INTO `setting` (`setting_id`, `store_id`, `group`, `key`, `value`, `serialized`) VALUES
(1, 0, 'curriculum', 'config_file_extension_allowed_curriculum', 'pdf\r\ndoc\r\ndocx\r\n', 0),
(2, 0, 'curriculum', 'config_file_mime_allowed_curriculum', 'pplication/pdf, application/x-pdf, application/acrobat, applications/vnd.pdf, text/pdf, text/x-pdf\r\napplication/msword [official]\r\napplication/doc, appl/text, application/vnd.msword, application/vnd.ms-word, application/winword, application/word, application/x-msw6, application/x-msword\r\napplication/vnd.openxmlformats-officedocument.wordprocessingml.document', 0),
(3, 0, 'curriculum', 'config_maintenance_curriculum', '0', 0),
(4, 0, 'curriculum', 'config_captcha_curriculum', '1', 0);
