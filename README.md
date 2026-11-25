# Wommi

Classic WordPress starter theme for https://wommi.org.

## Local development

- Project: `C:\Users\hp\Wordpress\wommi`
- Herd site: https://wommi.test
- Admin: https://wommi.test/wp-admin/
- Local database: SQLite through `sqlite-database-integration`, stored at `wp-content/database/.ht.sqlite`.
- Local login details are kept outside this repository in `C:\Users\hp\Wordpress\_shared\local-credentials\wommi.json`.

The theme creates only Home on activation without overwriting an existing page, and sets it as the static front page. Activation setup runs on the next WordPress load. If Home is missing on production, use the dashboard's **Create pages now** link.

The homepage currently displays only "Coming soon", pending the supplied mockup. Navigation is hidden. Generic page and blog templates remain available for future development. Use Contact Form 7 for future forms, with its shortcode in page content.

The local starter pages other than Home have been moved to Trash. Theme deployment does not change production database pages; move any existing unwanted production pages to Trash in wp-admin.

## Production setup

1. Point `wommi.org` to the Namecheap hosting account and enable HTTPS.
2. Install WordPress for this domain using its own MySQL database and `wp-config.php`.
3. Create an FTP account jailed to this site's document root. The workflow targets `./wp-content/themes/wommi/` relative to that root.
4. Add repository Actions secrets `FTP_SERVER`, `FTP_USERNAME`, and `FTP_PASSWORD`.
5. Push a theme change to `main` to deploy. Activate **Wommi** in Appearance > Themes, then load the homepage. Use the setup notice if pages are missing and save Settings > Permalinks if routes return 404.
6. Install and configure Contact Form 7 on production when forms are needed.

The workflow lints PHP before FTPS deployment and skips deployment until all three FTP secrets exist. It uses `actions/checkout@v6` and `SamKirkland/FTP-Deploy-Action@v4.4.0`. No GitHub environment is required.

Git tracks only this theme, the deployment workflow, `.gitignore`, and this README. WordPress core, plugins, uploads, local credentials, SQLite, and `wp-config.php` remain local. Deployment transfers theme files only. Manage production content in wp-admin and edit theme code in this repository.
