DROP TABLE IF EXISTS employee_willing_animals;
DROP TABLE IF EXISTS employee_availability;
DROP TABLE IF EXISTS pet_accounts;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS customers;
DROP TABLE IF EXISTS animals;
DROP TABLE IF EXISTS employee;
CREATE TABLE employee (
    employeeID int(4) NOT NULL AUTO_INCREMENT,
    employee_name varchar(28),
    rating float(5,2),
    charging_rate float(8,2),
    phone varchar(15),
    email varchar(100),
--    availabilityID int(4),
    description TEXT(1000),
    zipcode char(5),
    password varchar(28) NOT NULL,
    PRIMARY KEY(employeeID)
);

CREATE TABLE animals (
    animalID int(4) NOT NULL AUTO_INCREMENT,
    animal_name varchar(28),
    PRIMARY KEY (animalID)
);

CREATE TABLE employee_willing_animals (
    employeeID int(4) NOT NULL,
    animalID int(4) NOT NULL,
    FOREIGN KEY (employeeID) REFERENCES employee(employeeID) ON DELETE CASCADE,
    FOREIGN KEY (animalID) REFERENCES animals(animalID)
);

CREATE TABLE customers (
    customerID int(4) NOT NULL AUTO_INCREMENT,
    customer_name varchar(28),
    phone varchar(15),
    email varchar(100),
    zipcode char(5),
    password varchar(255),
    PRIMARY KEY (customerID)
);
CREATE TABLE pet_accounts (
    petID int(4) NOT NULL AUTO_INCREMENT,
    pet_name varchar(28),
    customerID int(4) NOT NULL,
    animalID int(4) NOT NULL,
    FOREIGN KEY (animalID) REFERENCES animals(animalID),
    FOREIGN KEY (customerID) REFERENCES customers(customerID) ON DELETE CASCADE,
    PRIMARY KEY (petID)
);
CREATE TABLE orders (
    orderID int(4) NOT NULL AUTO_INCREMENT,
    customerID int(4) NOT NULL,
    employeeID int(4),
    begin_time datetime NOT NULL,
    end_time datetime NOT NULL,
    cost float(8,2),
    petID int(4) NOT NULL,
    description varchar(1000),
    completed BOOL,
    PRIMARY KEY (orderID),
    FOREIGN KEY(customerID) REFERENCES customers(customerID) ON DELETE CASCADE
); 


