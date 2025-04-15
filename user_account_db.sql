
--
-- Database: `user_account_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts`
(
  `id` int
(255) NOT NULL,
  `username` varchar
(50) NOT NULL,
  `email` varchar
(255) NOT NULL,
  `password` varchar
(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`
id`,
`username
`, `email`, `password`) VALUES
(1, 'klydejay', 'klydejay@gmail.com', '123456789'),
(2, 'Testuser', 'testuser@gmail.com', '123456789');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
ADD PRIMARY KEY
(`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int
(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

