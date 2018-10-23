## Requirements
|Language|Version|
|:---|:---|
|PHP |^7.2|
|MySQL |^5.7|

## Framework
|Framework| Version|
|:---|:---|
|Symfony|4.1.0|
## Installation
First execute ```$ composer install``` from the top level project directory. This will install all project bundles.

### JWT
The JWT token creation uses SSH keys which must be created using the following commands (requires OpenSSL):
```bash
mkdir config/jwt
openssl genrsa -out config/jwt/private.pem -aes256 4096
openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
```
Use the passphrase defined as parameter `JWT_PASSPHRASE` when asked.

Make sure to allow the web server to access these certificates.

### Run Migartions
```bash
$  php bin/console doctrine:migrations:migrate
```
### Load Fixtures
```bash
$  php bin/console doctrine:fixtures:load
```
### Start Server
```bash
$  php bin/console s:r
```

### Customer Feature api doc
```bash
Access in browser
localhost:8000/api/doc
```
### Admin Feature api/doc
```bash
Access in browser
localhost:8000/api/doc/admin
```
