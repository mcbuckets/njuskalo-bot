# njuskalo-bot
Bot that scrapes njuskalo.hr in search for newly listed apartments

I use it on raspberry pi as deamon php script managed by Supervisor.

Supervisor config:

[program:njuskalo_bot]<br/>
command=php /usr/src/njuskalo_bot/app.php<br/>
autostart=true<br/>
autorestart=true<br/> 
stderr_logfile=/var/log/njuskalo_bot.err.log<br/>
