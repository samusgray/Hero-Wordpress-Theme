# Hero Theme
## A starter theme designed for rapid Wordpress development.

### Theme Includes:

#### Sass:
- Sass w/ Compass
- Small mixin library for type and layout
- A reset.scss partial
- IE stylesheet

#### Javascript: 
- JS minification / concatination
- jQuery CDN and local fallback
- Smart .gitignore

#### Template Workflow:
- Components directory and grunt task to create new components
- Basic theme templates (page.php, header.php, 404.php, etc.)
- Useful functions.php file

### How To Use:
#### Clone the directory into your Wordpress themes folder
```
cd myproject/wp-content/themes/
git clone git@github.com:mragray/Hero-Wordpress-Theme.git
mv Hero-Wordpress-Theme myproject-theme-name
```
#### Install Node modules with NPM
```
cd myproject-theme-name
npm install
```

#### Start grunt tasks
```
grunt
```
Profit!

### Comming Soon
- Susy for magic layouts