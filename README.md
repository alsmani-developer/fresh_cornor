# Veen
web application with api  for wfood-albyate
<h1> installation </h1>
</t><code>git clone https://github.com/adilsaeedkh/Veen</code>
<h1>Install Composer  </h1>
<code> composer install </code>
<h1>Install NPM Dependencies  </h1>
</t><code>npm install</code>

<h1>Create a copy of your .env file</h1>
</t><code>cp .env.example .env</code>


<h1>  Generate an app encryption key </h1>
</t><code>php artisan key:generate</code>

<h1> Create an empty database for our application </h1>

<h1> In the .env file, add database information to allow Laravel to connect to the database</h1>

<h1> use multi auth for admin login</h1>
</t><code>php artisan vendor:publish --tag="multiauth:migrations"</code>

<h1> Migrate the database</h1>
</t><code>php artisan migrate</code>

<h1>create the Admin user </h1>
</t><code>php artisan multiauth:seed --role=super</code>

<h1> [Optional]: Seed the database </h1>

</t><code>php artisan db:seed</code>




<b><h1>Syncing Central Repo with Local Repo</h1></b><Note>(only do this the initial time)</Note></h1>

Find & copy Central Repo URL
    
    <code>git remote add upstream https://github.com/adilsaeedkh/Veen.git</code>

After Initial Set Up

   Update your Local Repo & Push Changes
   
   <code>git pull upstream master </code> 
        
  - pull down any changes and sync the local repo with the central repo
        make changes,
        <code >git add .</code>
        and 
        <code>git commit </code>
        <code>git push origin master </code>
        - push your changes up to your fork
        Repeat



