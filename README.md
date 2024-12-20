# VisitMaremma-project
Website designed to highlight places to visit in the south of tuscany

## Requisiti

Per visualizzare e navigare nel sito, è necessario:
1. Un server locale per ospitare i file del sito, ad esempio:
   - [XAMPP] (consigliato)
2. **PHP** (incluso nei pacchetti come XAMPP).
3. **MySQL** per il database.

## Configurazione e Installazione

1. **Clona il repository**
   - Scarica o clona la repository sul tuo computer:
     ```bash
     git clone https://github.com/GiacomoT23/VisitMaremma-project.git
     ```

2. **Configura il server locale**
   - Installa [XAMPP].
   - Posiziona i file del progetto nella directory di root del server web:

3. **Configura il database**
   - Avvia il server MySQL tramite il pannello di controllo di XAMPP.
   - Apri **phpMyAdmin**.
   - Importa ed esegui il file SQL presente nella repository per creare e popolare il database.

4. **Avvia il sito**
   - Apri un browser web e vai su:
     ```
     http://localhost/VisitMaremma
     ```

## Funzionalità

-Possibilità di effettuare iscrizione o navigare come guest.
- Ricerca di luoghi per nome e categoria.
- Creazione di liste di luoghi associate all'utente.
- Possibilità di lasciare valutazioni e commenti pubblici.
- Lato amministratore: aggiunta e rimozione di luoghi e utenti.
