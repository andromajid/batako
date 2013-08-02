-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 02, 2013 at 08:42 PM
-- Server version: 5.5.32-0ubuntu0.13.04.1
-- PHP Version: 5.4.9-4ubuntu2.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `batako`
--

-- --------------------------------------------------------

--
-- Table structure for table `con_action`
--

CREATE TABLE IF NOT EXISTS `con_action` (
  `con_action_id` int(14) NOT NULL AUTO_INCREMENT,
  `con_action_data` varchar(127) DEFAULT NULL,
  `con_action_message` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`con_action_id`),
  FULLTEXT KEY `con_action_data` (`con_action_data`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `con_action`
--

INSERT INTO `con_action` (`con_action_id`, `con_action_data`, `con_action_message`) VALUES
(1, 'dashboard.index', NULL),
(2, 'project.view', NULL),
(3, 'project.create', NULL),
(4, 'project.update', NULL),
(5, 'project.delete', NULL),
(6, 'project.index', NULL),
(7, 'project.admin', NULL),
(8, 'site.index', NULL),
(9, 'site.error', NULL),
(10, 'site.contact', NULL),
(11, 'site.login', NULL),
(12, 'site.logout', NULL),
(13, 'site.captcha', NULL),
(14, 'sprint.create', NULL),
(15, 'sprint.update', NULL),
(16, 'sprint.view', NULL),
(17, 'sprint.assign_task', NULL),
(18, 'sprint.start_task', NULL),
(19, 'task.create', NULL),
(20, 'task.update', NULL),
(21, 'task.project', NULL),
(22, 'task.view', NULL),
(23, 'task.update_progress', NULL),
(24, 'task.update_comment', NULL),
(25, 'task.file_delete', NULL),
(26, 'task_type.view', NULL),
(27, 'task_type.create', NULL),
(28, 'task_type.update', NULL),
(29, 'task_type.delete', NULL),
(30, 'task_type.index', NULL),
(31, 'task_type.admin', NULL),
(32, 'user.view', NULL),
(33, 'user.create', NULL),
(34, 'user.update', NULL),
(35, 'user.delete', NULL),
(36, 'user.index', NULL),
(37, 'user.admin', NULL),
(38, 'user_role.view', NULL),
(39, 'user_role.create', NULL),
(40, 'user_role.update', NULL),
(41, 'user_role.delete', NULL),
(42, 'user_role.index', NULL),
(43, 'user_role.right', NULL),
(44, 'user_role.list', NULL),
(45, 'usergroup.index', NULL),
(46, 'usergroup.update', NULL),
(47, 'usergroup.delete', NULL),
(48, 'usergroup.create', NULL),
(49, 'sprint.kanban', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `con_action_user_role`
--

CREATE TABLE IF NOT EXISTS `con_action_user_role` (
  `con_action_user_role_con_action_id` int(14) NOT NULL DEFAULT '0',
  `con_action_user_role_user_role_id` int(14) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `con_action_user_role`
--

INSERT INTO `con_action_user_role` (`con_action_user_role_con_action_id`, `con_action_user_role_user_role_id`) VALUES
(40, 1),
(43, 1),
(44, 1),
(42, 1),
(41, 1),
(39, 1),
(46, 1),
(45, 1),
(47, 1),
(48, 1),
(32, 1),
(34, 1),
(36, 1),
(35, 1),
(33, 1),
(37, 1),
(26, 1),
(28, 1),
(30, 1),
(29, 1),
(27, 1),
(31, 1),
(22, 1),
(23, 1),
(24, 1),
(20, 1),
(21, 1),
(25, 1),
(19, 1),
(16, 1),
(15, 1),
(18, 1),
(49, 1),
(14, 1),
(17, 1),
(12, 1),
(11, 1),
(8, 1),
(9, 1),
(10, 1),
(13, 1),
(2, 1),
(4, 1),
(6, 1),
(5, 1),
(3, 1),
(7, 1),
(1, 1),
(38, 1);

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) NOT NULL,
  `file_mime` varchar(63) DEFAULT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`file_id`, `file_name`, `file_mime`) VALUES
(6, 'Screenshot from 2013-05-03 23:20:56.png', 'image/png'),
(7, 'Screenshot from 2013-05-04 21:31:13.png', 'image/png'),
(10, '2.jpg', 'image/jpeg'),
(11, '408178_3711407750621_1351469349_n.jpg', 'image/jpeg'),
(12, '4863163_20121106085942.jpg', 'image/jpeg'),
(13, '2.jpg', 'image/jpeg'),
(14, '408178_3711407750621_1351469349_n.jpg', 'image/jpeg'),
(15, '4863163_20121106085942.jpg', 'image/jpeg'),
(18, 'fullcalendar-1.5.4.zip', 'application/zip'),
(19, 'taitems-Aristo-jQuery-UI-Theme-c50d9b5.zip', 'application/zip'),
(20, 'bootstrap.js', 'application/javascript'),
(21, 'bootstrap.min.js', 'application/javascript');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(255) NOT NULL,
  `project_url` varchar(255) DEFAULT NULL,
  `project_description` text,
  `project_budget` bigint(20) DEFAULT NULL,
  `project_icon` varchar(45) DEFAULT NULL,
  `project_is_active` enum('1','0') NOT NULL DEFAULT '1',
  `project_user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`project_id`),
  KEY `fk_project_user1` (`project_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_name`, `project_url`, `project_description`, `project_budget`, `project_icon`, `project_is_active`, `project_user_id`) VALUES
(1, 'Arkasoft', 'http://arkasoft.com', 'dsadadadad', 1000000, '20120205_112047.jpg', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sprint`
--

CREATE TABLE IF NOT EXISTS `sprint` (
  `sprint_id` int(11) NOT NULL AUTO_INCREMENT,
  `sprint_name` varchar(127) NOT NULL,
  `sprint_start_date` date DEFAULT NULL,
  `sprint_end_date` date DEFAULT NULL,
  PRIMARY KEY (`sprint_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sprint`
--

INSERT INTO `sprint` (`sprint_id`, `sprint_name`, `sprint_start_date`, `sprint_end_date`) VALUES
(1, 'ini adalah sprint pertama', '2013-05-22', '0000-00-00'),
(2, 'ini adalah sprint kedua', '2013-05-22', '0000-00-00'),
(3, 'sprint 3 v1', '2013-05-26', '2013-05-30');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_title` varchar(127) NOT NULL,
  `task_description` text,
  `task_point` int(11) NOT NULL DEFAULT '0',
  `task_creator_user_id` int(11) DEFAULT NULL,
  `task_assign_user_id` int(11) DEFAULT NULL,
  `task_create_datetime` datetime DEFAULT NULL,
  `task_start_datetime` datetime DEFAULT NULL,
  `task_end_datetime` datetime DEFAULT NULL,
  `task_estimate_hour` int(11) DEFAULT NULL,
  `task_project_id` int(11) DEFAULT NULL,
  `task_task_type_id` int(11) DEFAULT NULL,
  `task_is_end` enum('1','0') NOT NULL DEFAULT '0',
  `task_is_start` enum('1','0') NOT NULL DEFAULT '0',
  `task_progress` int(11) DEFAULT NULL,
  PRIMARY KEY (`task_id`),
  KEY `task_project_id` (`task_project_id`),
  KEY `task_task_type_id` (`task_task_type_id`),
  KEY `task_creator_user_id` (`task_creator_user_id`),
  KEY `task_assign_user_id` (`task_assign_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `task_title`, `task_description`, `task_point`, `task_creator_user_id`, `task_assign_user_id`, `task_create_datetime`, `task_start_datetime`, `task_end_datetime`, `task_estimate_hour`, `task_project_id`, `task_task_type_id`, `task_is_end`, `task_is_start`, `task_progress`) VALUES
(4, 'dasdas', '<p>dasdasd</p>', 32, 1, 1, NULL, '2013-05-29 21:47:42', NULL, NULL, 1, 1, '0', '1', 13),
(5, 'ini adalah title', '<p><table><tbody><tr><td><a href="https://github.com/tarruda/bootstrap-datetimepicker/tree/master/build">build</a></td><td><time>19 days ago</time></td><td><a href="https://github.com/tarruda/bootstrap-datetimepicker/commit/c26217db8840e5aa8f56e343ce307581960543c9">Updated compiled files</a>&nbsp;[<a href="https://github.com/tarruda">tarruda</a>]</td></tr><tr><td><a href="https://github.com/tarruda/bootstrap-datetimepicker/tree/master/src">src</a></td><td><time>19 days ago</time></td><td><a href="https://github.com/tarruda/bootstrap-datetimepicker/commit/9477705b4fe9470d3f84b471f8050de187b52fe7">Merge branch ''master'' of github.com:gpbmike/bootstrap-datetimepicker ?</a>&nbsp;[<a href="https://github.com/tarruda">tarruda</a>]</td></tr><tr><td><a href="https://github.com/tarruda/bootstrap-datetimepicker/tree/master/test">test</a></td><td><time>2 months ago</time></td><td><a href="https://github.com/tarruda/bootstrap-datetimepicker/commit/4869bab27f5353facc9ad0fbb81bb7277bccc7af">Fixed timezone bug in tests: results varied because of user''s timezone</a>&nbsp;[<a href="https://github.com/carlo1138">carlo1138</a>]</td></tr><tr><td><a href="https://github.com/tarruda/bootstrap-datetimepicker/blob/master/.gitignore">.gitignore</a></td><td><time>3 months ago</time></td><td><a href="https://github.com/tarruda/bootstrap-datetimepicker/commit/697a485d444ecf664fe55023b4f1d1e71dada885">Updated gitignore</a>&nbsp;[<a href="https://github.com/tarruda">tarruda</a>]</td></tr><tr><td><a href="https://github.com/tarruda/bootstrap-datetimepicker/blob/master/.gitmodules">.gitmodules</a></td><td><time>4 months ago</time></td><td><a href="https://github.com/tarruda/bootstrap-datetimepicker/commit/f06840284e5974c1d0f5bc1dd242b8c059dc2cb0">Re-added twitter bootstrap as a submodule</a>&nbsp;[<a href="https://github.com/tarruda">tarruda</a>]</td></tr><tr><td><a href="https://github.com/tarruda/bootstrap-datetimepicker/blob/master/.lvimrc">.lvimrc</a></td><td><time>5 months ago</time></td><td><a href="https://github.com/tarruda/bootstrap-datetimepicker/commit/bee192bc0f6e0ecad0f54ae82b2e824beea24efb">Changed indent settings</a>&nbsp;[<a href="https://github.com/tarruda">tarruda</a>]</td></tr><tr><td><a href="https://github.com/tarruda/bootstrap-datetimepicker/blob/master/.npmignore">.npmignore</a></td><td><time>5 months ago</time></td><td><a href="https://github.com/tarruda/bootstrap-datetimepicker/commit/fa9085808e9ba5506630ea40fcf319c0933a674a">Updated package json</a>&nbsp;[<a href="https://github.com/tarruda">tarruda</a>]</td></tr><tr><td><a href="https://github.com/tarruda/bootstrap-datetimepicker/blob/master/CONTRIBUTING.md">CONTRIBUTING.md</a></td><td><time>2 months ago</time></td><td><a href="https://github.com/tarruda/bootstrap-datetimepicker/commit/1502c4decba9d7066a3b29c1e9bb5395bdff35e6">Build minified script and updated contribute guide</a>&nbsp;[<a href="https://github.com/tarruda">tarruda</a>]</td></tr><tr><td><a href="https://github.com/tarruda/bootstrap-datetimepicker/blob/master/LICENSE">LICENSE</a></td><td><time>5 months ago</time></td><td><a href="https://github.com/tarruda/bootstrap-datetimepicker/commit/136ea4678943db67ae7c44b4265da1792e1425d0">Initial import of Stefan Petre''s code</a>&nbsp;[<a href="https://github.com/tarruda">tarruda</a>]</td></tr><tr><td><a href="https://github.com/tarruda/bootstrap-datetimepicker/blob/master/Makefile">Makefile</a></td><td><time>3 months ago</time></td><td><a href="https://github.com/tarruda/bootstrap-datetimepicker/commit/8e2913263ca53aaf799c6bb5f4a2c18fb18624d0">Fixes</a>&nbsp;<a href="https://github.com/tarruda/bootstrap-datetimepicker/issues/61">#61</a>&nbsp;[<a href="https://github.com/tarruda">tarruda</a>]</td></tr><tr><td><a href="https://github.com/tarruda/bootstrap-datetimepicker/blob/master/README.md">README.md</a></td><td><time>5 months ago</time></td><td><a href="https://github.com/tarruda/bootstrap-datetimepicker/commit/2f77c7d4444e7faaab7aa4307cf384bade3e1ac2">Updated README</a>&nbsp;[<a href="https://github.com/tarruda">tarruda</a>]</td></tr><tr><td><a href="https://github.com/twitter/bootstrap">bootstrap</a>&nbsp;@&nbsp;<a href="https://github.com/twitter/bootstrap/tree/9376a7c221a64c2bf508d02ea2ccd85748d10fcc">9376a7c</a></td><td><time>4 months ago</time></td><td><a href="https://github.com/tarruda/bootstrap-datetimepicker/commit/f06840284e5974c1d0f5bc1dd242b8c059dc2cb0">Re-added twitter bootstrap as a submodule</a>&nbsp;[<a href="https://github.com/tarruda">tarruda</a>]</td></tr><tr><td><a href="https://github.com/tarruda/bootstrap-datetimepicker/blob/master/component.json">component.json</a></td><td><time>19 days ago</time></td><td><a href="https://github.com/tarruda/bootstrap-datetimepicker/commit/2403664c00e5a7d5a9c21538de295934f747ee4f">Updated bower package for new version</a>&nbsp;[<a href="https://github.com/tarruda">tarruda</a>]</td></tr><tr><td><a href="https://github.com/tarruda/bootstrap-datetimepicker/blob/master/package.json">package.json</a></td><td><time>3 months ago</time></td><td><a href="https://github.com/tarruda/bootstrap-datetimepicker/commit/1e515a349d7ce9c3281ec41df5ece56fa13fc2e0">Use maskInput = false as default now</a>&nbsp;[<a href="https://github.com/tarruda">tarruda</a>]</td></tr></tbody></table></p>\r\n', 45, NULL, 1, NULL, '0000-00-00 00:00:00', NULL, NULL, 1, 1, '0', '0', 12),
(6, 'dadasd', '<p>asdasdasd</p>', 56, NULL, 2, NULL, '0000-00-00 00:00:00', NULL, NULL, 1, 3, '0', '0', 48);

-- --------------------------------------------------------

--
-- Table structure for table `task_comment`
--

CREATE TABLE IF NOT EXISTS `task_comment` (
  `task_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_comment_user_id` int(11) DEFAULT NULL,
  `task_comment_task_id` int(11) DEFAULT NULL,
  `task_comment_text` text,
  `task_comment_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`task_comment_id`),
  KEY `task_comment_user_id` (`task_comment_user_id`),
  KEY `task_comment_task_id` (`task_comment_task_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `task_comment`
--

INSERT INTO `task_comment` (`task_comment_id`, `task_comment_user_id`, `task_comment_task_id`, `task_comment_text`, `task_comment_datetime`) VALUES
(3, NULL, NULL, '<p>iniadalahsuatucomment</p>', '2013-05-18 21:50:56'),
(4, 1, 6, '<p>iniadalahsuatucomment</p>', '2013-05-18 21:52:39'),
(5, 1, 6, '<p><p>Loremipsumdolorsitamet,consecteturadipiscingelit.Maecenasmetuslibero,variusacdictumporta,venenatisnecneque.Aeneanacnibhtellus.Cumsociisnatoquepenatibusetmagnisdisparturientmontes,nasceturridiculusmus.Loremipsumdolorsitamet,consecteturadipiscingelit.Seddiamnisi,consectetursedvenenatisvel,elementuminneque.Doneccondimentumtemportincidunt.Suspendissenonnisinisl.Fuscesednullaeunislelementumsuscipitutquissem.Namdictummassavelipsumhendreritathendreritligulafermentum.Aeneaniaculisnislatleovestibulumtristiqueacetquam.Maurisvestibulumdapibusmetus,vitaeconvallisantevenenatisat.Aliquamconguegravidalacusegetelementum.Crasviverratortoretelitcursussemper.Aliquamvolutpatdolornecfeliseuismodporta.Fusceporttitorvariusipsum,euposuerepurusplaceratsed.Pellentesquenecdolorante,quisultriceslorem.</p><p>Nuncquamsapien,scelerisqueegettinciduntid,variustempusarcu.Aliquamvitaeorcilacus,facilisiselementumturpis.Etiamviverrarisusligula.Nullamcursusullamcorpervestibulum.Aliquamultrices,justopretiumcursustempor,tellusaugueluctusnulla,sitameteleifendlacusdiamutnibh.Maurisatjustomassa,eucondimentumarcu.Praesentmolestie,anteatfacilisisviverra,odiosapienlaciniadolor,nonconsequatlacusnisivitaejusto.Phaselluscommodoportaquamvelvolutpat.</p><p>Vivamusblanditposuereliberoacsagittis.Pellentesquecommodonibhacjustoconvallisporta.Nullamfacilisisnuncidnuncdignissimnonmalesuadaurnainterdum.Vivamusvestibulumpulvinarestavulputate.Maecenasutjustoposuerefelisfaucibushendrerit.Etiamquisjustononturpisfacilisisiaculis.Morbidignissimiaculisleoetconsequat.Sedpulvinarsemegetnullaaliquetconvallis.Donecconvallis,maurisplaceratpretiumtristique,lectustortorfeugiatlectus,aportaturpislectusaurna.Sedeleifendbibendumdapibus.</p><p>Nullameuenimaugue.Nullasedpurussitametmassaaliquetmattis.Integercongue,tortorsitametluctusaliquet,diamdolorlobortisdolor,quisiaculisodioloremimperdietaugue.Pellentesquesitametnullasitametmagnatinciduntsemper.Crasveltristiquetortor.Aliquamtempor,metusnonfacilisiseleifend,nibhduiplaceratarcu,utelementumtortorestidurna.Loremipsumdolorsitamet,consecteturadipiscingelit.Nuncporttitorvariusnunc,veltinciduntarcumattisvel.Quisquedignissimvenenatisturpis,sitametluctuspuruslaciniaeget.Namodionulla,venenatisetpulvinarquis,ultricesnonerat.Suspendisseeuimperdietdiam.Pellentesquehabitantmorbitristiquesenectusetnetusetmalesuadafamesacturpisegestas.</p><p>Donecinegestasmassa.Crasatarcusedmagnaiaculishendreritsedidtellus.Vivamusnuncnunc,hendreritatlobortissagittis,porttitoreleifendipsum.Quisquevitaefelisvenenatisipsumporttitortinciduntidinante.Etiamnonmaurissedsempharetraplaceratvelvitaelectus.Pellentesquehabitantmorbitristiquesenectusetnetusetmalesuadafamesacturpisegestas.Nullanisiorci,scelerisquesitametlaoreeteu,interdumutdui.Aliquamaliqueteleifendmetus,sedvehiculaesttemporsed.Etiammagnametus,tinciduntatultriciesnec,faucibusvulputateipsum.Donecornarepurusportatellusultricesquisviverraurnafaucibus.Nullaluctuscursusturpisegetaccumsan.Cumsociisnatoquepenatibusetmagnisdisparturientmontes,nasceturridiculusmus.Aliquamrutrumfacilisisnisl,egetlobortisnisicursuseget.</p><br></p>', '2013-05-19 11:07:03'),
(6, 1, 6, '<p><p>Loremipsumdolorsitamet,consecteturadipiscingelit.Maecenasmetuslibero,variusacdictumporta,venenatisnecneque.Aeneanacnibhtellus.Cumsociisnatoquepenatibusetmagnisdisparturientmontes,nasceturridiculusmus.Loremipsumdolorsitamet,consecteturadipiscingelit.Seddiamnisi,consectetursedvenenatisvel,elementuminneque.Doneccondimentumtemportincidunt.Suspendissenonnisinisl.Fuscesednullaeunislelementumsuscipitutquissem.Namdictummassavelipsumhendreritathendreritligulafermentum.Aeneaniaculisnislatleovestibulumtristiqueacetquam.Maurisvestibulumdapibusmetus,vitaeconvallisantevenenatisat.Aliquamconguegravidalacusegetelementum.Crasviverratortoretelitcursussemper.Aliquamvolutpatdolornecfeliseuismodporta.Fusceporttitorvariusipsum,euposuerepurusplaceratsed.Pellentesquenecdolorante,quisultriceslorem.</p><p>Nuncquamsapien,scelerisqueegettinciduntid,variustempusarcu.Aliquamvitaeorcilacus,facilisiselementumturpis.Etiamviverrarisusligula.Nullamcursusullamcorpervestibulum.Aliquamultrices,justopretiumcursustempor,tellusaugueluctusnulla,sitameteleifendlacusdiamutnibh.Maurisatjustomassa,eucondimentumarcu.Praesentmolestie,anteatfacilisisviverra,odiosapienlaciniadolor,nonconsequatlacusnisivitaejusto.Phaselluscommodoportaquamvelvolutpat.</p><p>Vivamusblanditposuereliberoacsagittis.Pellentesquecommodonibhacjustoconvallisporta.Nullamfacilisisnuncidnuncdignissimnonmalesuadaurnainterdum.Vivamusvestibulumpulvinarestavulputate.Maecenasutjustoposuerefelisfaucibushendrerit.Etiamquisjustononturpisfacilisisiaculis.Morbidignissimiaculisleoetconsequat.Sedpulvinarsemegetnullaaliquetconvallis.Donecconvallis,maurisplaceratpretiumtristique,lectustortorfeugiatlectus,aportaturpislectusaurna.Sedeleifendbibendumdapibus.</p><p>Nullameuenimaugue.Nullasedpurussitametmassaaliquetmattis.Integercongue,tortorsitametluctusaliquet,diamdolorlobortisdolor,quisiaculisodioloremimperdietaugue.Pellentesquesitametnullasitametmagnatinciduntsemper.Crasveltristiquetortor.Aliquamtempor,metusnonfacilisiseleifend,nibhduiplaceratarcu,utelementumtortorestidurna.Loremipsumdolorsitamet,consecteturadipiscingelit.Nuncporttitorvariusnunc,veltinciduntarcumattisvel.Quisquedignissimvenenatisturpis,sitametluctuspuruslaciniaeget.Namodionulla,venenatisetpulvinarquis,ultricesnonerat.Suspendisseeuimperdietdiam.Pellentesquehabitantmorbitristiquesenectusetnetusetmalesuadafamesacturpisegestas.</p><p>Donecinegestasmassa.Crasatarcusedmagnaiaculishendreritsedidtellus.Vivamusnuncnunc,hendreritatlobortissagittis,porttitoreleifendipsum.Quisquevitaefelisvenenatisipsumporttitortinciduntidinante.Etiamnonmaurissedsempharetraplaceratvelvitaelectus.Pellentesquehabitantmorbitristiquesenectusetnetusetmalesuadafamesacturpisegestas.Nullanisiorci,scelerisquesitametlaoreeteu,interdumutdui.Aliquamaliqueteleifendmetus,sedvehiculaesttemporsed.Etiammagnametus,tinciduntatultriciesnec,faucibusvulputateipsum.Donecornarepurusportatellusultricesquisviverraurnafaucibus.Nullaluctuscursusturpisegetaccumsan.Cumsociisnatoquepenatibusetmagnisdisparturientmontes,nasceturridiculusmus.Aliquamrutrumfacilisisnisl,egetlobortisnisicursuseget.</p><br></p>', '2013-05-19 11:08:02'),
(7, 1, 6, '<p><p></p><p></p><div><p><strong>LoremIpsum</strong>&nbsp;adalahcontohteksataudummydalamindustripercetakandanpenataanhurufatautypesetting.LoremIpsumtelahmenjadistandarcontohtekssejaktahun1500an,saatseorangtukangcetakyangtidakdikenalmengambilsebuahkumpulanteksdanmengacaknyauntukmenjadisebuahbukucontohhuruf.Iatidakhanyabertahanselama5abad,tapijugatelahberalihkepenataanhurufelektronik,tanpaadaperubahanapapun.Iamulaidipopulerkanpadatahun1960dengandiluncurkannyalembaran-lembaranLetrasetyangmenggunakankalimat-kalimatdariLoremIpsum,danseiringmunculnyaperangkatlunakDesktopPublishingsepertiAldusPageMakerjugamemilikiversiLoremIpsum.</p><p>Sudahmerupakanfaktabahwaseorangpembacaakanterpengaruholehisitulisandarisebuahhalamansaatiamelihattataletaknya.MaksudpenggunaanLoremIpsumadalahkarenaiakuranglebihmemilikipenyebaranhurufyangnormal,ketimbangmenggunakankalimatseperti"Bagianisidisini,bagianisidisini",sehinggaiaseolahmenjadinaskahInggrisyangbisadibaca.BanyakpaketDesktopPublishingdaneditorsituswebyangkinimenggunakanLoremIpsumsebagaicontohteks.Karenanyapencarianterhadapkalimat"LoremIpsum"akanberujungpadabanyaksituswebyangmasihdalamtahappengembangan.Berbagaiversijugatelahberubahdaritahunketahun,kadangkarenatidaksengaja,kadangkarenadisengaja(misalnyakarenadimasukkanunsurhumoratausemacamnya)</p></div><p></p><div><p>Tidaksepertianggapanbanyakorang,LoremIpsumbukanlahteks-teksyangdiacak.Iaberakardarisebuahnaskahsastralatinklasikdariera45sebelummasehi,hinggabisadipastikanusianyatelahmencapailebihdari2000tahun.RichardMcClintock,seorangprofessorBahasaLatindariHampden-SidneyCollegediVirginia,mencobamencarimaknasalahsatukatalatinyangdianggappalingtidakjelas,yakniconsectetur,yangdiambildarisalahsatubagianLoremIpsum.Setelahiamencarimaknanyadidiliteraturklasik,iamendapatkansebuahsumberyangtidakbisadiragukan.LoremIpsumberasaldaribagian1.10.32dan1.10.33darinaskah"deFinibusBonorumetMalorum"(SisiEkstrimdariKebaikandanKejahatan)karyaCicero,yangditulispadatahun45sebelummasehi.BUkuiniadalahrisalahdariteorietikayangsangatterkenalpadamasaRenaissance.BarispertamadariLoremIpsum,"Loremipsumdolorsitamet..",berasaldarisebuahbarisdibagian1.10.32.</p><p>BagianstandardariteksLoremIpsumyangdigunakansejaktahun1500ankinidireproduksikembalidibawahiniuntukmerekayangtertarik.Bagian1.10.32dan1.10.33dari"deFinibusBonorumetMalorum"karyaCicerojugadireproduksipersissepertibentukaslinya,diikutiolehversibahasaInggrisyangberasaldariterjemahantahun1914olehH.Rackham.</p></div><br></p>', '2013-05-19 12:24:38'),
(8, 2, 6, '<p>test asdasd dasdasd</p>\r\n', '2013-05-19 15:12:10'),
(9, 2, 6, '<p>iniadalhtest edit dasdasd</p>\r\n', '2013-05-20 20:21:06');

-- --------------------------------------------------------

--
-- Table structure for table `task_comment_file`
--

CREATE TABLE IF NOT EXISTS `task_comment_file` (
  `task_comment_file_task_comment_id` int(11) NOT NULL,
  `task_comment_file_file_id` int(11) NOT NULL,
  KEY `task_comment_file_task_comment_id` (`task_comment_file_task_comment_id`,`task_comment_file_file_id`),
  KEY `task_comment_file_file_id` (`task_comment_file_file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_comment_file`
--

INSERT INTO `task_comment_file` (`task_comment_file_task_comment_id`, `task_comment_file_file_id`) VALUES
(3, 10),
(3, 11),
(3, 12),
(4, 13),
(4, 14),
(4, 15),
(7, 18),
(7, 19);

-- --------------------------------------------------------

--
-- Table structure for table `task_file`
--

CREATE TABLE IF NOT EXISTS `task_file` (
  `task_file_task_id` int(11) NOT NULL,
  `task_file_file_id` int(11) NOT NULL,
  KEY `task_file_task_id` (`task_file_task_id`,`task_file_file_id`),
  KEY `task_file_file_id` (`task_file_file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_file`
--

INSERT INTO `task_file` (`task_file_task_id`, `task_file_file_id`) VALUES
(5, 20),
(5, 21),
(6, 6),
(6, 7);

-- --------------------------------------------------------

--
-- Table structure for table `task_sprint`
--

CREATE TABLE IF NOT EXISTS `task_sprint` (
  `task_task_id` int(11) DEFAULT NULL,
  `sprint_sprint_id` int(11) DEFAULT NULL,
  KEY `fk_task_has_sprint_sprint1` (`sprint_sprint_id`),
  KEY `fk_task_has_sprint_task1` (`task_task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_sprint`
--

INSERT INTO `task_sprint` (`task_task_id`, `sprint_sprint_id`) VALUES
(5, 2),
(6, 2),
(6, 3),
(4, 3),
(5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `task_type`
--

CREATE TABLE IF NOT EXISTS `task_type` (
  `task_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_type_name` varchar(45) NOT NULL,
  `task_type_color` varchar(10) NOT NULL,
  `task_type_icon` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`task_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `task_type`
--

INSERT INTO `task_type` (`task_type_id`, `task_type_name`, `task_type_color`, `task_type_icon`) VALUES
(1, 'error', 'ff0000', 'wallpaper-64350.jpg'),
(2, 'feature', '0040ff', 'wallpaper-64350.jpg'),
(3, 'task', '2cf005', 'wallpaper-3925.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(127) NOT NULL,
  `user_realname` varchar(45) DEFAULT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_is_active` enum('0','1') DEFAULT '1',
  `user_is_administrator` enum('0','1') NOT NULL DEFAULT '0',
  `user_avatar` varchar(127) DEFAULT NULL,
  `user_role_user_role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `fk_user_user_role` (`user_role_user_role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `user_realname`, `user_email`, `user_password`, `user_is_active`, `user_is_administrator`, `user_avatar`, `user_role_user_role_id`) VALUES
(1, 'arkananta', 'arkananta majid', 'andromajid@gmail.com', '82d21e53f74b7a30c620f25404837be9', '1', '1', 'wallpaper-135147.jpg', 1),
(2, 'appleseed', 'andro majid', 'andromajid@gmail.com', '82d21e53f74b7a30c620f25404837be9', '1', '0', 'wallpaper-165515.jpg', 2),
(3, 'dr-arka', 'arkananta santyani jaballah majid', 'arka@andromajid.com', '82d21e53f74b7a30c620f25404837be9', '1', '0', 'DSC_1497_4R.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_notification`
--

CREATE TABLE IF NOT EXISTS `user_notification` (
  `user_notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_notification_user_id` int(11) NOT NULL,
  `user_notification_description` varchar(255) DEFAULT NULL,
  `user_notification_project_id` int(11) NOT NULL,
  `user_notification_datetitme` datetime DEFAULT NULL,
  PRIMARY KEY (`user_notification_id`),
  KEY `user_notification_user_id` (`user_notification_user_id`),
  KEY `user_notification_project_id` (`user_notification_project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `user_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role_name` varchar(127) NOT NULL,
  `user_role_is_active` enum('0','1') DEFAULT '1',
  PRIMARY KEY (`user_role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_role_id`, `user_role_name`, `user_role_is_active`) VALUES
(1, 'Scrum Master', '1'),
(2, 'Programmer', '1');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `fk_project_user1` FOREIGN KEY (`project_user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`task_creator_user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `task_ibfk_2` FOREIGN KEY (`task_assign_user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `task_ibfk_3` FOREIGN KEY (`task_project_id`) REFERENCES `project` (`project_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `task_ibfk_6` FOREIGN KEY (`task_task_type_id`) REFERENCES `task_type` (`task_type_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `task_comment`
--
ALTER TABLE `task_comment`
  ADD CONSTRAINT `task_comment_ibfk_1` FOREIGN KEY (`task_comment_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_comment_ibfk_2` FOREIGN KEY (`task_comment_task_id`) REFERENCES `task` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task_comment_file`
--
ALTER TABLE `task_comment_file`
  ADD CONSTRAINT `task_comment_file_ibfk_1` FOREIGN KEY (`task_comment_file_task_comment_id`) REFERENCES `task_comment` (`task_comment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_comment_file_ibfk_2` FOREIGN KEY (`task_comment_file_file_id`) REFERENCES `file` (`file_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task_file`
--
ALTER TABLE `task_file`
  ADD CONSTRAINT `task_file_ibfk_1` FOREIGN KEY (`task_file_task_id`) REFERENCES `task` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_file_ibfk_2` FOREIGN KEY (`task_file_file_id`) REFERENCES `file` (`file_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task_sprint`
--
ALTER TABLE `task_sprint`
  ADD CONSTRAINT `fk_task_has_sprint_sprint1` FOREIGN KEY (`sprint_sprint_id`) REFERENCES `sprint` (`sprint_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_task_has_sprint_task1` FOREIGN KEY (`task_task_id`) REFERENCES `task` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_user_role` FOREIGN KEY (`user_role_user_role_id`) REFERENCES `user_role` (`user_role_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `user_notification`
--
ALTER TABLE `user_notification`
  ADD CONSTRAINT `user_notification_ibfk_2` FOREIGN KEY (`user_notification_project_id`) REFERENCES `project` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_notification_ibfk_1` FOREIGN KEY (`user_notification_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
