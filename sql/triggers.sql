DROP TRIGGER IF EXISTS update_cost;
DELIMITER //

CREATE TRIGGER update_cost
BEFORE UPDATE 
ON orders FOR EACH ROW
BEGIN
    
    SET NEW.cost = get_cost(NEW.begin_time, NEW.end_time, NEW.employeeID);
END //

DELIMITER ;
