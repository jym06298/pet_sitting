DROP TRIGGER IF EXISTS update_cost;
DROP TRIGGER IF EXISTS update_orders_employee_delete;

DELIMITER //

CREATE TRIGGER update_cost
BEFORE UPDATE 
ON orders FOR EACH ROW
BEGIN
    
    SET NEW.cost = get_cost(NEW.begin_time, NEW.end_time, NEW.employeeID);
END //

CREATE TRIGGER update_orders_employee_delete
AFTER DELETE
ON employee FOR EACH ROW
BEGIN
    UPDATE orders SET employeeID = NULL, cost = NULL WHERE employeeID = OLD.employeeID;
END //
DELIMITER ;
