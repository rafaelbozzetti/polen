Projeto Pólen
=====

É um software livre para criação de iniciativas junto a rede social Coolmeia.


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

Roadmap
=====

- [x] Código base, estrutura em zend framework 1 (php)
- [ ] Autenticação com a coolmeia
- [ ] Sincronização de informações do usuário ao logar.
- [ ]Pesquisa métodos disponíveis do Elgg
- [ ] Criação de módulos (blog, grupos)


