DELIMITER //
CREATE PROCEDURE get_employee_willing_animal_names(IN employeeID int(4))
BEGIN
    SELECT A.animal_name FROM employee_willing_animals EW INNER JOIN employee E ON E.employeeID = EW.employeeID INNER JOIN animals A ON A.animalID = EW.animalID WHERE E.employeeID = employeeID;
END //
DELIMITER ;