CREATE TRIGGER `total_income` AFTER INSERT ON `orders`
 FOR EACH ROW UPDATE employee,orders 
SET employee.income = employee.income + orders.cost
WHERE 
employee.employeeID = orders.employeeID

CREATE TRIGGER `track_orders` AFTER INSERT ON `orders`
 FOR EACH ROW UPDATE employee,orders SET employee.Num_Orders = employee.Num_Orders + 1 WHERE employee.employeeID = orders.employeeID

CREATE TRIGGER `track_spend` AFTER INSERT ON `orders`
 FOR EACH ROW UPDATE  customers,orders SET customers.total_spend = customers.total_spend + cost 
WHERE customers.customerID = orders.customerID
