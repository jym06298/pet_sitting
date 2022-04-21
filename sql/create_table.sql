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
    PRIMARY KEY(employeeID)
);

CREATE TABLE employee_availability (
    availabilityID int(4) NOT NULL AUTO_INCREMENT,
    employeeID int(4),
    start_time datetime,
    end_time datetime,
    FOREIGN KEY (employeeID) REFERENCES employee(employeeID),
    PRIMARY KEY (availabilityID)
);

CREATE TABLE animals (
    animalID int(4) NOT NULL AUTO_INCREMENT,
    animal_name varchar(28),
    PRIMARY KEY (animalID)
);

CREATE TABLE employee_willing_animals (
    employeeID int(4) NOT NULL,
    animalID int(4) NOT NULL,
    FOREIGN KEY (employeeID) REFERENCES employee(employeeID),
    FOREIGN KEY (animalID) REFERENCES animals(animalID)
);

CREATE TABLE customers (
    customerID int(4) NOT NULL AUTO_INCREMENT,
    customer_name varchar(28),
    phone varchar(15),
    email varchar(100),
    zipcode char(5),
    username varchar(28),
    password varchar(255)
)
CREATE TABLE pet_accounts (
    petID int(4) NOT NULL PRIMARY KEY,
    pet_name varchar(28),
    customerID int(4) NOT NULL,
    animalID int(4) NOT NULL,
    FOREIGN KEY (animalID) REFERENCES animals(animalID)
    FOREIGN KEY (customerID) REFERENCES customers(customerID)
)
CREATE TABLE orders (
    orderID int(4) NOT NULL PRIMARY KEY,
    customerID int(4) NOT NULL,
    employeeID int(4) NOT NULL,
    begin_time datetime NOT NULL,
    end_time datetime NOT NULL,
    cost float(8,2) NOT NULL,
    petID int(4) NOT NULL
)


