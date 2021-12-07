
--currently includes no account data like password
CREATE TABLE users (
  user_id INT AUTO_INCREMENT,
  firstname VARCHAR(20) NOT NULL,
  lastname VARCHAR(20) NOT NULL,
  email VARCHAR(40) NOT NULL,
  phone_number CHAR(10),
  date_of_birth DATE NOT NULL,
  password VARCHAR(20),
  role INT NOT NULL DEFAULT 0,
  PRIMARY KEY(user_id)
);

CREATE TABLE services (
  service_id INT,
  name VARCHAR(20) NOT NULL,
  price INT NOT NULL,
  PRIMARY KEY(service_id)
);

CREATE TABLE ordered_services(
  booking_id INT(20) AUTO_INCREMENT,
  user_id INT,
  service_id INT,
  service_date DATE NULL,
  booking_timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (booking_id),
  CONSTRAINT fk_has_user FOREIGN KEY (user_id)
  REFERENCES users(user_id),
  CONSTRAINT fk_has_service FOREIGN KEY (service_id)
  REFERENCES services(service_id)
);
