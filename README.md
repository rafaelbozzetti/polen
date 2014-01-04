Projeto Pólen
=====

É um software livre para criação de iniciativas junto a rede social Coolmeia.


Instalação
=====

Descompacte o projeto no seu /var/www/

Configuração Apache
=====

```ruby
<VirtualHost *:80>
    ServerName polenapp.local
    DocumentRoot /var/www/polen/public/app
    <Directory /var/www/polen/public>
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>
```

Inclua o ServerName no /etc/hosts local.
```ruby
127.0.0.1       polenapp.local
```

Crie uma base de dados e configure os acesso no arquivo app/config/config.ini

O schema do banco deve ser instalado.
```ruby
 mysql -u[usuario] -p[senha] nome_database < install/schema.sql
```

Roadmap
=====

- [x] Código base, estrutura em zend framework 1 (php)
- [ ] Autenticação com a coolmeia
- [ ] Sincronização de informações do usuário ao logar.
- [ ] Pesquisa métodos disponíveis do Elgg via webservice
- [ ] Criação de módulos (blog, grupos)


