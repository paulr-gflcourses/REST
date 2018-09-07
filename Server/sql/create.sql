CREATE TABLE Cars (
    id INT AUTO_INCREMENT,
    mark VARCHAR(40),
    model VARCHAR(40),
    year YEAR(4),
    engine FLOAT,
    color VARCHAR(40),
    maxspeed INT,
    price FLOAT,
    PRIMARY KEY (id)
);

CREATE TABLE Orders (
    id INT AUTO_INCREMENT, 
    idcar INT,
    type_pay ENUM('credit card','cash'),
    cust_name VARCHAR(100),
    cust_surname VARCHAR(100),
    PRIMARY KEY (id),
    FOREIGN KEY (idcar) REFERENCES Cars(id)
);
