## Make repository and clone project from 
- git clone git@bitbucket.org:antoninasych/backoffice.git

##Composer install dependencies
- composer install

## About Setup
- Rename .envexample in .env
- Setup there all configuration for DB connect
 
## Make migrations
- php artisan migrate
  It will create tables:
  -  users;
  -  password_resets;
  -  permission_role;
  -  permissions;
  -  role_user;
  -  roles;


## Make seed with fake users, roles, permissions, attach permissions to the roles
- php artisan db:seed

It will setup roles:
        administrator	 
        call_center 	
        business	 
        fraud_monitoring	 	
        developer security	
 
It will setup users according with their roles:
        Business User	business@gmail.com	 
        Administrator User	administrator@gmail.com	 
        Fraud User	fraud@gmail.com	NULL	 
        CallCenter User	callcenter@gmail.com	 
        Developer User	developer@gmail.com	NULL	 
        Security User	security@gmail.com
        
It will also attach roles to users according their logic name
        one user - one role

It will setup permissions:
        manage-users
        view-payments
        add-user

It will attach permissions to the role 
- add-user and add-user to developer role
- add-user to administrator role



