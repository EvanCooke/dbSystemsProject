-- Create the carRentalDatabase database if it doesn't exist
CREATE DATABASE IF NOT EXISTS carRentalDatabase;

-- Use the carRentalDatabase database
USE carRentalDatabase;

-- Employees Table
CREATE TABLE Employees (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(50),
    DateOfBirth DATE,
    Role VARCHAR(50),
    Salary DECIMAL(10, 2),
    Email VARCHAR(100),
    PhoneNumber VARCHAR(10),
    StoreID INT
);

-- Customers Table
CREATE TABLE Customers (
    Email VARCHAR(100) PRIMARY KEY,
    CurrentCarRented VARCHAR(17),
    LicenseNumber VARCHAR(20),
    Name VARCHAR(50),
    PhoneNumber VARCHAR(10),
    DateOfBirth DATE,
    Address VARCHAR(100),
    State VARCHAR(2),
    Weight DECIMAL(5, 2),
    Height DECIMAL(5, 2),
    Sex VARCHAR(10),
    EyeColor VARCHAR(20)
);

-- Sales Table
CREATE TABLE Sales (
    SaleID INT AUTO_INCREMENT PRIMARY KEY,
    Date DATE,
    Money DECIMAL(10, 2),
    EmployeeID INT,
    CustomerEmail VARCHAR(100),
    CarVIN VARCHAR(17),
    PaymentMethod VARCHAR(50),
    FOREIGN KEY (EmployeeID) REFERENCES Employees(ID),
    FOREIGN KEY (CustomerEmail) REFERENCES Customers(Email)
);

-- Store Table
CREATE TABLE Store (
    StoreID INT AUTO_INCREMENT PRIMARY KEY,
    Location POINT,
    Address VARCHAR(100),
    State VARCHAR(2)
);

-- Cars Table
CREATE TABLE Cars (
    VIN VARCHAR(17) PRIMARY KEY,
    CurrentStatus VARCHAR(50),
    Make VARCHAR(50),
    Model VARCHAR(50),
    Mileage INT,
    Year YEAR,
    Color VARCHAR(20),
    StoreID INT,
    MostRecentRenterEmail VARCHAR(100),
    LicensePlate VARCHAR(15),
    State VARCHAR(2),
    FOREIGN KEY (StoreID) REFERENCES Store(StoreID),
    FOREIGN KEY (MostRecentRenterEmail) REFERENCES Customers(Email)
);


