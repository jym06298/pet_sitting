DROP PROCEDURE IF EXISTS get_employee_willing_animal_names;
DROP PROCEDURE IF EXISTS get_pet_name;
DROP PROCEDURE IF EXISTS get_animal_name;
DROP FUNCTION IF EXISTS get_cost;
DELIMITER //
CREATE PROCEDURE get_employee_willing_animal_names(IN employeeID int(4))
BEGIN
    SELECT A.animal_name FROM employee_willing_animals EW INNER JOIN employee E ON E.employeeID = EW.employeeID INNER JOIN animals A ON A.animalID = EW.animalID WHERE E.employeeID = employeeID;
END //

CREATE PROCEDURE get_pet_name(IN petID int(4))
BEGIN
    SELECT * from pet_accounts WHERE pet_accounts.petID = petID;
END //

CREATE PROCEDURE get_animal_name(IN animalID int(4))
BEGIN
    SELECT animal_name from animals WHERE animals.animalID = animalID;
END //

CREATE FUNCTION get_cost(begin_time datetime, end_time datetime, employeeID int(4) )
RETURNS float(8,2)
BEGIN
    DECLARE cost float(8,2);

    SET cost = TIMESTAMPDIFF(hour, begin_time, end_time) * (SELECT charging_rate FROM employee WHERE employeeID = employeeID LIMIT 1);
    return (cost);

END //
DELIMITER ;