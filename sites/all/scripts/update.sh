# Shell and drush commands to install ferienwohnung-harzgerode page on development system.

# Install site with sb installation profile
drush en chique_sub -y

# Activate Features
drush --yes pm-enable fewo_base
drush --yes pm-enable fewo_page
drush --yes pm-enable fewo_contact
drush --yes pm-enable fewo_wysiwyg

# Cache clear / set page variables
drush fra -y
drush cc all -y
