<img src="app/img/waycloud_logo.png" alt="Showcase" height="100px">

## WayCloud
All your files, always with you

[![PHP](https://img.shields.io/badge/Php-7.2.24-blue)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-5.7.30-%23738cff)](https://www.mysql.com/it/)
[![GitHub (pre-)release](https://img.shields.io/github/v/release/fctaddia/WayCloud?color=%234570b5&label=Release)](./../../releases)
[![License](https://img.shields.io/github/license/fctaddia/NfcTools?color=039c98&label=License)](https://opensource.org/licenses/MIT)

Second test project - State exam 2020 - Realized by Francesco Taddia

### Overview
WayCloud is a platform that allows uploading files to a remote database. For each user registered space is dedicated. You can access the platform with this link (<http://www.waycloud.it>). WayCloud is developed with PHP, JavaScript, HTML, CSS for the front end part. For the back-end part use the default server of php. It listens for and handles requests for PHP pages from clients. Finally for the part of archiving there is a database written with MySQL.

### Objectives
* **Upload Files:** allow uploading of files with different extensions and sizes;
* **Download Files:** allow downloading of files uploaded to the platform;
* **Remove Files:** allow the removal of files uploaded to the platform;
* **Multi-User:** possibility to use the platform with different users.

### Specifications
The site has a login screen that allows you to log into WayCloud and to register. The registration phase involves entering the main personal data with requests for email and password (password which is then encrypted with the SHA1 algorithm before being loaded into the database). An insert posting query is executed with the requested values from the table. For login, email and password. Then a query is run to verify the data entered by the user. The page for uploading and downloading files (My space - WayCloud, is the title of the same) is equipped with a button that allows the upload of new files while then in the my space section it is possible to view all the uploaded files in a table. As listed above in the objectives there are the possibilities to download and delete a file. This is to give the user more control over their storage space.

### Session
Sessions are present to ensure user uniqueness. This means that, for each user connected to WayCloud, each PHPSESSID will be different. This ensures that the actions performed by one user do not alter the session and therefore the space of another user. The session starts when the login has been validated (it means that the data entered by the user is correct). The start of the session, in practice, takes place in checker.php which goes to check if the login was successful. If all went well then create the session, this whole process happens in myspace.php. Destruction of the session is possible. To destroy it there is the button at the top right, which allows you to disconnect from the WayCloud profile. In practice it is called a php file (logout.php) which will take care of the actual destruction of the session. Once destroyed, logout.php, redirects the user to the login screen.

### Cookie
Cookies are present to store the user's email. The stored email is then used to perform queries useful for obtaining or uploading user information. The setting of cookies is performed on the login screen. Cookies don't come stored as soon as the screen loads, but when the data control function of the user returns true.

### Encryption and Decryption
User data and password encryption is present in WayCloud. The password is encrypted, with SHA1, when the login is validated. The files are encrypted with the aes-256-cbc method. This encryption method encrypts data at 256 bits and is based on the OpenSSL protocol (open source implementation of the SSL protocol). This is to ensure the standards of the http security protocol. Encryption is done through the use of a key that is used for both encryption and decryption. The key is the user's encrypted password. This means that in the filesystem the file is not readable in clear text but it needs a decryption key for reading. The functions that perform the task of encrypting and decrypting are contained in handspace.php and are used when the post upload or download is invoked.

### Database
> **Tip:** In the ER diagram, the DATA attribute in the FILE entity means the actual file (data = data contained in the file)

The database is present in the directory "code / db / waycloud.sql", there is also the diagram ER and the Logical Scheme. The database consisting of two entities (user and file) that have a relationship between them (upload). The cardinality for USER is 0, N because a user can upload 0 to N files into the cloud; while the FILE entity has cardinality 1.1 because it can be loaded by only one user. Foreign is only one and it is id_USER. This is because the FILE entity is 1.1, therefore it refers to a single user. This implies the creation of the foreign key to make the relationship effective UPLOAD which was present in the ER diagram.

### DNS
DNS is present in WayCloud. To make WayCloud accessible, in an easy way, outside the private network in which it runs, it is necessary to associate the IP address of the router with a domain. This operation has two sides. The first requires that the router have a static address, to then associate the domain with the router IP. The second possibility is to use the DynDNS protocol (Dynamic DNS). Operation of this protocol requires automatic association between the domain and the router IP. The main advantage is that if the router IP changes automatically, the domain is associated with the router IP. So that the service offered by the domain always remains online. WayCloud is available online with a static ip.

### Client-Server model
There is a server in the project. The server runs on a virtual machine, with TLinux (owner of the Linux operating system) installed. The default PHP server is running on this virtual machine. It allows you to always listen, in a given directory, for requests for php pages from clients. Through the use of DNS and Sockets it was possible to put the site on the network. DNS, as mentioned above, allows access to the site in a simple way. Sockets are used to establish communication between client and server. Remember that a socket consists of an IP address and a port number. The WayCloud service runs on port 80, so it is not necessary to specify it in the URL, unless the port is different from 80, in which case it must be specified in the URL

### CONTRIBUTING
There are many ways to [contribute](./docs/CONTRIBUTING.md), you can
- submit bugs,
- help track issues,
- review code changes.
