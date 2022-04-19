CREATE TABLE employee (
    employeeID varchar(4) PRIMARY KEY NOT NULL,
    employee_name varchar(24),
    eating float(5,2),
    eharging_rate float(8,2),
    phone varchar(15),
    email varchar(28),
    availabilityID varchar(4),
    description TEXT(1000),
    zipcode char(5)
    
);

CREATE TABLE employee_availability (
    availabilityID varchar(4) NOT NULL PRIMARY KEY,
    employeeID varchar(4),
    FOREIGN KEY (employeeID) REFERENCES employee(employeeID)
);

CREATE TABLE availability (
    availabilityID varchar(4) NOT NULL,
    start_time datetime,
    end_time datetime
);

CREATE TABLE animals (
    animalID varchar(4) PRIMARY KEY NOT NULL,
    animal_name varchar(28),
    
);

CREATE TABLE employee_willing_animals (
    employeeID varchar(4) NOT NULL,
    animalID varchar(4) NOT NULL,
    FOREIGN KEY (employeeID) REFERENCES employee(employeeID)
    FOREIGN KEY (animalID) REFERENCES animals(animalID)
);


