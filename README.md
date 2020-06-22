<img src="app/img/waycloud_logo.png" alt="Showcase" height="100px">

## WayCloud
All your files, always with you

[![PHP](https://img.shields.io/badge/Php-7.2.24-blue)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-5.7.30-%23738cff)](https://www.mysql.com/it/)
[![GitHub (pre-)release](https://img.shields.io/github/v/release/fctaddia/WayCloud?color=%234570b5&label=Release)](./../../releases)
[![License](https://img.shields.io/github/license/fctaddia/NfcTools?color=039c98&label=License)](https://opensource.org/licenses/MIT)
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/3363acf0df0c46e8a803d087c1f5a872)](https://www.codacy.com/manual/fctaddia/WayCloud?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=fctaddia/WayCloud&amp;utm_campaign=Badge_Grade)

Second test project - State exam 2020 - Realized by Francesco Taddia

### Overview
WayCloud is a platform that allows uploading files to a remote database. For each user registered space is dedicated. You can access the platform with this link (http://taddia.sytes.net:6005/login.php). WayCloud is developed with PHP, JavaScript, HTML, CSS for the front end part. For the back-end part use the default server of php. It listens for and handles requests for PHP pages from clients. Finally for the part of archiving there is a database written with MySQL.

### Objectives
* **Upload Files:** allow uploading of files with different extensions and sizes;
* **Download Files:** allow downloading of files uploaded to the platform;
* **Remove Files:** allow the removal of files uploaded to the platform;
* **Multi-User:** possibility to use the platform with different users.

### Specifications
The site has a login screen that allows you to log in to WayCloud e to register for it. The registration phase requires the insertion of the main personal data with the requests of the email and password (password which is then encrypted, with the SHA1 algorithm, before being loaded into the database). A query is run for registration of insertion with the values required by the table. For access, email and password. Then a query is made to verify the data entered by the user. The page of uploading and downloading files (My space - WayCloud, is the title of it) comes with two cardview (rectangles or white divs) which offer the possibility to choose the file to upload to WayCloud and to view the files already present in it. As listed above in the objectives are present the possibilities to download and delete a file. This is to give more control to the user on their storage space.

### Session
The sessions are present to guarantee the uniqueness of the user. This means that, for each user connected to WayCloud, each PHPSESSID will be different. This guarantees that the actions performed by a user do not alter the session, and therefore, the space of another user. The session starts when the login has been validated (it means that the data entered by the user are correct). The start of the session, in practice, occurs in main.php. Destruction of the session is possible. To destroy it there is the button at the top right, which allows you to log out of the WayCloud profile. In practice, a php file is called (logout.php) which will take care of the actual destruction of the session. Once destroyed, logout.php, redirect the user to the login screen.

### Cookie
Cookies are present to store the user's email. The stored email is then used to perform queries useful for obtaining or uploading user information. The setting of cookies is performed on the login screen. Cookies don't come stored as soon as the screen loads, but when the data control function of the user returns true.

### Encryption and Decryption
The encryption of user data and password is present in WayCloud. The password comes encrypted, with SHA1, when the login is validated. The files are encrypted with the aes-256-cbc method. This encryption method encrypts 256bit data and relies on the protocol OpenSSL (open source implementation of the SSL protocol). This is to ensure standards security protocol http. The encryption takes place through the use of a key used both to encrypt than to decipher. The key is the user's encrypted password. This means that in the database the file is not readable in the clear but needs a decryption key for reading. The functions that perform the task of encrypt and decrypt are contained within main.php and they are named like this: my_encrypt and my_decrypt.

### Database
> **Tip:** In the ER diagram, the DATA attribute in the FILE entity means the actual file (data = data contained in the file)
The database is present in the directory "code / db / waycloud.sql", there is also the diagram ER and the Logical Scheme. The database consisting of two entities (user and file) that have a relationship between them (upload). The cardinality for USER is 0, N because a user can upload 0 to N files into the cloud; while the FILE entity has cardinality 1.1 because it can be loaded by only one user. Foreign is only one and it is id_USER. This is because the FILE entity is 1.1, therefore it refers to a single user. This implies the creation of the foreign key to make the relationship effective UPLOAD which was present in the ER diagram.

### DNS
DNS is present in WayCloud. To make WayCloud accessible, in a simple way, outside the private network in which it is run, it is necessary to associate the router's IP address with a domain. This operation has two sides. The first requires that the router have a static address, to then associate the domain with the router's IP. The second possibility is to use the DynDNS (Dynamic DNS) protocol. The operation of this protocol requires that the automatic association between the domain and the router IP. The main advantage is that if the router's IP changes automatically, the domain is associated with the router's IP. So that the service that is offered by the domain always remains online. WayCloud is available online with the DynDNS protocol.

### Client-Server model
There is a server in the project. The server runs on a virtual machine, with TLinux (OS Linux owner) installed. The PHP default server is running on this virtual machine. It allows you to always be listening, in a given directory, for php page requests from clients. Through the use of DNS and Sockets it was possible to put the site on the net. DNS, as previously mentioned, allowed access to the site in a simple way. Sockets are used to establish communication between Client and Server. Remember that a socket is made up of an IP address and a port number. The WayCloud service runs on port 6005 so you need to specify it in the URL, unless all requests on port 80 are routed to port 6005 from the router.
