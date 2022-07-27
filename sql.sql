create table products(
    
);
create table Login(
    userpassword varchar(10) ,
    username varchar(10) ,
    primary key(username)
);


create table Orders(
    orderId integer AUTO_INCREMENT,
    salesman varchar(10), 
    Orderdate date,
    primary key(orderId)
);
ALTER TABLE Orders
ADD FOREIGN KEY (salesman) REFERENCES login(username);


create table Bills(
    orderId integer,
    productName varchar(20),
    price int,
    quantity int
);

ALTER TABLE Bills
ADD FOREIGN KEY (orderId) REFERENCES Orders(orderId);
ALTER TABLE Bills
ADD FOREIGN KEY (productName) REFERENCES products(productName);
ALTER TABLE Bills
ADD CONSTRAINT PK_Person PRIMARY KEY (orderId,productName);

create table cart(productName varchar(20),
                barCode integer,
                price integer,
                quantity integer,
);

ALTER TABLE cart
ADD FOREIGN KEY (productName) REFERENCES products(productName);
ALTER TABLE cart
ADD FOREIGN KEY (barCode) REFERENCES products(barCode);
ALTER TABLE cart
ADD CONSTRAINT PK_Person PRIMARY KEY (productName,barCode);