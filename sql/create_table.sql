CREATE TABLE employee (
    employeeID int(4) NOT NULL AUTO_INCREMENT,
    employee_name varchar(24),
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

-- CREATE TABLE availability (
--    availabilityID int(4) NOT NULL,
--    start_time datetime,
--    end_time datetime
--);

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


