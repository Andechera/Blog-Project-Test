# Documentazione del Progetto Blog in Symfony

## 1. Panoramica

Il progetto è un’applicazione basata su **Symfony 6.4**, con gestione dati tramite **Doctrine** e l’utilizzo dell’engine **Twig** per la visualizzazione delle viste. 

Aprendo il portale ci si ritrova in una semplice landing page che ha il compito di dare il benvenuto all’utente e presenta un bottone che ti porta ai post del blog. 

Una volta premuto il bottone, ci ritroviamo davanti una tabella che presenta tutti i post creati, in ordine dal più recente al più vecchio. Abbiamo la possibilità di creare nuovi post tramite il bottone subito sopra la tabella, oppure possiamo modificare o eliminare quelli già presenti.

Sotto la tabella c’è un paginatore che ti permette di visualizzare la lista dei post 5 alla volta, permettendo una gestione più snella. 

Infine, troviamo in alto a sinistra un breadcrumb che ci permette di tornare alla home page.

## 2. Installazione e Configurazione

### Installare le dipendenze:
Per avviare il progetto bisogna eseguire questo comando da terminale per installare tutte le dipendenze (Vendor):

```bash
composer install
```

### Collegare il database:
Ho mandato un backup del database che ho creato, bisogna solo modificare le credenziali di accesso al MySQL nel file `.env`. Ho lasciato `root` come username, la password l’ho rimossa. Una volta installato il database (MySQL), bisogna inizializzarlo con i seguenti comandi:

```bash
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```

Oppure con il CLI Symfony:

```bash
symfony console doctrine:migrations:migrate
```

## 3. Struttura del Progetto

- **Entity e Gestione Dati**: I dati dei post vengono gestiti tramite l’Entity `BlogPost`.
- **Form Types**: Il file `BlogPostType.php` definisce i form per creare o modificare i post.
- **Routing**: Il routing è definito tramite annotations nei controller (`MainController` e `BlogPostController`).

## 4. Viste

- Le viste utilizzano l’engine **Twig**, che permette di definire un layout base per l’intera applicazione.
- Lo stile è semplice ma funzionante perfettamente con Twig.

## 5. Comandi Utili

### Avvio del server di sviluppo:
Per avviare il progetto, esegui questo comando da terminale:

```bash
symfony server:start
```

Oppure senza CLI Symfony:

```bash
php -S 127.0.0.1:8000 -t public/
```

### Rigenerazione dell'Autoload:
Se necessario, potrebbe essere utile forzare l’autoload dell’applicazione con il comando:

```bash
composer dump-autoload
```

### Pulizia della cache:
Se necessario, si può pulire la cache per far funzionare il progetto con:

```bash
symfony console cache:clear
```

Oppure senza CLI:

```bash
php bin/console cache:clear
