# 
#DROP TABLE `Users`;
#
# Tables Structure for : Users
#
 
CREATE TABLE `Users` (
`Id` INTEGER NOT NULL,
`Address` LONGTEXT,
`Email` NVARCHAR(255) UNIQUE,
`Enabled` BIT NOT NULL,
`Password` LONGTEXT,
`UserDefaultNumber` LONGTEXT,
`UserName` NVARCHAR(256),
`UserSecondNumber` LONGTEXT,
`UserThirdNumber` LONGTEXT
) CharSet=utf8 Engine=InnoDB;
 
#
# Dumping Rows for Table : Users
#
 
INSERT INTO `Users` ( `Id`, `Address`, `Email`, `Enabled`, `Password`, `UserDefaultNumber`, `UserName`, `UserSecondNumber`, `UserThirdNumber`) 
VALUES ('1','139 Carrington Rd, Mount Albert, Auckland 1025','wangji921@gmail.com',True,'P@ssw0rd','0800 541 4444','Jason Marz','09-815 4321',''),
('2','Molesworth St, Pipitea, Wellington 6011','admin@email.com',True,'P@ssw0rd','04-817 9999','John Kee','','');
 
#DROP TABLE `Category`;
#
# Tables Structure for : Category
#
 
CREATE TABLE `Category` (
`CategoryID` INTEGER NOT NULL,
`CategoryDescription` NVARCHAR(100) NOT NULL,
`CategoryName` NVARCHAR(50) NOT NULL
) CharSet=utf8 Engine=InnoDB;
 
#
# Dumping Rows for Table : Category
#
 
INSERT INTO `Category` ( `CategoryID`, `CategoryDescription`, `CategoryName`) VALUES (1,'Bags for men','Mens Bags'),
(2,'Bags for women','Womens Bags'),
(3,'Bags for children','Kids Bags'),
(4,'All at our special price','Clearance');
 
#DROP TABLE `Orders`;
#
# Tables Structure for : Orders
#
 
CREATE TABLE `Orders` (
`OrderId` INTEGER NOT NULL,
`City` LONGTEXT,
`Address` LONGTEXT,
`FirstName` NVARCHAR(50) NOT NULL,
`LastName` NVARCHAR(50) NOT NULL,
`OrderDate` NVARCHAR(27) NOT NULL,
`Phone` LONGTEXT NOT NULL,
`PostalCode` LONGTEXT,
`Status` BIT,
`Total` DECIMAL(18,2) NOT NULL,
`UserId` NVARCHAR(256)
) CharSet=utf8 Engine=InnoDB;
 
#
# Dumping Rows for Table : Orders
#
 
INSERT INTO `Orders` ( `OrderId`, `City`, `Address`, `FirstName`, `LastName`, `OrderDate`, `Phone`, `PostalCode`, `Status`, `Total`, `UserId`) VALUES (1,'Auckland','New Zealand','Tom','Jackson','2017-05-22 00:00:00','021 044 4544','1026',False,705.00,'admin@email.com');
 
#DROP TABLE `OrderDetail`;
#
# Tables Structure for : OrderDetail
#
 
CREATE TABLE `OrderDetail` (
`OrderDetailId` INTEGER NOT NULL,
`OrderId` INTEGER,
`ProductID` INTEGER,
`Quantity` INTEGER NOT NULL,
`UnitPrice` DECIMAL(18,2) NOT NULL
) CharSet=utf8 Engine=InnoDB;
 
#
# Dumping Rows for Table : OrderDetail
#
 
INSERT INTO `OrderDetail` ( `OrderDetailId`, `OrderId`, `ProductID`, `Quantity`, `UnitPrice`) VALUES (1,1,1,2,247.80),
(2,1,10,1,49.50),
(3,1,5,1,159.90);
 
#DROP TABLE `Product`;
#
# Tables Structure for : Product
#
 
CREATE TABLE `Product` (
`ProductID` INTEGER NOT NULL,
`CategoryID` INTEGER NOT NULL,
`PathOfFile` LONGTEXT,
`Price` DECIMAL(18,2) NOT NULL,
`ProductDescription` NVARCHAR(1000) NOT NULL,
`ProductName` NVARCHAR(100) NOT NULL,
`SupplierID` INTEGER NOT NULL
) CharSet=utf8 Engine=InnoDB;
 
#
# Dumping Rows for Table : Product
#
 
INSERT INTO `Product` ( `ProductID`, `CategoryID`, `PathOfFile`, `Price`, `ProductDescription`, `ProductName`, `SupplierID`) VALUES (1,1,'22052017-004520795492.jpg',247.80,'The ultimate statement clutch. Tilly is a fun and flirty accessory crafted from supple leather and finished with luxe ostrich feather detailing. ','Tilly Black Clutch',1),
(2,2,'22052017-004520795554.jpg',109.00,'Lee is a sophisticated partner in her black and dark grey combo. zip closure, detachable wrist strap and shoulder sling','Delores Black Leather',4),
(3,1,'22052017-004422693190.jpg',483.90,'Chloe can be used as a large coin pouch, a make-up purse or as a last minute clutch for a night out on the town. This super handy clutch makes a wonderful gift for those in love with the hair-on-hide trend.','Chloe Sky Blue Bok Clutch',3),
(4,2,'22052017-00455595492.jpg',179.90,'Torz is the perfect shopper bag. She is roomy, simple and chic. A pleasure to carry on your shoulder, in-hand or crossbody using the detachable shoulder-sling Torz makes a style statement.','Lee Black Clutch',2),
(5,2,'22052017-008880795492.jpg',159.90,'Torz is the perfect shopper bag. She is roomy, simple and chic. A pleasure to carry on your shoulder, in-hand or crossbody using the detachable shoulder-sling Torz makes a style statement.','the transport rucksack',1),
(6,1,'22052017-004520744455.jpg',99.99,'Our favorite backpack returns in rich Italian leather. With the same familiar sporty shape (zip pocket and all), our updated version has playful fringed pulls (personalize them even more with your bag tag of choice).','Torz Hazelnut + Black Leather',3),
(7,1,'21052017-008880711115.jpg',99.00,'Linda’s slouchy style makes for a perfect day bag. Her distinctive aged grey leather adds subtle texture to any outfit. A great size to carry your necessities, she fits snuggly on your shoulder or in the crook of your arm.','Tommy Grey Leather',4),
(8,4,'21052017-008880711114.jpg',19.90,'Kim is our coin purse. Super handy for keeping your wallet light or holding phone and lippy on a night out.zip closure.H:12cm L:15cm','Kim Cream',4),
(9,3,'21052017-008880711113.jpg',49.00,'Kim is our coin purse. Super handy for keeping your wallet light or holding phone and lippy on a night out.','Kim Grey Bok',5),
(10,3,'21052017-008880711112.jpg',49.50,'Kim is our coin purse. Super handy for keeping your wallet light or holding phone and lippy on a night out.','Kim Silver',6),
(11,3,'22052017-008880795400.jpg',49.50,'Kim is our coin purse. Super handy for keeping your wallet light or holding phone and lippy on a night out.','Kim Rose Gold',7),
(12,1,'22052017-004520744400.jpg',189.50,'Siobhan is the perfect shopper tote. She is roomy, simple and chic. A pleasure to carry on your shoulder, in-hand or crossbody using the detachable shoulder-sling Siobhan makes a style statement.','Siobhan Black Bok',7);
 
#DROP TABLE `Supplier`;
#
# Tables Structure for : Supplier
#
 
CREATE TABLE `Supplier` (
`ID` INTEGER NOT NULL,
`Address` NVARCHAR(50) NOT NULL,
`MobilePhone` LONGTEXT,
`SDefaultPhone` NVARCHAR(20) NOT NULL,
`SupplierEmaill` NVARCHAR(30) NOT NULL,
`SupplierName` NVARCHAR(50) NOT NULL,
`WorkPhone` LONGTEXT
) CharSet=utf8 Engine=InnoDB;
 
#
# Dumping Rows for Table : Supplier
#
 
INSERT INTO `Supplier` ( `ID`, `Address`, `MobilePhone`, `SDefaultPhone`, `SupplierEmaill`, `SupplierName`, `WorkPhone`) VALUES (1,'12 Balfour Street','','021 022 33520','admin@alibaba.com','Alibaba.com',''),
(2,'32 Logan Road','021 02233 520','027 012 4511','support@datalogic.com','Taobao.com',''),
(3,'45 Arney Road','','027 954 1470','sales@wheeloak.co.nz','Auckland Bag Inc',''),
(4,'71 Williamson Avenue','022 541 124','021 254 9658','sales@wadshire.co.nz','New Zealand Gold Inc',''),
(5,'82 Bell Road','','022 980 3324','support@datadevelopers.co.nz','NZ Bags',''),
(6,'92 Chester Street','','027 660 8210','sales@businessdata.co.nz','Warehouse','023 214 45'),
(7,'68 Crocus Road','','021 014 561','jackjohnson@farmers.co.nz','Farmers',''),
(8,'24 Sonia Street','','020 487 457','sales@countdown.co.nz','Countdown','');
 
ALTER TABLE `Users` ADD PRIMARY KEY (`Id`);
ALTER TABLE `Users` CHANGE COLUMN `Id` `Id` Integer NOT NULL AUTO_INCREMENT;
ALTER TABLE `Category` ADD PRIMARY KEY (`CategoryID`);
ALTER TABLE `Category` CHANGE COLUMN `CategoryID` `CategoryID` Integer NOT NULL AUTO_INCREMENT;
ALTER TABLE `Orders` ADD PRIMARY KEY (`OrderId`);
ALTER TABLE `Orders` CHANGE COLUMN `OrderId` `OrderId` Integer NOT NULL AUTO_INCREMENT;
ALTER TABLE `OrderDetail` ADD PRIMARY KEY (`OrderDetailId`);
ALTER TABLE `OrderDetail` CHANGE COLUMN `OrderDetailId` `OrderDetailId` Integer NOT NULL AUTO_INCREMENT;
ALTER TABLE `Product` ADD PRIMARY KEY (`ProductID`);
ALTER TABLE `Product` CHANGE COLUMN `ProductID` `ProductID` Integer NOT NULL AUTO_INCREMENT;
ALTER TABLE `Supplier` ADD PRIMARY KEY (`ID`);
ALTER TABLE `Supplier` CHANGE COLUMN `ID` `ID` Integer NOT NULL AUTO_INCREMENT;
