<h2>Quick start</h2>
<ul>
    <li>Git clone : https://github.com/10102004tan/Job-oishi-api.git </li>
    <li>Turn on docker on desktop</li>
    <li>
        <div>
            docker-compose up -d
        </div>
    </li>
    =
    <li>
        Host : http://localhost:3001/
    </li>
    <li>
    How to asset to mysql 
        <ul>
            <li>Open termial and run : docker-compose exec mysqldb mysql -u root -p</li>
            <li>List cmd for docker-compose mysql : 
                <ul>
                       <li>Migrate : docker-compose exec app php artisan migrate</li>
                        <li>SHOW DATABASES; </li>
                    <li>USE joboishi;</li>
                    <li>SELECT * FROM table_name;</li>
                </ul>
            </li>
        </ul>
    </li>
</ul>
