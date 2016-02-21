# Cloud Invoice Manager Lite

##Simple invoicing management software

**Cloud Invoice Manager Lite** is a basic and open source version of Cloud Invoice Manager, software which is used for managing financies in the company.
It is based on most used PHP MVC framework Codeigniter 2.1.4, which is high performance web framework, Twitter Bootstrap and jQuery. This project contain many additional libraries used for reporting, mailing, caching etc. which are integrated into Codeigniter.

Available functions:

*	Customer management
*	Products management
* 	Invoices management

###Customer management
Customer management covers infinite number of customers registration and customers information management, also customers groups registration, grouping customers in each registered customer group for easier future ordering and implementation on features per customer group.  This functionality also allow direct preview on every customer invoice for easier status tracking.

PRO version also implements realtime communication with the customer and realtime colaboration.

###Products management
Products management covers infinite number of products registration and products management.  Every product can be add in products category for easier products management and ordering.

PRO version also implements multiple realtime inventories so product quantity can be managed and tracked per inventory but also multiple shops registration so products can be ordered directly from the shop.

###Invoices management
Invoices management covers infinite number of invoices creation and invoices management. Invoices easy can be generated as PDF for printing or send as PDF from the main SMTP as PDF to the client. Taxes are automatically calculated, they can be displayed or not depending on parameter. Also invoice numbers are generated in multiple formats which also include number prefix. Invoices management allows easy invoice status tracking but also daily system notifications for latest created and payed invocies.

PRO version contain also quote creation, input invoices with automatically product importing in specific inventory, products transfer between inventories and shops. 

Other functionalities that are implemented in PRO version are:

*	User permission per functionality
* 	User hierarchy
*  Customer request notes management
*  Delivery notes management
*  Received notes management
*  Expenses management
*  Payments management
*  Purchases management
*  Sales management
*  Reports
*  etc...

## Installation

Requirements: 

*	PHP 5.2.X
* 	MySQL 5.6.X
*  Apache HTTP

For personal use this project can be easy installed on top on some bundle software packages like XAMPP, WAMP etc...

Installation steps:

1.	Propper servers installation.
2. Importing and executing the SQL script with the database schema.
3. Copying project files into htdocs or other web folder.
4. Setting database configuration in file database.php which can be found at this path: /application/config/database.php.

That's it, just create account from web and you can start with creating invoices.

As open source software you can do whatever you want with it, everything is on your own risk.

I dont take responsibility from wrong actions.