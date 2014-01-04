Projeto Pólen
=====

É um software livre para criação de iniciativas junto a rede social Coolmeia.

O ambiente base permite ao administrador da iniciativa, configurar visualmente o
"site", definir qual módulo de mídia utilizará para dissiminar o conteúdo.

As mídias serão módulos que o administrador pode habilitar. A idéia de mídia
é fornecer um ambiente que permita a rápida dissiminação de textos, posts, imagens, zines
e videos, num formato customizável.

A autenticação de usuários é feita via webservice com a coolmeia, isso permite que os 
usuários visitantes interajam com o assunto abordado.


Interações futuras
=====

A idéia de interagir via webservice com o Elgg permite que inicialmente tenhamos 
a autenticação de usuários e sincronização de avatar, nome etc.. Mas abre a 
possibilidade de interação com grupos, paginas, blog etc.. da coolmeia.


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
- [ ] Ambiente administrativo
- [ ] Instalador
- [ ] Autenticação com a coolmeia
- [ ] Sincronização de informações do usuário ao logar.
- [ ] Pesquisa métodos disponíveis do Elgg via webservice
- [ ] Criação de módulos (zines, blogs, galeria de imagens)


