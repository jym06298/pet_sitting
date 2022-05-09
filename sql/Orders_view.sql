CREATE VIEW orders_view 
AS SELECT orderID, customerID, employeeID, begin_time, end_time, cost, petID, description, completed 
FROM orders;
