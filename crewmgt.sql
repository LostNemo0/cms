-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2024 at 06:12 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crewmgt`
--

-- --------------------------------------------------------

--
-- Table structure for table `crewdocs`
--

CREATE TABLE `crewdocs` (
  `id` int(11) NOT NULL,
  `crewid` varchar(45) DEFAULT NULL,
  `code` varchar(200) DEFAULT NULL,
  `doctype` varchar(200) DEFAULT NULL,
  `docname` varchar(200) DEFAULT NULL,
  `docnum` varchar(200) DEFAULT NULL,
  `dateissued` date DEFAULT NULL,
  `dateexpire` date DEFAULT NULL,
  `uploadedby` varchar(200) DEFAULT NULL,
  `docpath` varchar(350) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `crewdocs`
--

INSERT INTO `crewdocs` (`id`, `crewid`, `code`, `doctype`, `docname`, `docnum`, `dateissued`, `dateexpire`, `uploadedby`, `docpath`, `created_at`, `updated_at`) VALUES
(2, '6', 'DOC01', 'PHILIPPINE PASSPORT', 'Passport', 'P1000221', '2022-10-07', '2023-03-17', 'Admin A User', '/documents/6/passport.pdf', '2023-01-12 02:05:35', '2023-01-12 02:10:28');

-- --------------------------------------------------------

--
-- Table structure for table `crews`
--

CREATE TABLE `crews` (
  `id` int(11) NOT NULL,
  `firstname` varchar(200) DEFAULT NULL,
  `middlename` varchar(200) DEFAULT NULL,
  `lastname` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `rank` varchar(45) DEFAULT NULL,
  `height` varchar(45) DEFAULT NULL,
  `weight` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `crews`
--

INSERT INTO `crews` (`id`, `firstname`, `middlename`, `lastname`, `email`, `birthdate`, `age`, `address`, `rank`, `height`, `weight`, `created_at`, `updated_at`) VALUES
(6, 'John', 'A', 'Doe', 'john@mail.com', '1990-01-04', 33, 'Manila, Philippines', 'd21', '176', '74', '2023-01-11 17:54:20', '2024-01-10 15:51:50');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `code` varchar(765) DEFAULT NULL,
  `name` varchar(765) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`code`, `name`) VALUES
('PSCRB', 'COP_PROF. IN SURVIVAL CRAFT & RESCUE BOAT'),
('BSC', 'COP_STCW \'95 - BASIC SAFETY COURSE'),
('AFF', 'COP_ADVANCED TRAINING IN FIREFIGHTING'),
('MEFA', 'COP_MEDICAL EMERGENCY - FIRST AID'),
('MECA', 'COP_MEDICAL CARE'),
('NCOC', 'CERTIFICATE OF COMPETENCY FOR OFFICERS'),
('NCOE', 'ENDORSEMENT OF CERTIFICATE'),
('NGMDSS', 'PHILIPPINE GOC'),
('FLGMDSS', 'PANAMA GMDSS LICENSE'),
('FLGMDSB', 'PANAMA GMDSS SEAMAN\'S BOOK'),
('FL', 'PANAMA LICENSE'),
('FLSB', 'PANAMA SEAMAN BOOK'),
('FL', 'JAPANESE COC LICENSE'),
('FLSB', 'JAPANESE SEAMAN BOOK'),
('FLSSO', 'JAPANESE SSO -  CERT. OF COMPLETION(TRAINING)'),
('GOC', 'JAPANESE GOC'),
('ROC', 'JAPANESE ROC'),
('3RE', 'JAPANESE 3RD GRADE RADIO LICENSE'),
('HS', 'JAPANESE HEALTH SUPERVISOR'),
('SCC', 'JAPANESE COOK LICENSE'),
('MED', 'MEDICAL CERTIFICATE (PEME)'),
('ECDIS', 'ECDIS GENERIC'),
('SATC', 'COP_SDSD'),
('ISM', 'ISM/SMS ONLINE ASSESSMENT'),
('ISPS', 'ISPS ONLINE ASSESSMENT'),
('FLSSO', 'PANAMA SSO LICENSE'),
('FLSSO', 'COP_SHIP SECURTY OFFICER'),
('GOCSB', 'JAPANESE GOC BOOKLET'),
('ECDIS_JRC', 'ECDIS JRC 7201/9201'),
('ECDIS_FURUNO', 'ECDIS FURUNO FMD-3100/3200/3300'),
('CEMP', 'CONTRACT'),
('SIN_FL', 'SINGAPORE COE'),
('SIN_GOC', 'SINGAPORE GOC'),
('FLSSB', 'PANAMA SSO BOOK'),
('FLGMDSS', 'HONGKONG GMDSS'),
('FLGMDSS', 'CAYMAN GMDSS'),
('NGMDSS', 'CHINESE GMDSS'),
('6340', 'PHILIPPINE NC2 FOR (CHIEF COOK & 2ND COOK)'),
('6342', 'PHILIPPINE NC1 FOR (MESSMAN)'),
('6250', 'PHILIPPINE COP (II-5 / III-5)'),
('2470', 'JAPANESE COOK TRAINING CERTIFICATE'),
('CTCSC', 'CHINESE TRAINING CERTIFICATE FOR SHIPS COOK'),
('MIS', 'MARSHALL ISLAND SEAMAN BOOK'),
('MIL', 'MARSHALL ISLAND LICENSE'),
('MSB', 'MALAYSIAN (SID)'),
('ML', 'MALAYSIAN (COR)'),
('NC3', 'PHILIPPINE NC3 FOR (CHIEF COOK & 2ND COOK)'),
('6500', 'MEDICAL CERTIFICATE (POST MEDICAL)'),
('AIS', 'AUTOMATIC IDENTIFICATION SYSTEMS'),
('FTME', 'FAMILIARIZATION TRAINING IN MOORING EQUIPMENT (FTME)'),
('ERS', 'ENGINE ROOM SIMULATOR COURSE (ERS/ERM)'),
('SSBT', 'SHIP SIMULATOR & BRIGDE TEAMWORK w/ BRM'),
('FFLB', 'FREE FALL LIFEBOAT FAMILIARIZATION'),
('SPFHFC', 'SAFE PRACTICES IN HANDLING FUMIGATED CARGO'),
('SMSCRS', 'ISM/SMS V 3.0 (3 DAYS COURSE)'),
('PNMSDSD', 'PANAMA ENDORSEMENT - SDSD'),
('AMCV', 'AUSTRALIAN MARITIME CREW VISA'),
('USVISA', 'US VISA'),
('ECDIS_JRC_901', 'ECDIS JRC JAN-701/901/901M/701B/901B/2000'),
('FLSSOC', 'JAPANESE SSO -  CERT. OF QUALIFICATION'),
('ECDIS_KLHG', 'ECDIS KELVIN HUGNES - KLHG'),
('TTOS_CORONA', 'TTOS - CORONA'),
('6251', 'PHILIPPINE COP (II-4 / III-4)'),
('ECDIS_FURUNO_FEA', 'ECDIS FURUNO FEA - 2807/2107'),
('ECDIS_FURUNO_CBT', 'ECDIS FURUNO CBT- 3100/3200/3300'),
('201', 'BIODATA'),
('MID', 'MARSHALL ISLAND GMDSS'),
('SHST', 'SHIP HANDLING TRAINING FOR CAPTAIN'),
('KLINEEMS', 'TTOS - KLINE EMS (ENVIRONMENTAL MANAGEMENT SYSTEM)'),
('TTOS_SPC', 'TTOS SPECIAL OR TTOS MARITIME LEGAL MATTERS'),
('BASICNAV', 'TTOS - BASIC NAVIGATION'),
('TTOS_PCC', 'TTOS - PCC'),
('SSO', 'SHIP SECURITY OFFICER'),
('PNMSSO', 'PANAMA ENDORSEMENT - SSO'),
('TNKC_BASS', 'BASSNET'),
('BRM', 'BRM / BTM'),
('TTOS_NISHI', 'TTOS NISHI-F LRRS'),
('SRUC', 'SENIOR RATING UPGRADING COURSE'),
('RDSC', 'REAL DANGER SENSING COURSE'),
('SEC', 'SKILL ENHANCEMENT COURSE'),
('SC', 'STEERING COURSE'),
('HGMC', 'HEALTH & GALLEY MANAGEMENT COURSE'),
('SCC_IC', 'SPECIAL CUISINE COURSE (INTERNATIONAL COOKING)'),
('TCD', 'TEAMWORK IN CULTURAL DIVERSITY'),
('EW', 'EQ IN THE WORKPLACE'),
('STRESS_MS', 'STRESS MANAGEMENT SEMINAR'),
('ME_COURSE', 'ME / ENGINE FAMILARIZATION COURSE'),
('MCA', 'MALAYSIAN CREW CONTRACT AGREEMENT (SEC)'),
('MAL_PEME', 'MALAYSIAN MEDICAL CERTIFICATE (PEME)'),
('PNMCC', 'PANAMA ENDORSEMENT - SHIPS COOK COURSE'),
('MS', 'MALAYSIAN SEAMANBOOK'),
('MP', 'MALAYSIAN PASSPORT'),
('LCRA', 'LIBERIAN CRA'),
('LSB', 'LIBERIAN SEAMAN BOOK'),
('LPP', 'LIBERIAN PASSPORT'),
('PNMMED', 'PANAMA MEDICAL CERTIFICATE'),
('SMSREFC', 'ISPS CODE'),
('SPASDIG', 'SPAS -  DIGITRACE'),
('CRANEOP', 'CRANE OPERATOR'),
('NICKELORE', 'NICKLE ORE CARGO FAMILIARIZATION'),
('TTOS-CPIT', 'TTOS - COMPETENCY PROMOTIONAL INHOUSE TRAINING'),
('TTOS-ENAV', 'TTOS - E-NAVIGATOR'),
('AFFDRUGANDALCO', 'AFFIDAVIT OF DRUG AND ALCOHOL POLICY'),
('ENMS', 'ENERGY MANAGEMENT SYSTEM ONLINE COURSE'),
('LNG', 'HANDLING DANGEROUS AND OTHER SUBSTANCES'),
('MLC', 'MLC 2006'),
('PT', 'PAINTING TECHNIQUE'),
('RS', 'ROPE SLICING'),
('SAF', 'SAFIR'),
('GDC', 'GAS DETECTOR CALIBRATION'),
('PSB', 'PCC SPECIAL BRIEFING'),
('CCD', 'CREW CONSENT DOCUMENT'),
('SOCCERT', 'SAFETY OFFICER COURSE CERTIFICATE'),
('VACTYHEP', 'VACCINATION: TYPHOID FEVER AND HEPA A & B'),
('STCW', 'CHINESE STCW COE'),
('CCOC', 'CHINESE COC'),
('CBT_CYBERSEC', 'CYBER SECURITY CERTIFICATE'),
('VAC_CHICPOX', 'VARICELLA (CHICKEN POX) VACCINE'),
('PERSAFE', 'PERSONAL SAFETY'),
('RFPWMER', 'RATING FORMING PART OF A WATCH IN MANNED ENGINE ROOM'),
('EWCA', 'ELECTRIC WELDING COURSE'),
('MOS', 'MOSHI'),
('TS', 'TRIM AND STABILITY'),
('PHS', 'PEOPLE HANDLING SKILLS'),
('BWMS', 'BALLAST WATER MANAGEMENT COURSE'),
('MEMSS', 'MAIN ENGINE MANUEVERING SYSTEM SIMULATOR (NABCO)'),
('BCCC', 'BOILER COMBUSTION CONTROL COURSE'),
('FNL', 'FUEL AND LUBRICANTS'),
('MAM', 'MARINE AND AUXILLARY MACHINERIES'),
('MARELTEC', 'MARINE ELECTRO-TECHNOLOGY'),
('IMC', 'INDUSTRIAL MOTOR CONTROL'),
('OAWC', 'OXYGEN_ACETYLENE WELDING COURSE'),
('LMOC', 'LATHE MACHINE OPERATOR COURSE'),
('MDSLE_OTR1', 'MAIN DIESEL ENGINE OVERHAUL TRAINING 1'),
('MDSLE_OTR2', 'MAIN DIESEL ENGINE OVERHAUL TRAINING 2'),
('MDSLE_OTR3', 'MAIN DIESEL ENGINE OVERHAUL TRAINING 3'),
('MR', 'MARINE REFRIGERATION'),
('MHV', 'MARINE HIGH VOLTAGE'),
('AWC', 'ADVANCE WELDING COURSE'),
('SRUCO1', 'SENIOR RATING UPGRDATING COURSE - OILER #1 (SRUC-E)'),
('BASIC-IGF', 'COP FOR BASIC IGF (GAS FUEL VESSEL)'),
('IMSBC', 'IMSBC CODE TRAINING'),
('NAVWATCHS_L1', 'NAVIGATIONAL WATCH SIMULATOR LEVEL 1'),
('WOODCHIP_FAM', 'WOODCHIP CARRIER FAMILIARIZATION COURSE'),
('TTOS_ELEVATOR', 'TTOS - MARINE ELEVATOR SAFETY TRAINING'),
('DGENG', 'DIESEL GENERATOR ENGINE OVERHAULING TRAINING'),
('PUROV', 'PURIFIER OVERHAULING MAINTENANCE COURSE'),
('TDTST', 'TRADE TEST'),
('COVID19', 'GUIDANCE ON PREVENTION AND CONTROL OF COVID-19 ONBOARD'),
('BRF', 'PRE DEPARTURE BRIEFING FORM'),
('NHIC', 'NEW HIRE ASSESSMENT / CHECKLIST'),
('PRMTN', 'PROMOTION ASSESSMENT / CHECKLIST'),
('IRLPL', 'incident report & loss prevention lesson'),
('bcb', 'bulk carrier briefing'),
('pccu', 'pcc undertaking'),
('ecdis-kta', 'ecdis knowledge and training assurance'),
('cms', 'deck machinery course'),
('IGFBT', 'COP IGF BASIC'),
('eec', 'electric and electronic course'),
('JCOPIGFAD', 'JAPAN COP IGF (ADVANCE)'),
('JCOPIGFBA', 'JAPAN COP IGF (BASIC)'),
('OU', 'oath of undertaking'),
('IMO2020', 'Bunkering Procedures and MARPOL VI/IMO 2020'),
('cdb', 'cayman discharge booklet'),
('cl', 'cayman license'),
('cgoc', 'cayman goc'),
('csc', 'cayman ship\'s cook'),
('VACHEP', 'VACCINATION: HEPA A & B'),
('CDPPCC', 'CARGO DAMAGE PREVENTION FOR PCC'),
('BCG', 'BULK CARRIER GUIDELINES'),
('LT', 'LOCKOUT TAGOUT'),
('SMHW', 'SEAFARER\'S MENTAL HEALTH AND WELLBEING'),
('JOTC', 'JUNIOR OFFICER TRAINING COURSE'),
('UTC', 'UPGRADING TRAINING COURSE'),
('TSBCTSBGC', 'TRIM & STABILITY FOR BULK CARRIER TRANSPORTING SOLID BULK AND GRAIN CARGOES'),
('MOSHID', 'MOSHI - DECK OFFICERS'),
('IGFADV', 'COP IGF ADVANCE'),
('NSB', 'PHILIPPINE SEAMAN BOOK'),
('PP', 'PHILIPPINE PASSPORT'),
('YFEV', 'VACCINATION (YELLOW FEVER)');

-- --------------------------------------------------------

--
-- Table structure for table `ranks`
--

CREATE TABLE `ranks` (
  `code` varchar(765) DEFAULT NULL,
  `name` varchar(765) DEFAULT NULL,
  `short_name` varchar(765) DEFAULT NULL,
  `alias` varchar(765) DEFAULT NULL,
  `ranking` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ranks`
--

INSERT INTO `ranks` (`code`, `name`, `short_name`, `alias`, `ranking`) VALUES
('e31', 'no.1 oiler', 'no.1 oiler', '#1olr', 14),
('d32', 'able bodied seaman', 'able seaman ', 'a/b', 15),
('e32', 'oiler', 'oiler', 'olr', 16),
('d33', 'ordinary seaman', 'ordinary seaman', 'o/s', 17),
('e33', 'wiper', 'wiper', 'wpr', 18),
('d34', 'deck boy', 'deck boy', 'd/boy', 19),
('e34', 'engine boy', 'engine boy', 'e/boy', 20),
('d41', 'deck cadet', 'deck cadet', 'd/c', 21),
('e35', 'wiper/welder', 'wiper/welder', 'wpr/wdr', 22),
('d49', 'deck cadet - b', 'deck cadet - b', 'd/c-b', 23),
('e41', 'engine cadet ', 'engine cadet', 'e/c', 24),
('e42', 'welder', 'welder', 'welder', 25),
('e43', 'wiper maintenance', 'wiper maint', 'wpr/m', 26),
('e44', 'engine trainee', 'engine trainee', 'e/trnee', 27),
('e45', 'welder maintenance', 'wdr maintenance', 'wdr/mc', 28),
('e47', 'fitter/welder', 'fitter/welder', 'f/wldr', 29),
('e48', 'engine rating', 'engine rating', 'erating', 30),
('e55', 'engine cadet me+', 'engine cadet me+', 'e/c-me+', 31),
('s31', 'chief cook', 'chief cook', 'c/cook', 32),
('s32', 'second cook', 'second cook', '2/cook', 33),
('s33', 'messman', 'messman', 'm/man', 34),
('e49', 'engine cadet - b', 'engine cadet - b', 'e/c-b', 56),
('d43', 'o/s maintenance ', 'ordinary seaman maintenance', 'os/m', 87),
('d48', 'deck rating', 'deck rating', 'drating', 109),
('sui', 'chief engineer / superintendent', 'chief engr./ superintendent', 'si', 110),
('da1', 'auxiliary master', 'auxiliary master', 'auxmas', 120),
('s37', 'utility bar', 'utility bar', 'utybar', 121),
('ab', 'ab', 'ab', 'ab', NULL),
('os', 'os', 'os', 'os', NULL),
('dcdt', 'dcdt', 'dcdt', 'dcdt', NULL),
('mast', 'mast', 'mast', 'mast', NULL),
('coff', 'coff', 'coff', 'coff', NULL),
('2off', '2off', '2off', '2off', NULL),
('3off', '3off', '3off', '3off', NULL),
('elct', 'elct', 'elct', 'elct', NULL),
('1eng', '1eng', '1eng', '1eng', NULL),
('msm', 'msm', 'msm', 'msm', NULL),
('ceng', 'ceng', 'ceng', 'ceng', NULL),
('2eng', '2eng', '2eng', '2eng', NULL),
('3eng', '3eng', '3eng', '3eng', NULL),
('olr', 'olr', 'olr', 'olr', NULL),
('wpr', 'wpr', 'wpr', 'wpr', NULL),
('ecdt', 'ecdt', 'ecdt', 'ecdt', NULL),
('1olr', '1olr', '1olr', '1olr', NULL),
('rpfw', 'rpfw', 'rpfw', 'rpfw', NULL),
('eoff', 'eoff', 'eoff', 'eoff', NULL),
('bosn', 'bosn', 'bosn', 'bosn', NULL),
('ccok', 'ccok', 'ccok', 'ccok', NULL),
('2cok', '2cok', '2cok', '2cok', NULL),
('j2eg', 'j2eg', 'j2eg', 'j2eg', NULL),
('dboy', 'dboy', 'dboy', 'dboy', NULL),
('mos', 'mos', 'mos', 'mos', NULL),
('j2of', 'j2of', 'j2of', 'j2of', NULL),
('bmas', 'bmas', 'bmas', 'bmas', NULL),
('rpmn', 'rpmn', 'rpmn', 'rpmn', NULL),
('roff', 'roff', 'roff', 'roff', NULL),
('4eng', '4eng', '4eng', '4eng', NULL),
('j3eg', 'j3eg', 'j3eg', 'j3eg', NULL),
('gpe', 'gpe', 'gpe', 'gpe', NULL),
('gpd', 'gpd', 'gpd', 'gpd', NULL),
('eboy', 'eboy', 'eboy', 'eboy', NULL),
('jcof', 'jcof', 'jcof', 'jcof', NULL),
('jceg', 'jceg', 'jceg', 'jceg', NULL),
('t1of', 't1of', 't1of', 't1of', NULL),
('tj1e', 'tj1e', 'tj1e', 'tj1e', NULL),
('tect', 'tect', 'tect', 'tect', NULL),
('tdct', 'tdct', 'tdct', 'tdct', NULL),
('tros', 'tros', 'tros', 'tros', NULL),
('s2of', 's2of', 's2of', 's2of', NULL),
('twpr', 'twpr', 'twpr', 'twpr', NULL),
('j1eg', 'j1eg', 'j1eg', 'j1eg', NULL),
('mach', 'mach', 'mach', 'mach', NULL),
('a3of', 'a3of', 'a3of', 'a3of', NULL),
('rptm', 'rptm', 'rptm', 'rptm', NULL),
('aeng', 'aeng', 'aeng', 'aeng', NULL),
('aoff', 'aoff', 'aoff', 'aoff', NULL),
('supi', 'supi', 'supi', 'supi', NULL),
('golr', 'golr', 'golr', 'golr', NULL),
('teng', 'teng', 'teng', 'teng', NULL),
('sclk', 'sclk', 'sclk', 'sclk', NULL),
('jmas', 'jmas', 'jmas', 'jmas', NULL),
('j3of', 'j3of', 'j3of', 'j3of', NULL),
('genr', 'genr', 'genr', 'genr', NULL),
('t2eg', 't2eg', 't2eg', 't2eg', NULL),
('pump', 'pump', 'pump', 'pump', NULL),
('mtec', 'mtec', 'mtec', 'mtec', NULL),
('j4eg', 'j4eg', 'j4eg', 'j4eg', NULL),
('mbsn', 'mbsn', 'mbsn', 'mbsn', NULL),
('cgoe', 'cgoe', 'cgoe', 'cgoe', NULL),
('1off', '1off', '1off', '1off', NULL),
('mwpr', 'mwpr', 'mwpr', 'mwpr', NULL),
('2eof', '2eof', '2eof', '2eof', NULL),
('t3of', 't3of', 't3of', 't3of', NULL),
('tdby', 'tdby', 'tdby', 'tdby', NULL),
('cboy', 'cboy', 'cboy', 'cboy', NULL),
('t3eg', 't3eg', 't3eg', 't3eg', NULL),
('stwd', 'stwd', 'stwd', 'stwd', NULL),
('tmsn', 'tmsn', 'tmsn', 'tmsn', NULL),
('a2of', 'a2of', 'a2of', 'a2of', NULL),
('teby', 'teby', 'teby', 'teby', NULL),
('elcd', 'elcd', 'elcd', 'elcd', NULL),
('jolr', 'jolr', 'jolr', 'jolr', NULL),
('abcl', 'abcl', 'abcl', 'abcl', NULL),
('rank', 'rank', 'rank', 'rank', NULL),
('4off', '4off', '4off', '4off', NULL),
('d12', 'trainee master', 'trainee master', 'tmaster', NULL),
('d03', 'supernumerary-master', 'supernumerary-master', 'sup-master', NULL),
('dctos', 'DECK CADET TRAINEE OS (NON-SCHOLAR)', 'DECK CADET TRAINEE OS (NON-SCHOLAR)', 'DECK CADET TRAINEE OS (NON-SCHOLAR)', NULL),
('ECTWPR', 'ENGINE CADET TRAINEE WPR (NON-SCHOLAR)', 'ENGINE CADET TRAINEE WPR (NON-SCHOLAR)', 'ENGINE CADET TRAINEE WPR (NON-SCHOLAR)', NULL),
('trnee', 'TRAINEE', 'TRAINEE', 'TRAINEE', NULL),
('e22', 'second assistant engineer', 'second asst engineer', '2a/e', 6),
('d11', 'master mariner', 'master mariner', 'master', 1),
('e11', 'chief engineer', 'chief engineer', 'c/engr', 2),
('d21', 'chief mate', 'chief mate', 'c/mate', 3),
('e21', 'first assistant engineer', 'first asst engineer', '1a/e', 4),
('d22', 'second mate', 'second mate', '2/mate', 5),
('d23', 'third mate', 'third mate', '3/mate', 7),
('e23', 'third assistant engineer', 'third asst engineer', '3a/e', 8),
('d24', 'third mate trainee', 'third mate tr.', '3/m tr.', 9),
('e24', 'third assistant engineer trainee', 'third asst engineeer tr.', '3a/e tr', 10),
('d27', 'environmental observer officer', 'environmental obsrvr offcr', 'eooffcr', 11),
('e25', 'electrician', 'electrician', 'elect', 12),
('d31', 'bosun', 'bosun', 'bosun', 13),
('test', 'wertwer', 'qweqweqwe', 'wk', 99);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `firstname` varchar(200) DEFAULT NULL,
  `lastname` varchar(200) DEFAULT NULL,
  `middlename` varchar(200) DEFAULT NULL,
  `usertype` varchar(120) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `middlename`, `usertype`, `created_at`, `updated_at`) VALUES
(1, 'admin', '1234', 'Admin', 'User', 'A', 'System Admin', '2023-01-11 10:17:36', '2023-01-11 15:02:51'),
(10, 'sample', '555', 'sample', 'qweqweqw', 'eqweqwe', 'Guest', '2024-01-10 16:52:24', '2024-01-10 16:53:27');

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `id` int(11) NOT NULL,
  `usertype` varchar(100) DEFAULT NULL,
  `restriction` varchar(550) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`id`, `usertype`, `restriction`, `created_at`, `updated_at`) VALUES
(1, 'System Admin', '[\"view\",\"crew\",\"user\",\"document\",\"usertype\",\"rank\"]', '2023-01-11 08:50:12', '2023-01-11 15:12:11'),
(5, 'Guest', '[\"view\"]', '2023-01-11 10:46:26', '2023-01-11 11:20:51'),
(6, 'Staff', '[\"view\",\"crew\"]', '2023-01-11 10:46:39', '2023-01-11 11:20:47'),
(8, 'wkwkwk', '[\"view\",\"crew\",\"user\",\"document\",\"usertype\",\"rank\"]', '2024-01-10 08:18:17', '2024-01-10 08:18:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crewdocs`
--
ALTER TABLE `crewdocs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crews`
--
ALTER TABLE `crews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crewdocs`
--
ALTER TABLE `crewdocs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `crews`
--
ALTER TABLE `crews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
