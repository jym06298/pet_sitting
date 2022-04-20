from optparse import Values
import pymysql
import random

# insert_query(table_name, **kwargs)
# DESCRIPTION- creates a valid insert query for mysql
# PARAMS-   
#           table_name: name of table to insert in
#           **kwargs - key = columns name, value = insert value
# RETURNS-
#           a string representation of the sql query
def insert_query(table_name, **kwargs):
    insert_query = "INSERT INTO {} (".format(table_name)
    i = 0
    for key, value in kwargs.items():
        insert_query = insert_query + key


        if i < len(kwargs) - 1:
            insert_query = insert_query + ","

        i += 1

    insert_query += ')'
    insert_query += " VALUES ("

    i = 0
    
    for key, value in kwargs.items():
        if isinstance(value, str):
           insert_query += "\'" + str(value) + "\'"
        else:
            insert_query += str(value)
       
        if i < len(kwargs) - 1:
            insert_query = insert_query + ','
        i += 1
    insert_query += ');'
    
    return insert_query


    
def generate_full_name(first_names, last_names):
    return first_names[random.randrange(len(first_names))] + ' ' + last_names[random.randrange(len(last_names))]


user_name = 'root'
passw = ""
db_name = "pet_sitting"
db = pymysql.connect(host = 'localhost', user = user_name, password = passw, db = db_name)
cursor = db.cursor()

first_names = []
last_names = []
pet_names =  []
animals = []
num_employees = 30

with open('names/first_name.txt', 'r') as f:
    for line in f.readlines():
        first_names.append(line.strip())

with open('names/surname.txt', 'r') as f:
    for line in f.readlines():
        last_names.append(line.strip())

with open('names/pet_name.txt', 'r') as f:
    for line in f.readlines():
        pet_names.append(line.strip())
    
with open('names/animals.txt', 'r') as f:
    for line in f.readlines():
        animals.append(line.strip())


#insert into animals 
for animal in animals:
     cursor.execute(insert_query('animals', animal_name = str(animal)))
     db.commit()


#employeeID	employee_name	rating	charging_rate	phone	email	description	zipcode	
#inserting into employee
for i in range(num_employees):
    full_name = generate_full_name(first_names, last_names)
    rating = random.randrange(10)
    charging_rate = float(random.randrange(8.0, 30.0))
    phone = "{}{}{}".format(random.randrange(100,999), random.randrange(100,999), random.randrange(100,900))
    email = "{}{}@gmail.com".format(full_name.replace(' ', ''), random.randrange(100))
    description = ""
    zip = random.randrange(30002,30098)
    cursor.execute( insert_query('employee', employee_name = full_name, rating = rating, charging_rate= charging_rate, phone = phone, email = email, description = description, zipcode = zip) )
    db.commit()

#inserting into employee_willing_animals
for i in range(num_employees):
    for j in range(random.randrange(1,6)):
        cursor.execute(insert_query('employee_willing_animals', employeeID = i + 1,animalID = random.randrange(1, len(animals) + 1)))
        db.commit()


    


