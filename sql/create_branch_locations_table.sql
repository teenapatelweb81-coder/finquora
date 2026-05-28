-- Create branch_locations table
CREATE TABLE IF NOT EXISTS `branch_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(255) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `country` varchar(100) DEFAULT 'India',
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `domain_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `domain_id` (`domain_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Add some sample data
INSERT INTO `branch_locations` (`branch_name`, `contact_person`, `email`, `mobile`, `address`, `city`, `state`, `pincode`, `country`, `latitude`, `longitude`, `status`, `domain_id`) VALUES
('Head Office', 'John Doe', 'headoffice@example.com', '9876543210', '123 Main Street, Business District', 'Mumbai', 'Maharashtra', '400001', 'India', '19.0760', '72.8777', 1, 1),
('West Branch', 'Jane Smith', 'westbranch@example.com', '9876543211', '456 Western Avenue, Suburbia', 'Pune', 'Maharashtra', '411001', 'India', '18.5204', '73.8567', 1, 1),
('North Branch', 'Mike Johnson', 'northbranch@example.com', '9876543212', '789 Northern Road, Downtown', 'Delhi', 'Delhi', '110001', 'India', '28.6139', '77.2090', 1, 1);
