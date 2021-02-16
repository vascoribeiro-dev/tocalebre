-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16-Fev-2021 às 22:19
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portfolio`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `sys_companies`
--

CREATE TABLE `sys_companies` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sys_companies`
--

INSERT INTO `sys_companies` (`id`, `name`, `status`) VALUES
(1, 'VRSysten', 'ACTIVE');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sys_lang`
--

CREATE TABLE `sys_lang` (
  `id` int(11) NOT NULL,
  `lang` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `status` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `sys_lang`
--

INSERT INTO `sys_lang` (`id`, `lang`, `status`) VALUES
(1, 'Português', 'ACTIVE'),
(2, 'Inglês', 'ACTIVE');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sys_modules`
--

CREATE TABLE `sys_modules` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'ACTIVE',
  `table` varchar(100) NOT NULL,
  `keyname` varchar(5) NOT NULL,
  `module` varchar(100) NOT NULL,
  `icon` text NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sys_modules`
--

INSERT INTO `sys_modules` (`id`, `name`, `status`, `table`, `keyname`, `module`, `icon`, `order`) VALUES
(1, 'Utilizadores', 'ACTIVE', 'user', 'UTIL', 'users', '<i class=\"nav-icon fas fa-project-diagram\"></i>', 15),
(2, 'Sobre', 'ACTIVE', 'tl_about', 'ABOUT', 'about', '<i class=\"far fa-address-card\"></i>', 1),
(3, 'Contacta-me', 'ACTIVE', 'tl_contact', 'CONTA', 'contact', '<i class=\"fas fa-phone\"></i>', 2),
(4, 'Galeria', 'ACTIVE', 'tl_gallery', 'GALLE', 'gallery', '<i class=\"far fa-images\"></i>', 3),
(5, 'Blog', 'ACTIVE', 'tl_blog', 'BLOG', 'blog', '<i class=\"fab fa-blogger-b\"></i>', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sys_pages`
--

CREATE TABLE `sys_pages` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `keyname` varchar(100) NOT NULL,
  `menuname` varchar(200) NOT NULL,
  `order` int(11) NOT NULL,
  `icon` text NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sys_pages`
--

INSERT INTO `sys_pages` (`id`, `name`, `keyname`, `menuname`, `order`, `icon`, `status`) VALUES
(1, 'Novo Utilizador', 'users', 'Novo', 1, '<i class=\"far fa-plus-square\"></i>', 'ACTIVE'),
(2, 'Lista Utilizadores', 'userslist', 'Lista', 2, '<i class=\"fas fa-list\"></i>', 'ACTIVE'),
(3, 'Editar Sobre', 'about', 'Editar', 1, '<i class=\"far fa-edit\"></i>', 'ACTIVE'),
(4, 'Editar Contacto', 'contact', 'Editar', 1, '<i class=\"far fa-edit\"></i>', 'ACTIVE'),
(5, 'Editar Galeria', 'gallery', 'Editar', 1, '<i class=\"far fa-edit\"></i>', 'ACTIVE'),
(6, 'Nova Galeria', 'galleryitem', 'Criar', 2, '<i class=\"far fa-plus-square\"></i>', 'ACTIVE'),
(7, 'Lista Galeria', 'gallerylist', 'Lista', 3, '<i class=\"fas fa-list\"></i>\r\n', 'ACTIVE'),
(8, 'Novo Post', 'blog', 'Novo', 1, '<i class=\"far fa-plus-square\"></i>', 'ACTIVE'),
(9, 'Lista de Posts', 'blogedit', 'Editar', 2, '<i class=\"fas fa-list\"></i>', 'ACTIVE');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sys_rel_pages_modules`
--

CREATE TABLE `sys_rel_pages_modules` (
  `id` int(11) NOT NULL,
  `id_module` int(11) NOT NULL,
  `id_page` int(11) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sys_rel_pages_modules`
--

INSERT INTO `sys_rel_pages_modules` (`id`, `id_module`, `id_page`, `status`) VALUES
(1, 1, 1, 'ACTIVE'),
(2, 1, 2, 'ACTIVE'),
(3, 2, 3, 'ACTIVE'),
(4, 3, 4, 'ACTIVE'),
(5, 4, 5, 'ACTIVE'),
(6, 4, 6, 'ACTIVE'),
(7, 4, 7, 'ACTIVE'),
(8, 5, 8, 'ACTIVE'),
(9, 5, 9, 'ACTIVE');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sys_rel_users_companies`
--

CREATE TABLE `sys_rel_users_companies` (
  `id` int(11) NOT NULL,
  `id_company` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sys_rel_users_companies`
--

INSERT INTO `sys_rel_users_companies` (`id`, `id_company`, `id_user`, `status`) VALUES
(1, 1, 1, 'ACTIVE');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sys_rel_users_pages`
--

CREATE TABLE `sys_rel_users_pages` (
  `id_user` int(11) NOT NULL,
  `id_page` int(11) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'ACTIVE',
  `permission` tinyint(1) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sys_rel_users_pages`
--

INSERT INTO `sys_rel_users_pages` (`id_user`, `id_page`, `status`, `permission`, `id`) VALUES
(1, 1, 'ACTIVE', 1, 1),
(1, 2, 'ACTIVE', 1, 2),
(1, 3, 'ACTIVE', 1, 3),
(1, 4, 'ACTIVE', 1, 4),
(1, 5, 'ACTIVE', 1, 5),
(1, 6, 'ACTIVE', 1, 6),
(1, 7, 'ACTIVE', 1, 7),
(1, 8, 'ACTIVE', 1, 8),
(1, 9, 'ACTIVE', 1, 9),
(2, 1, 'ACTIVE', 0, 10),
(2, 2, 'ACTIVE', 0, 11),
(2, 3, 'ACTIVE', 0, 12),
(2, 4, 'ACTIVE', 0, 13),
(2, 5, 'ACTIVE', 0, 14),
(2, 6, 'ACTIVE', 0, 15),
(2, 7, 'ACTIVE', 0, 16),
(2, 8, 'ACTIVE', 0, 17),
(2, 9, 'ACTIVE', 0, 18),
(3, 1, 'ACTIVE', 0, 19),
(3, 2, 'ACTIVE', 0, 20),
(3, 3, 'ACTIVE', 0, 21),
(3, 4, 'ACTIVE', 0, 22),
(3, 5, 'ACTIVE', 0, 23),
(3, 6, 'ACTIVE', 0, 24),
(3, 7, 'ACTIVE', 0, 25),
(3, 8, 'ACTIVE', 0, 26),
(3, 9, 'ACTIVE', 0, 27);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sys_users`
--

CREATE TABLE `sys_users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'ACTIVE',
  `user_creater_id` int(10) NOT NULL DEFAULT '1',
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(200) NOT NULL,
  `avatarphoto` varchar(200) NOT NULL DEFAULT 'images/user.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sys_users`
--

INSERT INTO `sys_users` (`id`, `name`, `username`, `password`, `status`, `user_creater_id`, `create_date`, `update_date`, `email`, `avatarphoto`) VALUES
(1, 'superadmin', 'superadmin', '$2y$10$G3fB9tBfaaRaRUwHROk0p.TcbJwM1Gi7XytdM4SdMvfFdu7m47422', 'ACTIVE', 1, '2020-04-05 17:01:28', '2020-04-05 17:02:04', '', 'images/user.png'),
(2, 'Vasco Ribeiro', 'vascoribeiro21', '$2y$10$c0ZtPiKojvOSPAez.qW/4uV7i3UIc69Hb/Er6RlTbeBVdsouf2Tse', 'ACTIVE', 1, '2021-02-08 21:44:19', '2021-02-08 21:44:19', 'wow.vasco.ribeiro@gmail.com', 'images/837814585.jpg'),
(3, 'Vasco Ribeiro', '4234', '$2y$10$x.3vXi7P2KHqS7CZs8JyduUmjosJuzw0zYKT957wzY7yW0EW4.hrG', 'ACTIVE', 1, '2021-02-16 21:13:53', '2021-02-16 21:13:53', 'wow.vasco.ribeiro@gmail.com', 'images/249521938.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tl_about`
--

CREATE TABLE `tl_about` (
  `id` int(11) NOT NULL,
  `image_head` varchar(200) NOT NULL,
  `image_1` varchar(200) NOT NULL,
  `image_2` varchar(200) NOT NULL,
  `image_3` varchar(200) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'ACTIVE',
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tl_about`
--

INSERT INTO `tl_about` (`id`, `image_head`, `image_1`, `image_2`, `image_3`, `status`, `update_date`) VALUES
(1, 'images/574486264.png', 'images/781057548.jpg', 'images/222796812.jpg', 'images/221781765.jpg', 'ACTIVE', '2021-01-24 16:53:07');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tl_about_lang`
--

CREATE TABLE `tl_about_lang` (
  `id` int(11) NOT NULL,
  `id_tl_about` int(11) NOT NULL,
  `id_sys_lang` int(11) NOT NULL,
  `description_long` text CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `description_short` text CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'ACTIVE',
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tl_about_lang`
--

INSERT INTO `tl_about_lang` (`id`, `id_tl_about`, `id_sys_lang`, `description_long`, `description_short`, `status`, `update_date`) VALUES
(1, 1, 1, '<p>vasco rei da vascolandia&nbsp;</p>', '<p>vasco ribeiro nÃ£o</p>', 'ACTIVE', '0000-00-00 00:00:00'),
(2, 1, 2, 'teste ingles', '<p>vasco ribeiro not</p>', 'ACTIVE', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tl_blog`
--

CREATE TABLE `tl_blog` (
  `id` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tl_blog_lang`
--

CREATE TABLE `tl_blog_lang` (
  `id` int(11) NOT NULL,
  `id_tl_blog` int(11) NOT NULL,
  `id_sys_lang` int(11) NOT NULL,
  `text` text NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tl_contact`
--

CREATE TABLE `tl_contact` (
  `id` int(11) NOT NULL,
  `image_head` varchar(200) NOT NULL,
  `image_body` varchar(200) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'ACTIVE',
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tl_contact`
--

INSERT INTO `tl_contact` (`id`, `image_head`, `image_body`, `status`, `update_date`) VALUES
(1, 'images/732239719.jpg', 'images/815579154.png', 'ACTIVE', '2021-01-24 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tl_contact_lang`
--

CREATE TABLE `tl_contact_lang` (
  `id` int(11) NOT NULL,
  `id_tl_contact` int(11) NOT NULL,
  `id_sys_lang` int(11) NOT NULL,
  `description_long` text CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `description_short` text CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'ACTIVE',
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tl_contact_lang`
--

INSERT INTO `tl_contact_lang` (`id`, `id_tl_contact`, `id_sys_lang`, `description_long`, `description_short`, `status`, `update_date`) VALUES
(1, 1, 1, '<p>dfgdf</p>', '<p>vasco ribeiro portugeus</p>', 'ACTIVE', '2021-01-24 00:00:00'),
(2, 1, 2, '', '<p>vasco ingles</p>', 'ACTIVE', '2021-01-24 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tl_gallery`
--

CREATE TABLE `tl_gallery` (
  `id` int(11) NOT NULL,
  `image_head` varchar(200) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'ACTIVE',
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tl_gallery`
--

INSERT INTO `tl_gallery` (`id`, `image_head`, `status`, `update_date`) VALUES
(1, 'images/327269984.jpg', 'ACTIVE', '2021-01-24 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tl_gallery_item`
--

CREATE TABLE `tl_gallery_item` (
  `id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tl_gallery_item_image`
--

CREATE TABLE `tl_gallery_item_image` (
  `id` int(11) NOT NULL,
  `id_tl_gallery_item` int(11) NOT NULL,
  `image` int(11) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tl_gallery_item_lang`
--

CREATE TABLE `tl_gallery_item_lang` (
  `id` int(11) NOT NULL,
  `id_sys_lang` int(11) NOT NULL,
  `id_tl_gallery_item` int(11) NOT NULL,
  `text` text NOT NULL,
  `title` varchar(200) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tl_gallery_item_lang`
--

INSERT INTO `tl_gallery_item_lang` (`id`, `id_sys_lang`, `id_tl_gallery_item`, `text`, `title`, `status`) VALUES
(1, 2, 0, '', '', 'INACTIVE');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tl_gallery_lang`
--

CREATE TABLE `tl_gallery_lang` (
  `id` int(11) NOT NULL,
  `id_tl_gallery` int(11) NOT NULL,
  `id_sys_lang` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'ACTIVE',
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tl_gallery_lang`
--

INSERT INTO `tl_gallery_lang` (`id`, `id_tl_gallery`, `id_sys_lang`, `description`, `status`, `update_date`) VALUES
(1, 1, 1, '<p>sdfsdfsdf</p>', 'ACTIVE', '2021-01-24 00:00:00'),
(2, 1, 2, '<p>sdfsdfsdfdfgdfg</p>', 'ACTIVE', '2021-01-24 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sys_companies`
--
ALTER TABLE `sys_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_lang`
--
ALTER TABLE `sys_lang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_modules`
--
ALTER TABLE `sys_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_pages`
--
ALTER TABLE `sys_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_rel_pages_modules`
--
ALTER TABLE `sys_rel_pages_modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_module` (`id_module`),
  ADD KEY `id_page` (`id_page`);

--
-- Indexes for table `sys_rel_users_companies`
--
ALTER TABLE `sys_rel_users_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_rel_users_pages`
--
ALTER TABLE `sys_rel_users_pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_page` (`id_page`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `sys_users`
--
ALTER TABLE `sys_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tl_about`
--
ALTER TABLE `tl_about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tl_about_lang`
--
ALTER TABLE `tl_about_lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreing_tl_about` (`id_tl_about`),
  ADD KEY `id_sys_lang` (`id_sys_lang`);

--
-- Indexes for table `tl_blog`
--
ALTER TABLE `tl_blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tl_blog_lang`
--
ALTER TABLE `tl_blog_lang`
  ADD KEY `id_sys_lang` (`id_sys_lang`),
  ADD KEY `id_tl_blog` (`id_tl_blog`);

--
-- Indexes for table `tl_contact`
--
ALTER TABLE `tl_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tl_contact_lang`
--
ALTER TABLE `tl_contact_lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sys_lang` (`id_sys_lang`),
  ADD KEY `id_tl_contact` (`id_tl_contact`);

--
-- Indexes for table `tl_gallery`
--
ALTER TABLE `tl_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tl_gallery_item`
--
ALTER TABLE `tl_gallery_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tl_gallery_item_image`
--
ALTER TABLE `tl_gallery_item_image`
  ADD KEY `id_tl_gallery_item` (`id_tl_gallery_item`);

--
-- Indexes for table `tl_gallery_item_lang`
--
ALTER TABLE `tl_gallery_item_lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sys_lang` (`id_sys_lang`);

--
-- Indexes for table `tl_gallery_lang`
--
ALTER TABLE `tl_gallery_lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sys_lang` (`id_sys_lang`),
  ADD KEY `id_tl_gallery` (`id_tl_gallery`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sys_companies`
--
ALTER TABLE `sys_companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sys_lang`
--
ALTER TABLE `sys_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sys_modules`
--
ALTER TABLE `sys_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sys_pages`
--
ALTER TABLE `sys_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sys_rel_pages_modules`
--
ALTER TABLE `sys_rel_pages_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sys_rel_users_companies`
--
ALTER TABLE `sys_rel_users_companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sys_rel_users_pages`
--
ALTER TABLE `sys_rel_users_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `sys_users`
--
ALTER TABLE `sys_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tl_about`
--
ALTER TABLE `tl_about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tl_about_lang`
--
ALTER TABLE `tl_about_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tl_contact`
--
ALTER TABLE `tl_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tl_contact_lang`
--
ALTER TABLE `tl_contact_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tl_gallery`
--
ALTER TABLE `tl_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tl_gallery_item_lang`
--
ALTER TABLE `tl_gallery_item_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tl_gallery_lang`
--
ALTER TABLE `tl_gallery_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `sys_rel_pages_modules`
--
ALTER TABLE `sys_rel_pages_modules`
  ADD CONSTRAINT `sys_rel_pages_modules_ibfk_1` FOREIGN KEY (`id_module`) REFERENCES `sys_modules` (`id`),
  ADD CONSTRAINT `sys_rel_pages_modules_ibfk_2` FOREIGN KEY (`id_page`) REFERENCES `sys_pages` (`id`);

--
-- Limitadores para a tabela `sys_rel_users_pages`
--
ALTER TABLE `sys_rel_users_pages`
  ADD CONSTRAINT `sys_rel_users_pages_ibfk_1` FOREIGN KEY (`id_page`) REFERENCES `sys_pages` (`id`),
  ADD CONSTRAINT `sys_rel_users_pages_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `sys_users` (`id`);

--
-- Limitadores para a tabela `tl_about_lang`
--
ALTER TABLE `tl_about_lang`
  ADD CONSTRAINT `foreing_tl_about` FOREIGN KEY (`id_tl_about`) REFERENCES `tl_about` (`id`),
  ADD CONSTRAINT `tl_about_lang_ibfk_1` FOREIGN KEY (`id_sys_lang`) REFERENCES `sys_lang` (`id`);

--
-- Limitadores para a tabela `tl_blog_lang`
--
ALTER TABLE `tl_blog_lang`
  ADD CONSTRAINT `tl_blog_lang_ibfk_1` FOREIGN KEY (`id_sys_lang`) REFERENCES `sys_lang` (`id`),
  ADD CONSTRAINT `tl_blog_lang_ibfk_2` FOREIGN KEY (`id_tl_blog`) REFERENCES `tl_blog` (`id`);

--
-- Limitadores para a tabela `tl_contact_lang`
--
ALTER TABLE `tl_contact_lang`
  ADD CONSTRAINT `tl_contact_lang_ibfk_1` FOREIGN KEY (`id_sys_lang`) REFERENCES `sys_lang` (`id`),
  ADD CONSTRAINT `tl_contact_lang_ibfk_2` FOREIGN KEY (`id_tl_contact`) REFERENCES `tl_contact` (`id`);

--
-- Limitadores para a tabela `tl_gallery_item_image`
--
ALTER TABLE `tl_gallery_item_image`
  ADD CONSTRAINT `tl_gallery_item_image_ibfk_1` FOREIGN KEY (`id_tl_gallery_item`) REFERENCES `tl_gallery_item` (`id`);

--
-- Limitadores para a tabela `tl_gallery_item_lang`
--
ALTER TABLE `tl_gallery_item_lang`
  ADD CONSTRAINT `tl_gallery_item_lang_ibfk_1` FOREIGN KEY (`id_sys_lang`) REFERENCES `sys_lang` (`id`);

--
-- Limitadores para a tabela `tl_gallery_lang`
--
ALTER TABLE `tl_gallery_lang`
  ADD CONSTRAINT `tl_gallery_lang_ibfk_1` FOREIGN KEY (`id_sys_lang`) REFERENCES `sys_lang` (`id`),
  ADD CONSTRAINT `tl_gallery_lang_ibfk_2` FOREIGN KEY (`id_tl_gallery`) REFERENCES `tl_gallery` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
