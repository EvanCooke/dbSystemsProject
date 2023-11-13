#we need to import python's built-in sqlite3 module to interact with the
#SQLite database.  We are also going to use the csv module to read data
#from a CSV file
import csv
import sqlite3
import random
from datetime import datetime
import pandas as pd
import string

#we need to create fake data for our csv file using the Faker module
from faker import Faker
from faker.providers import BaseProvider

#create our Faker object
fakeData = Faker()

# Generate a random string of length 9
def generate_license_number():
    characters = string.ascii_letters + string.digits  # includes letters and numbers
    randomString = ''.join(random.choice(characters) for _ in range(9))
    return randomString

#we need a phone number.  explore how to get phone numbers in faker...and the process for formatting them uniformly
def generate_phone():
    area = random.randint(100, 999)
    prefix = random.randint(100, 999)
    suffix = random.randint(1000, 9999)
    #print(str(area) + '-' + str(prefix) + '-' + str(suffix))
    return str(area) + str(prefix) + str(suffix)

roleList = ['Manager', 'Sales Agent', 'Customer Service', 'Accountant', 'Security', 'Janitor']
currentCarsRented = ['none', 'none', 'none', 'none', 'none']
customerEmails = []
employeeIDList = []
carVINs = []

# Creating custom lists of vehicle makes and models
custom_vehicle_makes = ['Toyota', 'Ford', 'Chevrolet', 'Honda', 'BMW']
custom_vehicle_models = {
    'Toyota': ['Corolla', 'Camry', 'Rav4'],
    'Ford': ['F-150', 'Escape', 'Focus'],
    'Chevrolet': ['Silverado', 'Equinox', 'Malibu'],
    'Honda': ['Civic', 'Accord', 'CR-V'],
    'BMW': ['3 Series', '5 Series', 'X3']
}


for i in range(0, 30):
        vin = random.randint(10000000000000000, 99999999999999999)
        #vin = fakeData.vehicle.vin()
        carVINs.append(vin)
        if random.randint(0,1) == 0:
            currentCarsRented.append(vin)

# generate fake data for Employees table to employee_data.csv
with open('employee_data.csv', 'w', newline = '') as csvfile:
    writer = csv.writer(csvfile)
    writer.writerow(['ID', 'Name', 'dateOfBirth', 'Role', 'Salary', 'Email', 'PhoneNumber', 'StoreID'])
    for i in range(0, 10):
        employeeID = random.randint(100000, 999999)
        employeeIDList.append(employeeID)
        first = fakeData.first_name() 
        last = fakeData.last_name()
        name = first + ' ' + last
        dateOfBirth = str(fakeData.date_of_birth(minimum_age=18, maximum_age=65))
        role = random.choice(roleList)
        salary = (random.randint(1,10) * 10000) + (random.randint(1,10) * 1000) + (random.randint(1,10) * 100)
        email = first + last + '@' + fakeData.free_email_domain()
        storeID = random.randint(1,4)

        myEmployee = [employeeID, name, dateOfBirth, role, salary, email, str(generate_phone()), storeID]
        writer.writerow(myEmployee)

# generate fake data for Customers table to customer_data.csv
with open('customer_data.csv', 'w', newline = '') as csvfile:
    writer = csv.writer(csvfile)
    writer.writerow(['Email', 'CurrentCarRented', 'LicenseNumber', 'Name', 'PhoneNumber', 'DateOfBirth', 'Address', 'State', 'Weight', 'Height', 'Sex', 'EyeColor'])
    for i in range(0, 20):
        first = fakeData.first_name() 
        last = fakeData.last_name()
        name = first + ' ' + last
        email = first + last + '@' + fakeData.free_email_domain()
        customerEmails.append(email)
        dateOfBirth = fakeData.date_of_birth(minimum_age=18, maximum_age=65)
        currentCarRented = random.choice(currentCarsRented)
        licenseNumber = str(generate_license_number())
        phoneNumber = str(generate_phone())
        address = fakeData.address()
        state = address[-8:-6]
        weight = random.randint(100, 250)
        height = random.randint(60, 78)
        sex = random.choice(['m', 'f'])
        eyeColor = random.choice(['blue', 'green', 'brown', 'hazel'])

        myCustomer = [email, currentCarRented, licenseNumber, name, phoneNumber, dateOfBirth, address, state, weight, height, sex, eyeColor]
        writer.writerow(myCustomer)


# generate fake data for Cars table to cars_data.csv
with open('cars_data.csv', 'w', newline = '') as csvfile:
    writer = csv.writer(csvfile)
    writer.writerow(['VIN', 'CurrentStatus', 'Make', 'Model', 'Mileage', 'Year', 'Color', 'StoreID', 'MostRecentRenterEmail', 'LicensePlate', 'State'])
    for i in carVINs:
        vin = i
        if vin in currentCarsRented:
            currentStatus = 'Rented'
        else:
            currentStatus = random.choice(['Rented', 'Not Rented', 'In Repair'])
            if currentStatus == 'Rented':
                currentCarsRented.append(vin)
        make = fakeData.random_element(custom_vehicle_makes)
        model = fakeData.random_element(custom_vehicle_models[make])
        mileage = random.randint(1000, 200000)
        year = random.randint(2000, 2023)
        color = fakeData.color()
        storeID = random.randint(1,4)
        mostRecentRenterEmail = random.choice(customerEmails)
        licensePlate = fakeData.license_plate()
        state = fakeData.state_abbr()

        myCar = [vin, currentStatus, make, model, mileage, year, color, storeID, mostRecentRenterEmail, licensePlate, state]
        writer.writerow(myCar)



# generate fake data for Sales table to sales_data.csv
with open('sales_data.csv', 'w', newline = '') as csvfile:
    writer = csv.writer(csvfile)
    writer.writerow(['SaleID', 'Date', 'Money', 'EmployeeID', 'CustomerEmail', 'CarVIN', 'PaymentMethod'])
    for i in range(0, 15):
        saleID = i + 1
        
        # Generate a recent date within the last year
        recent_date = fakeData.date_time_between(start_date="-365d", end_date="now")

        # Convert the Faker-generated timestamp to a date
        date = recent_date.date()


        money = (random.randint(1,10) * 1000) + (random.randint(1,10) * 100) + (random.randint(1,10) * 10) + random.randint(1,10)
        employeeID = random.choice(employeeIDList)
        customerEmail = random.choice(customerEmails)
        carVIN = random.choice(carVINs)
        paymentMethod = random.choice(['Credit Card', 'Debit Card', 'Cash'])
        
        mySale = [saleID, date, money, employeeID, customerEmail, carVIN, paymentMethod]
        writer.writerow(mySale)

# generate fake data for Store table to store_data.csv
with open('store_data.csv', 'w', newline = '') as csvfile:
    writer = csv.writer(csvfile)
    writer.writerow(['StoreID', 'Location', 'Address', 'State'])
    for i in range(0, 4):
        storeID = i + 1
        latitude = fakeData.latitude()
        longitude = fakeData.longitude()
        location = f"POINT({latitude} {longitude})"
        address = fakeData.address()
        state = address[-8:-6]
            
        mySale = [storeID, location, address, state]
        writer.writerow(mySale)

