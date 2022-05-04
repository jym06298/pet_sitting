DROP TRIGGER IF EXISTS update_cost;
DELIMITER //

CREATE TRIGGER update_cost
BEFORE UPDATE 
ON orders FOR EACH ROW
BEGIN
    SET NEW.cost = TIMESTAMPDIFF(hour, NEW.begin_time, NEW.end_time) * (SELECT charging_rate FROM employee WHERE employeeID = NEW.employeeID);
END //

DELIMITER ;
