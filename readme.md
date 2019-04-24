## Make repository and clone project from 
```bash 
git init
git clone git@bitbucket.org:antoninasych/backoffice.git
```
##Composer install dependencies
```bash 
composer install
```
## About Setup
- Rename .envexample in .env
- Setup there all configuration for DB connect
 
## Make migrations
```bash 
php artisan migrate
```
  **It will create tables**:
  
- users;
- password_resets;
- permission_role;
- permissions;
- role_user;
- roles;


## Make seed with fake users, roles, permissions, attach permissions to the roles
```bash 
php artisan db:seed
```

**It will setup roles:**

- administrator;	 
- call_center; 	
- business;	 
- fraud_monitoring;	 	
- developer security;	
 
**It will setup users according with their roles:**

- Business User	business@gmail.com;	 
- Administrator User	administrator@gmail.com; 
- Fraud User	fraud@gmail.com;	 
- CallCenter User	callcenter@gmail.com;	 
- Developer User	developer@gmail.com;	 
- Security User	security@gmail.com;
  
  You can use all of them to login to the backoffice with 
  
  _For example:_
  **login** - **administrator@gmail.com** or other one email from the list of users
  **password** - **password** by default for pre-installed users.
  
        
**It will also attach roles to users** according their logic name( one user - one role)

**It will setup permissions:**
 - manage-users;
 - view-payments;
 - add-user;

**It will attach permissions to the role** 
 - 'manage-users' and 'add-user' to developer role;
 - 'add-user' to administrator role;

Behavior:

 - Only with 'add-user' permission user can register new users.
     _http://backoffice.loc/register_
     Registration needs to define role from the list.
     New user gets a letter with information to with proposal to change password during 60 minutes.
     
 - Only with 'manage-users' permission user can 
   1. Attach permissions to roles:
     _http://backoffice.loc/settings_
   2. Change roles for existing users
    _http://backoffice.loc/settings/users_
    
 - Only with 'view-payments'  permission user can view payments page and it details
    _http://backoffice.loc/payments_
    _http://backoffice.loc/payments/view?id=1_
 
 
 
 
 
 

